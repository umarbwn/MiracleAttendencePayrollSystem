<?php
class RestAPIs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RestAPIsModel', 'model');
    }
    public function add_timeclock()
    {
        $this->form_validation->set_rules(
            'emp_clock_in',
            'Clock in date',
            'required'
        );
        $this->form_validation->set_rules(
            'emp_loc',
            'Clock in location',
            'required'
        );
        $this->form_validation->set_rules(
            'emp_id',
            'Employee id',
            'required|integer'
        );
        $this->form_validation->set_rules(
            'emp_image',
            'Clock in image',
            'required'
        );

        $config['upload_path'] = './uploads/staff/employees';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['overwrite'] = true;

        $this->load->library('upload', $config);
        $data = $error = "";

        if ($this->form_validation->run() == true && $this->upload->do_upload('emp_image') == TRUE) {
            $emp_clock_in = $this->input->post('emp_clock_in');
            $emp_loc = $this->input->post('emp_loc');
            $emp_id = $this->input->post('emp_id');
            $clock_in_img = $this->input->post('emp_image');
            
            // if (!is_dir('./uploads/staff/emp_clock_in_out/' . $emp_id)) {
            //     mkdir('./uploads/staff/emp_clock_in_out/' . $emp_id, 0777, true);
            // }
            $data = array(
                'emp_clock_in' => $emp_clock_in,
                'emp_loc' => $emp_loc,
                'emp_id' => $emp_id,
                'clock_in_img' => $clock_in_img,
            );
            $response = $this->model->add_time_clock($data);
            $data['response'] = array();
            if ($response) {
                $data['response'] = 'success';
            } else {
                $data['response'] = 'error';
            }
            echo json_encode($data);
        } else {
            // echo json_encode(validation_errors());
            // $errors = array(
            //     'emp_clock_in' => error_array('emp_clock_in'),
            //     'emp_clock_out' => error_array('emp_clock_out'),
            //     'emp_loc' => error_array('emp_loc'),
            //     'emp_id' => error_array('emp_id'),
            //     'clock_in_img' => error_array('clock_in_img'),
            //     'clock_out_img' => error_array('clock_out_img'),
            //     'emp_clock_out_loc' => error_array('emp_clock_out_loc'),
            //     'clock_pay' => error_array('clock_pay'),
            //     'status' => error_array('status')
            // );
            $errors = $this->form_validation->error_array();
            echo json_encode($errors);
        }
    }
    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile')){
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            echo json_encode($data);
        }
    }

    public function auth_user(){
        $email = $this->input->post("email");
        $password = base64_encode($this->input->post("password"));
        $data = array(
            'email_addr' => $email_addr,
            'password' => $password,
        );
        $response = $this->model->auth_user($data);
    }
}
