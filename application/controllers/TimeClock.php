<?php

class TimeClock extends MY_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model('TimeClockModel', 'model');
    }

    public function index(){
        $response = $this->get_time_clock();

        //        var_dump($response); exit;
        $data = array();
        $slug_for_js = "";
        $view_to_load = "";
        if (!empty($response)) {
            $data['emp_clock_in'] = $response->emp_clock_in;
            $data['clock_in_img'] = $response->clock_in_img;
            $view_to_load = 'time_out';
        } else {
            $data['emp_clock_in'] = '';
            $data['clock_in_img'] = '';
            $view_to_load = 'index';
            $data['slug_for_js'] = 'user_clock';
        }
        $this->load->view('admin/common/header');
        //        var_dump($this->session->userdata('attendence_data')); exit;
        if ($this->session->userdata('user_id')['role'] == 'superadmin' &&
            !$this->session->userdata('attendence_data')) {
            $response = $this->model->get_all_time_clock_details();
            //            var_dump($response); exit;
            foreach ($response as $employee) {
                //                $lat = json_decode($employee->emp_loc)->lat;
                //                $long = json_decode($employee->emp_loc)->long;
                //                $employee->emp_loc = $this->lat_lng_to_loc($lat, $long);
                //
                //                $lat = json_decode($employee->t_loc)->lat;
                //                $long = json_decode($employee->t_loc)->lng;
                //                $employee->t_loc = $this->lat_lng_to_loc($lat, $long);
                //
                if (strcmp($employee->emp_loc, $employee->t_loc) === 0) {
                    $employee->emp_loc = $employee->t_name;
                    $employee->clk_in_flag = true;
                } else {
                    $employee->clk_in_flag = false;
                }
                //                $lat = json_decode($employee->emp_clock_out_loc)->lat;
                //                $long = json_decode($employee->emp_clock_out_loc)->long;
                //                $employee->emp_clock_out_loc = $this->lat_lng_to_loc($lat, $long);

                if (strcmp($employee->emp_clock_out_loc, $employee->t_loc) === 0) {
                    $employee->emp_clock_out_loc = $employee->t_name;
                    $employee->clk_out_flag = true;
                } else {
                    $employee->clk_out_flag = false;
                }
                //                var_dump($response); exit;
            }
            //             var_dump($response); exit;
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
        // echo $insert_id; exit;
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
        //         var_dump($this->input->post()); exit;
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
            //            'clock_out_img' => '',
        );
        //        var_dump($data);
        //        exit;
        $id = $emp_id;
        $insert_id = $this->model->update_clock_out_details($data, $id);
        //         var_dump($insert_id); exit;
        if ($insert_id) {
            // echo 'hello coming in iff '; exit;
            $raw_image = $this->input->post('img_url');
            $uri = substr($raw_image, strpos($raw_image, ","));
            $img_name = 'clock_out' . $insert_id . '.jpeg';
            // var_dump($img_name); exit;
            if (!is_dir('./uploads/staff/emp_clock_in_out/' . $id)) {
                mkdir('./uploads/staff/emp_clock_in_out/' . $id, 0777, true);
            }
            $dir = './uploads/staff/emp_clock_in_out/' . $id . '/';
            file_put_contents($dir . $img_name, base64_decode($uri));
            // var_dump($img_name); exit;

            //            exit;
            $response = $this->model->update_clock_out_img($img_name, $id, $insert_id);
            // var_dump($response); exit;
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
        return $response;
    }

    public function time_clock_locs() {
        $this->load->model('TimeClockModel', 'model');
        $results = $this->model->get_clock_locations();
        //        foreach ($results as $result) {
        ////            $result->location = '';
        //            $result->location = $this->lat_lng_to_loc(json_decode($result->location)->lat, json_decode($result->location)->lng);
        ////            var_dump($result);
        ////            var_dump(json_decode($result->location)->lat);
        //        }
        //        exit;
        //        var_dump($results); exit;
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
                return redirect('TimeClock/time_clock_locs');
            }
        } else {
            $this->load->view('admin/common/header');
            $this->load->view('admin/time_clock/search_loc', ['slug_for_js' => $slug_for_js]);
            $this->load->view('admin/common/footer');
        }
    }

    public function terminal_links() {
        $terminals = $this->model->get_terminal_links();
        /*
        foreach ($terminals as $terminal) {
        $terminal->t_location = $this->lat_lng_to_loc(
        json_decode($terminal->t_location)->lat, json_decode($terminal->t_location)->lng
        );
        }*/
        //        var_dump($terminals);
        //        exit;
        $this->load->view('admin/common/header');
        $this->load->view('admin/time_clock/terminal_links', ['terminals' => $terminals]);
        $this->load->view('admin/common/footer');
    }

    public function generate_terminal_link() {
        $positions = $this->model->get_all_positions();
        //        foreach($locations as $location){
        //            $location->location = $this->lat_lng_to_loc(
        //                    json_decode($location->location)->lat,
        //                    json_decode($location->location)->lng
        //            );
        //        }
        //        exit;
        //        var_dump($locations); exit;
        $this->form_validation->set_rules(
            'position_id',
            'Position',
            'callback_position_check'
        );
        //        $this->form_validation->set_rules(
        //                'location_id',
        //                'Location',
        //                'callback_location_check');
        if ($this->form_validation->run()) {
            $data = array(
                'position_id' => $this->input->post('position_id'),
            );
            $response = $this->model->add_terminal_link($data);
            if ($response) {
                $this->session->set_flashdata('success_msge', 'Terminal link added successfully!');
                return redirect('TimeClock/terminal_links');
            }
        } else {
            $this->load->view('admin/common/header');
            $this->load->view('admin/time_clock/generate_link', [
                'positions' => $positions,
            ]);
            $this->load->view('admin/common/footer');
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
        if ($str == '') {
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
        // var_dump($monthly_salary) . '<br>';
        $day = $interval->format('%d');
        // var_dump($day);

        $hour = $interval->format('%h');
        // var_dump($hour);

        $minutes = $interval->format('%m');
        // var_dump($minutes);
        // exit;

        $days_to_hours = $day * 24;

        $hours = $interval->format('%h') + $days_to_hours;
        $ts_from_hours = $hours * 60 * 60;

        $minutes = $interval->format('%i');
        $ts_from_minutes = $minutes * 60;
        $seconds = $interval->format('%s');
        $total_seconds = (int)$ts_from_hours + (int)$ts_from_minutes + (int)$seconds;
        // var_dump($total_seconds); exit;
        if ($salary_type == 'monthly') {
            $per_day_salary = (double)$monthly_salary / 30;
            // echo $per_day_salary; exit;
            $per_hour_salary = (double)$per_day_salary / (int)$daily_hours;
            // echo $per_hour_salary; exit;
            $per_minute_salary = (double)$per_hour_salary / 60;
            $per_second_salary = (double)$per_minute_salary / 60;
            $one_clock_salary = $total_seconds * $per_second_salary;
            //            return $one_clock_salary;
        } elseif ($salary_type === 'wages') {
            $per_minute_salary = $per_hour_salary / 60;
            $per_second_salary = $per_minute_salary / 60;
            $one_clock_salary = $total_seconds * $per_second_salary;
            //            return $one_clock_salary;
        }

        // ---------------------------------------------------------
        $clk_counter_indexes = $this->model->get_clk_day_counter_details($emp_id, $insert_id);
        // echo '<pre>';
        // print_r($clk_counter_indexes);
        // exit;
        $results = $this->model->overtime_plus_leave_details($clock_details);
        $special_hours = json_decode($results->hrly_rate_chart)->special_hours;
        // echo '<pre>';
        // print_r($special_hours);

        $clock_in_hour = (int)date('H', strtotime($start_date));
        $clock_in_day = date('D', strtotime($start_date));

        $clock_out_hour = (int)date('H', strtotime($end_date));

        $clock_out_minutes = (int)date('m', strtotime($end_date));
        $clock_out_seconds = (int)date('s', strtotime($end_date));
        $clock_out_day = date('D', strtotime($end_date));

        // var_dump($clock_out_minutes);
        // var_dump($clock_out_seconds);
        $special_over_time = 0;

        // var_dump(date('D', strtotime($start_date)));
        // var_dump( date( 'h:i:s', strtotime($employee->emp_clock_out) ).' out' );

        // var_dump(date('H', strtotime($start_date)));
        // var_dump(date('H', strtotime($start_date)));

        // for($i = $clock_in_hour; $i <= $clock_out_hour; $i++; ){
        // }
        $matched_hour = null;
        // var_dump($clock_in_hour);
        // var_dump($clock_out_hour);
        // exit;
        $from_date = new DateTime($start_date);
        $to_date = new DateTime($end_date);

        // for ($date = $from_date; $date <= $to_date; $date->modify('+1 day')) {
        //     echo $date->format('l') . "\n";
        // }

        // $minutes = array();
        // while (strtotime($start_date) <= strtotime($end_date)) {
        //     $minutes[] = date('H:i:s', strtotime($start_date));
        //     $start = date('H:i:s', strtotime(' + 1 hour', strtotime($start_date)));
        // }
        // var_dump($minutes);
        // exit;
        $last_counter = null;
        // var_dump($start_date); exit;
        if ($clk_counter_indexes) {
            $clock_in_obj = $start_date;
            // echo 'special times of foreach \n';
            foreach ($clk_counter_indexes as $counter) {
                $special_over_time += $this->special_hours_counter(
                    $clock_in_hour,
                    $special_hours,
                    $clock_in_day,
                    $per_hour_salary,
                    24,
                    $clock_in_obj,
                    null
                );
                $clock_in_obj = null;
                $clock_in_hour = 0;
                $last_counter = $counter;
                // echo '<h1>';
                // echo $special_over_time;
                // echo '</h1>';
            }
            // exit;

            // -----------------------------------------------------------
            // exit;
            $last_counter = (int)date('H', strtotime($last_counter->clock_time));
            // echo '<pre>';
            // print_r($last_counter);
            // echo 'last counter';
            // exit;
            $special_over_time += $this->special_hours_counter(
                $clock_in_hour,
                $special_hours,
                $clock_in_day,
                $per_hour_salary,
                $clock_out_hour,
                null,
                $end_date
            );
            // echo 'all special times \n';
            // echo '<h2>'.$special_over_time.'</h2>';
        } else {
            $special_over_time = $this->special_hours_counter(
                $clock_in_hour,
                $special_hours,
                $clock_in_day,
                $per_hour_salary,
                $clock_out_hour
            );
        }
        $one_clock_salary += $special_over_time;
        // echo '<h2> one clock salary: '.$one_clock_salary.'</h2>';
        // exit;
        $response = $this->model->update_per_clk_salary(
            $one_clock_salary,
            $insert_id
        );
        if ($response) {
            return $response;
        } else {
            return false;
        }
    }

    public function delete_location($id) {
        //        var_dump($id); exit;
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
        return redirect('TimeClock/time_clock_locs');
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
        $counter = 24,
        $clock_in_obj = null,
        $clock_out_obj = null
    ) {
        $special_over_time = 0;
        // echo '<pre>';
        // print_r($clock_in_hour);
        // echo 'Clock in hour printed';
        
        
        // else{
        //     echo '<pre>';
        //     print_r($clock_out_obj);
        //     echo '<br>';
        //     echo 'Clock out object printed \n';
        // }
        for ($i = (int)$clock_in_hour; $i < $counter; $i++) {
                // var_dump($i);
            foreach ($special_hours as $key => $special_hour) {
                    // var_dump($key);
                $position = strpos($key, strtolower($clock_in_day));
                    // echo 'position is';
                    // var_dump($position);
                    // exit;
                if ($position) {
                    $matched_hour = $this->numExtracter($key);
                        // var_dump($matched_hour);
                        // exit;
                    if ($i == $matched_hour) {
                        $special_hour = $this->numExtracter($special_hour);
                        // var_dump(strtolower($key));
                        // echo '<pre>';
                        // print_r($special_hour); exit;
                        if($clock_in_obj != null){
                            // echo '<pre>';
                            // print_r($clock_in_obj);
                            // echo '<br>';
                            // echo 'Clock in object printed \n';

                            $clock_in_mins = (int)date('m', strtotime($clock_in_obj));
                            $clock_in_secs = $clock_in_mins * 60;
                            $clock_in_secs += (int)date('s', strtotime($clock_in_obj));
                            $total_clock_in_secs = 3600 - $clock_in_secs;


                            $special_hour = $special_hour - 100;    
                            $over_time = $per_hour_salary * $special_hour;
                            $over_time = $over_time / 100;

                            $per_minute_over_time = $over_time/60;
                            $per_second_over_time = $per_minute_over_time/60;
                            
                            $over_time = $per_second_over_time * $total_clock_in_secs;
                            $special_over_time += $over_time;     
                            
                        }
                        
                        $special_hour = $special_hour - 100;    
                        $over_time = $per_hour_salary * $special_hour;
                        $special_over_time += $over_time / 100;
                        
                        if($clock_out_obj != null){
                            // echo '<pre>';
                            // print_r($clock_out_obj);
                            // echo '<br>';
                            // echo 'Clock out object printed \n';
                            $clock_out_mins = (int)date('m', strtotime($clock_out_obj));
                            $clock_out_secs = (int)date('s', strtotime($clock_out_obj));
                        }
                    }
                }
            }
                // exit;
                // if ($i > $clock_out_hour) {
                //     echo 'and original value of clock out hour is: ' . $i . '<br>';
                //     echo 'exiting from this hour: ' . $matched_hour;
                //     // var_dump();
                // }
        }
        return $special_over_time;
    }
}
