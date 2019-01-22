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
            'emp_clock_out',
            'Clock out date',
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
            'clock_in_img',
            'Clock in image',
            'required'
        );
        $this->form_validation->set_rules(
            'clock_out_img',
            'Clock out image',
            'required'
        );
        $this->form_validation->set_rules(
            'emp_clock_out_loc',
            'Clock out location',
            'required'
        );
        $this->form_validation->set_rules(
            'clock_pay',
            'Clock pay',
            'required|numeric'
        );
        $this->form_validation->set_rules(
            'status',
            'Clock status',
            'required|integer'
        );


        $config['upload_path'] = './uploads/staff/employees';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['overwrite'] = true;

        $this->load->library('upload', $config);
        $data = $error = "";

        if ($this->form_validation->run() == true && $this->upload->do_upload('clockin_image')) {
            // echo 'validated';
            $data = array(
                'emp_clock_in' => $this->input->post('emp_clock_in'),
                'emp_clock_out' => $this->input->post('emp_clock_out'),
                'emp_loc' => $this->input->post('emp_loc'),
                'emp_id' => $this->input->post('emp_id'),
                'clock_in_img' => $this->input->post('clock_in_img'),
                'clock_out_img' => $this->input->post('clock_out_img'),
                'emp_clock_out_loc' => $this->input->post('emp_clock_out_loc'),
                'clock_pay' => $this->input->post('clock_pay'),
                'status' => $this->input->post('status')
            );
            // $this->input->post();
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
            $errors = array(
                'emp_clock_in' => form_error('emp_clock_in', '<span>', '</span>'),
                'emp_clock_out' => form_error('emp_clock_out', '<span>', '</span>'),
                'emp_loc' => form_error('emp_loc', '<span>', '</span>'),
                'emp_id' => form_error('emp_id', '<span>', '</span>'),
                'clock_in_img' => form_error('clock_in_img', '<span>', '</span>'),
                'clock_out_img' => form_error('clock_out_img', '<span>', '</span>'),
                'emp_clock_out_loc' => form_error('emp_clock_out_loc', '<span>', '</span>'),
                'clock_pay' => form_error('clock_pay', '<span>', '</span>'),
                'status' => form_error('status', '<span>', '</span>')
            );
            echo json_encode($errors);
        }
    }
}
