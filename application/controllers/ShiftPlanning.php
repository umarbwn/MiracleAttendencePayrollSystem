<?php

class ShiftPlanning extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('ShiftPlanningModel', 'model');
    }

    public function index() {
        $results = $this->model->get_all_positions();
//        var_dump($results); exit;
        $this->load->view('admin/common/header');
        $this->load->view('admin/shift_planning/index',
                ['positions' => $results]);
        $this->load->view('admin/common/footer');
    }

    public function add_position() {
        $terminals = $this->model->get_terminal_locs();
        $this->form_validation->set_rules(
                'pos_name', 'Position name', 'required');

        $this->form_validation->set_rules(
                'pos_location', 'Location', 'callback_location_check');

        if ($this->form_validation->run()) {
            $data = array(
                'name' => $this->input->post('pos_name'),
                'location' => $this->input->post('pos_location'),
            );
//            var_dump($data); exit;
            $response = $this->model->add_position($data);
            if ($response) {
                $this->session->set_flashdata('success_msge', 'Position added successfuly!');
                return redirect('ShiftPlanning/index');
            }
        } else {
//            var_dump($terminals); exit;
            $this->load->view('admin/common/header');
            $this->load->view('admin/shift_planning/add', ['terminals' => $terminals]);
            $this->load->view('admin/common/footer');
        }
    }

    public function location_check($str) {
        if ($str == '') {
            $this->form_validation->set_message('location_check', 'Please select the terminal location');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    
}
