<?php

class TimeClock extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('TimeClockModel', 'model');
        $this->load->model('BreakModel', 'breakModel');
    }

    public function index(){
        $response = $this->get_time_clock();
        $data = array();
        $slug_for_js = "";
        $view_to_load = "";
        if (!empty($response)) {
            $data['emp_clock_in']   = $response->emp_clock_in;
            $data['clock_in_img']   = $response->clock_in_img;
            $data['emp_id']         = $response->emp_id;
            $data['break_out']      = $this->model->get_single_break($response->emp_id);
            $data['break']          = false;
            // var_dump($data["break_out"]); exit;
            if(isset($data["break_out"])){
                $break_out = $data['break_out']->break_out;
                if($break_out === NULL){
                    $data["break"] = true;
                }
            }else{
                $data["break"] = false;
            }
            // var_dump($data['break_in']->break_out); exit;
            $view_to_load = 'time_out';
        } else {
            $data['emp_clock_in'] = '';
            $data['clock_in_img'] = '';
            $view_to_load = 'index';
            $data['slug_for_js'] = 'user_clock';
        }
        $this->load->view('admin/common/header');
        if ($this->session->userdata('user_id')['role'] == 'superadmin' &&
            !$this->session->userdata('attendence_data')) {
            $response = $this->model->get_all_time_clock_details();
            //            var_dump($response); exit;
            foreach ($response as $employee) {
                if (strcmp($employee->emp_loc, $employee->t_loc) === 0) {
                    $employee->emp_loc = $employee->t_name;
                    $employee->clk_in_flag = true;
                } else {
                    $employee->clk_in_flag = false;
                }

                if (strcmp($employee->emp_clock_out_loc, $employee->t_loc) === 0) {
                    $employee->emp_clock_out_loc = $employee->t_name;
                    $employee->clk_out_flag = true;
                } else {
                    $employee->clk_out_flag = false;
                }
            }
            if (!empty($response)) {
                $this->load->view('admin/time_clock/time_sheets', [
                    'employees' => $response,
                    'slug_for_js' => $slug_for_js
                ]);
            } else {
                $this->load->view('admin/time_clock/time_sheets', [
                    'employees' => $response,
                    'slug_for_js' => $slug_for_js
                ]);
            }
        } else {
            $this->load->view('admin/time_clock/' . $view_to_load, $data);
        }
        $this->load->view('admin/common/footer');
    }

    public function upload_clock_in_image() {
        $emp_id = "";
        if ($this->session->userdata('attendence_data')) {
            $emp_id = $this->session->userdata('attendence_data')['id'];
        } else {
            $emp_id = $this->session->userdata('user_id')['id'];
        }
        date_default_timezone_set("Asia/Karachi");
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        $emp_loc = $this->lat_lng_to_loc($lat, $long);
        $data = array(
            'emp_id' => $emp_id,
            'emp_clock_in' => date("Y-m-d H:i:s"),
            'emp_loc' => $emp_loc,
        );

        $insert_id = $this->model->add_clock_details($data);
        if (is_numeric($insert_id)) {
            $raw_image = $this->input->post('img_url');
            $uri = substr($raw_image, strpos($raw_image, ","));
            $id = $emp_id;
            $img_name = 'clock_in' . $insert_id . '.jpeg';
            if (!is_dir('./uploads/staff/emp_clock_in_out/' . $id)) {
                mkdir('./uploads/staff/emp_clock_in_out/' . $id, 0777, true);
            }
            $dir = './uploads/staff/emp_clock_in_out/' . $id . '/';
            file_put_contents($dir . $img_name, base64_decode($uri));
            $response = $this->model->update_clock_in_img($img_name, $id, $insert_id);
            if ($response) {
                $this->index();
            }
        } else {
            echo 'already clocked in';
            exit;
        }
    }

    public function upload_clock_out_image() {
        $emp_id = "";
        if ($this->session->userdata('attendence_data')) {
            $emp_id = $this->session->userdata('attendence_data')['id'];
        } else {
            $emp_id = $this->session->userdata('user_id')['id'];
        }
        date_default_timezone_set("Asia/Karachi");
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        $emp_clock_out_loc = $this->lat_lng_to_loc($lat, $long);
        $data = array(
            'emp_clock_out' => date("Y-m-d H:i:s"),
            'emp_clock_out_loc' => $emp_clock_out_loc,
        );
        $id = $emp_id;
        $insert_id = $this->model->update_clock_out_details($data, $id);
        if ($insert_id) {
            $raw_image = $this->input->post('img_url');
            $uri = substr($raw_image, strpos($raw_image, ","));
            $img_name = 'clock_out' . $insert_id . '.jpeg';
            if (!is_dir('./uploads/staff/emp_clock_in_out/' . $id)) {
                mkdir('./uploads/staff/emp_clock_in_out/' . $id, 0777, true);
            }
            $dir = './uploads/staff/emp_clock_in_out/' . $id . '/';
            file_put_contents($dir . $img_name, base64_decode($uri));
            $response = $this->model->update_clock_out_img($img_name, $id, $insert_id);
            if ($response) {
                $emp_clock_details = $this->model->get_emp_info_on_clk_out($insert_id);
                $response = $this->salary_calculator_in_out($emp_clock_details);
                if ($response) {
                    $this->index();
                } else {
                    echo '<h1 class="text-danger text-center">Sorry unable to update salary!</h1>';
                }
            }
        }
        if ($this->session->userdata('attendence_data')) {
            $this->session->unset_userdata('attendence_data');
        }
    }

    public function get_time_clock() {
        $emp_id = "";
        if ($this->session->userdata('attendence_data')) {
            $emp_id = $this->session->userdata('attendence_data')['id'];
        } else {
            $emp_id = $this->session->userdata('user_id')['id'];
        }
        $response = $this->model->get_clock_in($emp_id);
        if(isset($response)){
            $response->emp_id = $emp_id;
        }
        return $response;
    }

    public function time_clock_locs() {
        $this->load->model('TimeClockModel', 'model');
        $results = $this->model->get_clock_locations();
        $this->load->view('admin/common/header');
        $this->load->view('admin/time_clock/time_clock_locs', ['results' => $results]);
        $this->load->view('admin/common/footer');
    }

    public function add_clock_location() {
        $slug_for_js = "";
        $this->form_validation->set_rules('term_name', 'Terminal name', 'required');
        if ($this->form_validation->run()) {
            $lat = $this->input->post('lat');
            $lng = $this->input->post('lng');
            $location = $this->lat_lng_to_loc($lat, $lng);
            $data = array(
                'location' => $location,
                'name' => $this->input->post('term_name'),
            );
            $this->load->model('TimeClockModel', 'model');
            $response = $this->model->add_clock_location($data);
            if ($response) {
                $this->session->set_flashdata('success_msge', 'Location added successfuly!');
                return redirect('terminal/location');
            }
        } else {
            $this->load->view('admin/common/header');
            $this->load->view('admin/time_clock/search_loc', ['slug_for_js' => $slug_for_js]);
            $this->load->view('admin/common/footer');
        }
    }

    public function terminal_links() {
        $terminals = $this->model->get_terminal_links();
        foreach($terminals as $terminal){
            $tm = json_decode($terminal->positions); 
            $positions_array = array();
            foreach($tm as $pos){
                $positions_array[] = json_decode($pos);
            }
            $terminal->positions = $positions_array;
        }
        $this->load->view('admin/common/header');
        $this->load->view('admin/time_clock/terminal_links', ['terminals' => $terminals]);
        $this->load->view('admin/time_clock/dialoge_modal');
        $this->load->view('admin/common/footer');
    }

    public function generate_terminal_link() {
        $positions = $this->model->get_all_positions();
        $locations = $this->model->get_clock_locations();
        $this->form_validation->set_rules(
            'position_id[]',
            'Position',
            'callback_position_check'
        );
        $this->form_validation->set_rules(
            'location',
            'Location',
            'callback_location_check'
        );
        if ($this->form_validation->run()) {
            $location = $this->input->post('location');
            $position_ids = json_encode($this->input->post('position_id'));
            $data = array(
                'location_id' => $location,
                'positions' => $position_ids,
            );
            $response = $this->model->add_terminal_link($data);
            if ($response) {
                $this->session->set_flashdata('success_msge', 'Terminal link added successfully!');
                return redirect('terminal');
            }
        } else {
            $this->load->view('admin/common/header');
            $this->load->view('admin/time_clock/generate_link', [
                'positions' => $positions,
                'locations' => $locations,
            ]);
            $this->load->view('admin/common/footer');
        }
    }

    public function update_terminal_link($id = ""){
        if($id != ""){
            // var_dump($id); exit; 
            $response = $this->model->get_terminal_link_data($id);
            $exist_pos = json_decode($response[0]->positions);
            $positions = $this->model->get_all_positions();
            $locations = $this->model->get_clock_locations();
            $loc_id = $response[0]->location_id;
            $curr_loc = $this->model->get_single_location($loc_id);
        }
        $this->form_validation->set_rules(
            'position_id[]',
            'Position',
            'callback_position_check'
        );
        $this->form_validation->set_rules(
            'location',
            'Location',
            'callback_location_check'
        );
        if ($this->form_validation->run()) {
            $location = $this->input->post('location');
            $position_ids = json_encode($this->input->post('position_id'));
            // var_dump($this->input->post()); exit;
            // foreach($position_ids as $position_id){
            //     $data = array(
            //         'location_id' => $location,
            //         'positions' => $position_id,
            //     );
            // }
            $data = array(
                'location_id' => $location,
                'positions' => $position_ids,
            );
            $id = $this->input->post("update_id");
            $response = $this->model->update_terminal_link($data, $id);
            if ($response) {
                $this->session->set_flashdata('success_msge', 'Terminal link added successfully!');
                return redirect('terminal');
            }
        } else {
            $this->load->view('admin/common/header');
            $this->load->view('admin/time_clock/update_link', [
                'positions' => $positions,
                'locations' => $locations,
                "exist_pos" => $exist_pos,
                'exist_loc' => $curr_loc,
                "update_id" => $id
            ]);
            $this->load->view('admin/common/footer');
        }
    }

    public function delete_terminal_link($id){
        $response = $this->model->delete_terminal_links($id);
        if($response){
            $this->session->set_flashdata('success_msge', 'Terminal link deleted successfully!');
            return redirect('terminal');
        }else{
            $this->session->set_flashdata('error_msge', 'Unable to delete terminal link!');
            return redirect('terminal');
        }
    }

    public function location_check($str) {
        if ($str == '') {
            $this->form_validation->set_message(
                'location_check',
                'Please select location'
            );
            return false;
        } else {
            return true;
        }
    }

    public function position_check($str) {
        if ($str === null) {
            $this->form_validation->set_message(
                'position_check',
                'Please select position'
            );
            return false;
        } else {
            return true;
        }
    }

    public function salary_calculator_in_out($clock_details) {
        $emp_id = $clock_details->emp_id;
        $insert_id = $clock_details->tc_id;
        $start_date = $clock_details->emp_clock_in;
        $end_date = $clock_details->emp_clock_out;
        $salary_type = $clock_details->salary_type;
        $monthly_salary = $clock_details->monthly_salary;
        $daily_hours = $clock_details->daily_hours;
        $per_hour_salary = $clock_details->per_hour_amount;
        $one_clock_salary = 0;
        $date_a = new DateTime($start_date);
        $date_b = new DateTime($end_date);
        $interval = date_diff($date_a, $date_b);
        $day = $interval->format('%d');
        $hour = $interval->format('%h');
        $minutes = $interval->format('%m');
        $days_to_hours = $day * 24;
        $hours = $interval->format('%h') + $days_to_hours;
        $ts_from_hours = $hours * 60 * 60;
        $minutes = $interval->format('%i');
        $ts_from_minutes = $minutes * 60;
        $seconds = $interval->format('%s');
        $total_seconds = (int)$ts_from_hours + (int)$ts_from_minutes + (int)$seconds;
        if ($salary_type == 'monthly') {
            $per_day_salary = (double)$monthly_salary / 30;
            $per_hour_salary = (double)$per_day_salary / (int)$daily_hours;
            $per_minute_salary = (double)$per_hour_salary / 60;
            $per_second_salary = (double)$per_minute_salary / 60;
            $one_clock_salary = $total_seconds * $per_second_salary;
        } elseif ($salary_type === 'wages') {
            $per_minute_salary = $per_hour_salary / 60;
            $per_second_salary = $per_minute_salary / 60;
            $one_clock_salary = $total_seconds * $per_second_salary;
        }

        // ---------------------------------------------------------
        $clk_counter_indexes = $this->model->get_clk_day_counter_details($emp_id, $insert_id);
        $results = $this->model->overtime_plus_leave_details($clock_details);
        $special_hours = json_decode($results->hrly_rate_chart)->special_hours;
        if(!empty($special_hours)){
            $clock_in_hour = (int)date('H', strtotime($start_date));
            $clock_in_day = date('D', strtotime($start_date));    
            $clock_out_hour = (int)date('H', strtotime($end_date));
            $clock_out_minutes = (int)date('m', strtotime($end_date));
            $clock_out_seconds = (int)date('s', strtotime($end_date));
            $clock_out_day = date('D', strtotime($end_date));
            $special_over_time = 0;
            $matched_hour = null;
            $from_date = new DateTime($start_date);
            $to_date = new DateTime($end_date);
            $last_counter = null;
            if ($clk_counter_indexes) {
                $clock_in_obj = $start_date;
                foreach ($clk_counter_indexes as $counter) {
                    $special_over_time += $this->special_hours_counter(
                        $clock_in_hour,
                        $special_hours,
                        $clock_in_day,
                        $per_hour_salary,
                        23,
                        $clock_in_obj,
                        null
                    );
                    $clock_in_hour = 0;
                    $last_counter = $counter;
                }
    
                // -----------------------------------------------------------
                $last_counter = (int)date('H', strtotime($last_counter->clock_time));
                $special_over_time += $this->special_hours_counter(
                    $clock_in_hour,
                    $special_hours,
                    $clock_in_day,
                    $per_hour_salary,
                    $clock_out_hour,
                    null,
                    $end_date
                );
                $response = $this->model->remove_day_counter($emp_id);
                if(!$response){
                    echo '<h1 class="text-center">Unable to delete day counter from DB.</h1>';
                }
            } else {
                $special_over_time = $this->special_hours_counter(
                    $clock_in_hour,
                    $special_hours,
                    $clock_in_day,
                    $per_hour_salary,
                    $clock_out_hour
                );
            }
        }else{
            $special_over_time = 0;
        }
        $response = $this->model->update_per_clk_salary(
            $one_clock_salary,
            $special_over_time,
            $insert_id
        );
        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function delete_location($id) {
        $response = $this->model->delete_location($id);
        if ($response) {
            $this->session->set_flashdata(
                'success_msge',
                'Location deleted successfully!'
            );
        } else {
            $this->session->set_flashdata(
                'error_msge',
                'Unable to delete because the location added to position/employee'
            );
        }
        return redirect('terminal/location');
    }

    public function approve_attendence($id) {
        $response = $this->model->approve_attendence($id);
        if ($response) {
            $this->session->set_flashdata('success_msge', 'Attendence approved successfully!');
        } else {
            $this->session->set_flashdata('error_msge', 'Unable to approve attendance!');
        }
        return redirect('TimeClock/index');
    }

    public function special_hours_counter(
        $clock_in_hour,
        $special_hours,
        $clock_in_day,
        $per_hour_salary,
        $counter = 23,
        $clock_in_obj = null,
        $clock_out_obj = null
    ) {
        $special_over_time = 0;
        $per_minute_overtime = 0;
        $per_minute_out_overtime = 0;
        for ($i = (int)$clock_in_hour; $i < $counter; $i++) {
            foreach ($special_hours as $key => $special_hour) {
                $position = strpos($key, strtolower($clock_in_day));
                if ($position) {
                    $matched_hour = $this->numExtracter($key);
                    if ($i == $matched_hour) {
                        $special_hour = $this->numExtracter($special_hour);                        
                        if($clock_in_obj != null){
                            $clock_in_mins = (int)date('i', strtotime($clock_in_obj));
                            $clock_in_secs = $clock_in_mins * 60;
                            $clock_in_secs += (int)date('s', strtotime($clock_in_obj));
                            $total_clock_in_secs = 3600 - $clock_in_secs;

                            $clock_in_special_hour = $special_hour - 100;    
                            $in_over_time = $per_hour_salary * $clock_in_special_hour;
                            $in_over_time = $in_over_time / 100;

                            $per_minute_over_time = $in_over_time/60;
                            $per_second_over_time = $per_minute_over_time/60;
                            
                            $in_over_time = $per_second_over_time * $total_clock_in_secs;
                            $per_minute_out_overtime = $in_over_time;
                            $clock_in_obj = null;
                        }
                        if($clock_out_obj != null){
                            $clock_out_mins = (int)date('i', strtotime($clock_out_obj));

                            $clock_out_secs = (int)date('s', strtotime($clock_out_obj));
                            $mins_to_secs = $clock_out_mins * 60;
                            $clock_out_secs += $mins_to_secs;
                            $out_special_hour = $special_hour - 100;    
                            $out_over_time = $per_hour_salary * $out_special_hour;
                            $out_over_time = $out_over_time / 100;
                            $per_minute_over_time = $out_over_time/60;
                            $per_second_over_time = $per_minute_over_time/60;                             
                            $out_over_time = $per_second_over_time * $clock_out_secs;
                            $per_minute_overtime = $out_over_time;                            
                            $clock_out_obj = null;
                        }
                        $overtime_special_hour = $special_hour - 100;    
                        $over_time = $per_hour_salary * $overtime_special_hour;
                        $over_time = $over_time / 100;
                        $special_over_time += $over_time;
                    }
                }
            }
        }
        $special_over_time = $special_over_time + $per_minute_overtime + $per_minute_out_overtime;
        return $special_over_time;
    }

    public function get_updated_time(){
        date_default_timezone_set("Asia/Karachi");
        $current_date = new DateTime(date('Y-m-d H:i:s'));
        $clock_in_date = new DateTime($this->input->post('clock_in_time'));
        $interval = date_diff($current_date, $clock_in_date);
        $hour = $interval->format("%h");
        $minute = $interval->format("%i");
        $second = $interval->format("%s");
        echo $hour."h : ".$minute."m : ".$second."s";
    }
}
