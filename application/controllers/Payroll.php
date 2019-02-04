<?php
class Payroll extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('PayrollModel', 'model');
    }

    public function index(){
        $response = $this->model->get_all_payroll();
        foreach($response as $employee){
            $breaks = array();
            $days = 0;
            $hours = 0;
            $minutes = 0;
            $seconds = 0;

            $emp_breaks = $this->model->get_single_user_breaks($employee->breaks);
            foreach($emp_breaks as $break){
                $break_in = new DateTime($break->break_in);
                $break_out = new DateTime($break->break_out);
                $interval = date_diff($break_in, $break_out);
                $breaks[] = array(
                    'd' => $interval->format('%d'),
                    'h' => $interval->format('%h'),
                    'i' => $interval->format('%i'),
                    's' => $interval->format('%s'),
                ); 
                $days += intval($interval->format('%d'));
                $hours += intval($interval->format('%h'));
                $minutes += intval($interval->format('%i'));
                $seconds += intval($interval->format('%s'));
            }
            $employee->total_break = array(
                'd' => $days,
                'h' => $hours,
                'i' => $minutes,
                's' => $seconds,
            );
            $employee->new_breaks = $breaks;
        }
        // echo "<pre>"; print_r($response); exit;  
        $this->load->view('admin/common/header');
        if($this->is_admin()){
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
            // var_dump($this->input->post()); exit;    
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
            
            $arrivel_time = $this->input->post('arrivel_time');
            $arrivel_time = $this->set_time_to_db($arrivel_time);
            
            $fine_time = $this->input->post('fine_time');
            $fine_time = $this->set_time_to_db($fine_time);
            
            $data = array(
                'card_title' => $this->input->post('payroll_title'),
                'daily_hours' => $this->input->post('daily_hours'),
                'hrly_rate_chart' => json_encode($hrly_rate_chart),
                'pay_rate' => $this->input->post('pay_rate'),
                'arrivel_time'  => $arrivel_time,
                'fine_time'  => $fine_time,
                'deduct_hours'  => $this->input->post('deduct_hours'),
            );
            // var_dump($id); exit;
            if( $id === '' ){
                $response = $this->model->add_rate_card($data);
                if($response){
                    $this->session->set_flashdata(
                        'success_msge',
                        'Rate card added successfully!'
                    );
                }else{
                    $this->session->set_flashdata(
                        'error_msge',
                        'Unable to add ratecard.'
                    );
                }
            }else{
                $response = $this->model->update_rate_card($data, $id);
                $this->session->set_flashdata(
                    'success_msge',
                    'Rate card updated successfully!'
                );
            }
            if ($response) {
                $this->model->get_all_rate_cards();
                return redirect('ratecard');
            }
        } else {
            $result = $this->model->get_rate_card($id);
            $this->load->view('admin/common/header');
            if(isset($result->arrivel_time)){
                $result->arrivel_time = $this->get_time_from_db($result->arrivel_time);
            }
            if(isset($result->fine_time)){
                $result->fine_time = $this->get_time_from_db($result->fine_time);
            }
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
        return redirect('ratecard');
    }

}
