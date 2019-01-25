<?php
class Payroll extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PayrollModel', 'model');
    }

    public function index()
    {
        $response = $this->model->get_all_payroll();
        //        foreach($response as $employee){
        //            $lat = json_decode($employee->t_loc)->lat;
        //            $lng = json_decode($employee->t_loc)->lng;
        ////            $employee->t_loc =
        //            $employee->t_loc = $this->lat_lng_to_loc($lat, $lng);
        ////            var_dump($employee->t_loc); exit;
        //
        //        }
        //        var_dump($response); exit;
        //        foreach ($response as $employee) {
        //            $date_a = new DateTime($employee->emp_clock_in);
        //            $date_b = new DateTime($employee->emp_clock_out);
        //            $interval = date_diff($date_a, $date_b);
        //
        //            $hours = $interval->format('%h');
        //            $ts_from_hours = $hours * 60 * 60;
        //
        //            $minutes = $interval->format('%i');
        //            $ts_from_minutes = $minutes * 60;
        //
        //            $seconds = $interval->format('%s');
        //            $total_seconds = $ts_from_hours + $ts_from_minutes + $seconds;
        //
        //            $employee->total_time = $total_seconds;
        //        }
        $this->load->view('admin/common/header');
        if(parent::$is_admin){
            $this->load->view('admin/payroll/index', ['employees' => $response]);
        }else{
            $this->load->view('admin/payroll/user/index');
        }
        $this->load->view('admin/common/footer');
    }

    public function add_rate_card($id = '')
    {
        // var_dump($id); exit;
        // var_dump($this->input->post()); exit;
        if( !empty( $this->input->post('id') ) ){
            $id = $this->input->post('id');
        }
        $this->form_validation->set_rules(
            'payroll_title', 'Payrol Title', 'required');
        $this->form_validation->set_rules(
            'pay_rate', 'Pay Rate', 'required');
        $salary_type = $this->input->post('salary_type');
        if ($this->form_validation->run()) {
            $hrly_rate_chart = array(
                'sun0' => $this->input->post('sun0'),
                'mon0' => $this->input->post('mon0'),
                'tue0' => $this->input->post('tue0'),
                'wed0' => $this->input->post('wed0'),
                'thu0' => $this->input->post('thu0'),
                'fri0' => $this->input->post('fri0'),
                'sat0' => $this->input->post('sat0'),
                'sun0pm' => $this->input->post('sun0pm'),
                'mon0pm' => $this->input->post('mon0pm'),
                'tue0pm' => $this->input->post('tue0pm'),
                'wed0pm' => $this->input->post('wed0pm'),
                'thu0pm' => $this->input->post('thu0pm'),
                'fri0pm' => $this->input->post('fri0pm'),
                'sat0pm' => $this->input->post('sat0pm'),
            );
            $am_days = array();
            $pm_days = array();
            $special_hours = array();
            foreach($this->input->post() as $key => $input){
                if( strpos($key, 'am_') ){
                    // var_dump($key);
                    $am_days[$key] = $input;
                    if((int)$input > 100 || (int)$input < 100){
                        $special_hours[$key] = $input;
                    }
                }elseif (strpos($key, 'pm_')) {
                    // var_dump($key);
                    $pm_days[$key] = $input;
                    if ((int) $input > 100 || (int) $input < 100) {
                        $special_hours[$key] = $input;
                    }
                }
                
            }
            // var_dump($special_hours);
            
            // var_dump($pm_days);
            // exit;
            $hrly_rate_chart['special_hours'] = $special_hours;
            $data = array(
                'card_title' => $this->input->post('payroll_title'),
                'daily_hours' => $this->input->post('daily_hours'),
                'hrly_rate_chart' => json_encode($hrly_rate_chart),
                'pay_rate' => $this->input->post('pay_rate'),
            );
            // var_dump($id); exit;
            if( $id === '' ){
                $this->session->set_flashdata(
                    'success_msge',
                    'Rate card added successfully!'
                );
                $response = $this->model->add_rate_card($data);
            }else{
                $response = $this->model->update_rate_card($data, $id);
                $this->session->set_flashdata(
                    'success_msge',
                    'Rate card updated successfully!'
                );
            }
            if ($response) {
                $this->model->get_all_rate_cards();
                return redirect('Payroll/get_all_rate_cards');
            }
        } else {
            $result = $this->model->get_rate_card($id);
            $this->load->view('admin/common/header');
            // var_dump($row); exit;
            $this->load->view('admin/payroll/add_rate_card', [
                'rate_card' => $result
            ]);
            $this->load->view('admin/common/footer');
        }
    }

    public function get_all_rate_cards()
    {
        $rate_cards = $this->model->get_all_rate_cards();
        $this->load->view('admin/common/header');
        $this->load->view('admin/payroll/all_rate_cards', [
            'rate_cards' => $rate_cards,
        ]);
        $this->load->view('admin/payroll/dialoge_modal');
        $this->load->view('admin/common/footer');
    }

    public function delete_rate_card($id)
    {
        $response = $this->model->delete_payrol_card($id);
        // var_dump($response); exit;
        if($response === 'exists'){
            $this->session->set_flashdata('error_msge', 'Unable to delete Rate Card. Because employees are using it!');
        }else{
            $this->session->set_flashdata('success_msge', 'Rate card deleted successfully!');
        }
        return redirect('Payroll/get_all_rate_cards');
    }

}
