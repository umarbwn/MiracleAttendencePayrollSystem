<?php

class Staff extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('StaffModel', 'model');
    }

    public function index()
    {
        $result = $this->model->get_all_employees();
        // var_dump($result); exit;
        $this->load->view('admin/common/header');
        $this->load->view('admin/staff/index', ['employees' => $result]);
        $this->load->view('admin/common/footer');
    }

    public function add_employee($id = ""){
        if(!empty($this->input->post("update_id"))){
            $id = $this->input->post("update_id");
        }
        $this->form_validation->set_rules(
            'first_name', 'First Name', 'required');
        $this->form_validation->set_rules(
            'last_name', 'Last Name', 'required');
        
        if($id === ""){
            // echo 'coming in if'; exit;
            $this->form_validation->set_rules(
                'phone_no', 'Phone #', 'required|min_length[11]|max_length[11]|numeric|is_unique[employees.phone_no]');
            $this->form_validation->set_rules(
                'email_addr', 'Email', 'valid_email|is_unique[employees.email_addr]');
        }else{
            $this->form_validation->set_rules(
                'phone_no', 'Phone #', 'required|min_length[11]|max_length[11]|numeric');
            $this->form_validation->set_rules(
                'email_addr', 'Email', 'valid_email');
        }
        $this->form_validation->set_rules(
            'position', 'Position', 'callback_position_check');
        $this->form_validation->set_rules(
            'payroll_card', 'Position', 'callback_payroll_card_check');
        $this->form_validation->set_rules(
            'salary_type', 'Salary Type', 'callback_salary_type_check');

        if ($this->input->post('salary_type') == 'wages') {
            $this->form_validation->set_rules(
                'per_hour_amount',
                'Per Hour Amount',
                'required'
            );
        }elseif ($this->input->post('salary_type') == 'monthly'){
            $this->form_validation->set_rules(
                'monthly_salary',
                'Monthly Salary',
                'required'
            );
            $this->form_validation->set_rules(
                'leave_condition',
                'Monthly Condition',
                'required'
            );
        }

        $config['upload_path'] = './uploads/staff/employees';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2000;
        $config['max_width'] = 2000;
        $config['max_height'] = 2000;
        $config['overwrite'] = true;

        $this->load->library('upload', $config);
        $data = $error = "";
        $insert_id = "";
        if ($this->form_validation->run() === true && $this->upload->do_upload('emp_image') === TRUE) {
            $old_name = $this->upload->data()['orig_name'];
            $file_ext = $this->upload->data()['file_ext'];

            $emp_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email_addr' => $this->input->post('email_addr'),
                'phone_no' => $this->input->post('phone_no'),
                'password' => base64_encode(
                    $this->input->post('user_password')
                ),
                'emp_image' => $this->upload->data()['file_name'],
                'position' => $this->input->post('position'),
                'payroll_card' => $this->input->post('payroll_card'),
            );
            $leaves_data = array(
                'paid_leaves' => $this->input->post('leaves'),
                'leave_condition' => $this->input->post('leave_condition'),
            );
            $pays_data = array(
                'salary_type' => $this->input->post('salary_type'),
                'monthly_salary' => $this->input->post('monthly_salary'),
            );
            $data = array(
                'emp_data' => $emp_data,
                'leaves_data' => $leaves_data,
                'pays_data' => $pays_data
            );
            $msge = "";
            if($id === ""){
                $insert_id = $this->model->add_employee($data);
                $msge = 'Employee added successfully!';
            }else{
                $insert_id = $this->model->update_employee($id, $data);
                $msge = 'Employee updated successfully!';
            }
            $new_name = 'employee' . $insert_id . $file_ext;
            rename('./uploads/staff/employees/' . $old_name, './uploads/staff/employees/' . $new_name);
            $new_name = array(
                'emp_image' => $new_name,
            );
            $response = $this->model->update_emp_img_name( $new_name, $insert_id );
            if ($response) {
                $this->session->set_flashdata('success_msge', $msge);
                return redirect('Staff/index');
            }
        } else {
            $employee = "";
            if($id !== ""){
                $employee = $this->model->get_single_employee($id);
                $employee->position = $this->model->get_single_postion($employee->position);
                $employee->payroll_card = $this->model->get_single_payroll_card($employee->payroll_card);
                // var_dump($employee); exit;
            }
            $positions = $this->model->get_all_positions();
            $payroll_cards = $this->model->get_all_payroll_cards();
            $error = array('error' => $this->upload->display_errors(
                '<span class="form-error">', '</span>'));
            $this->load->view('admin/common/header');
            if($id === ""){
                $this->load->view('admin/staff/add', [
                    'image_error' => $error['error'],
                    'positions' => $positions,
                    'payroll_cards' => $payroll_cards,
                ]);
            }else{
                $this->load->view('admin/staff/update', [
                    'image_error' => $error['error'],
                    'positions' => $positions,
                    'payroll_cards' => $payroll_cards,
                    "employee" => $employee,
                    'update_id' => $id,
                ]);
            }
            $this->load->view('admin/common/footer');
        }
    }
    public function update_employee($id = ""){
        $this->add_employee($id);
    }
    public function view_emp_profile($id)
    {
        $response = $this->model->get_single_employee($id);
        $this->load->view('admin/common/header');
        $this->load->view('admin/staff/view_emp_profile', ['employee' => $response]);
        $this->load->view('admin/common/footer');
    }

    // public function update_employee($id){
    //     $response = $this->model->get_single_employee($id);
    //     $positions = $this->model->get_all_positions();
    //     $payroll_cards = $this->model->get_all_payroll_cards();
    //     // var_dump($response); exit;
    //     if($this->form_validation->run() === TRUE && $this->upload->do_upload('emp_image')){

    //     }else{
    //         $error = array(
    //             'error' => $this->upload->display_errors(
    //                 '<span class="form-error">', '</span>'
    //             )
    //         );
    //         $this->load->view("admin/common/header");
    //         $this->load->view("admin/staff/update",[
    //             'employee' => $response,
    //             'image_error' => $error['error'],
    //             'positions' => $positions,
    //             'payroll_cards' => $payroll_cards,
    //         ]);
    //         $this->load->view("admin/common/footer");
    //     }
    // }

    public function position_check($str)
    {
        if ($str == '') {
            $this->form_validation->set_message('position_check', 'Please select the employee position');
            return false;
        } else {
            return true;
        }
    }
    public function payroll_card_check($str)
    {
        if ($str == '') {
            $this->form_validation->set_message(
                'payroll_card_check', 'Please select payroll card');
            return false;
        } else {
            return true;
        }
    }
    public function salary_type_check($str)
    {
        if ($str == '') {
            $this->form_validation->set_message(
                'salary_type_check', 'Please select salary type!');
            return false;
        } else {
            return true;
        }
    }

    public function delete_employee($id)
    {
        //     var_dump($id); exit;
        //        $img_id = $this->
        $response = $this->model->delete_clock_counter($id);
        if($response){
            $data = $this->model->delete_employee($id);
            if ($data['response']) {
                $this->load->helper('file');
                delete_files('uploads/staff/emp_clock_in_out/' . $id, true);
                if (file_exists('uploads/staff/emp_clock_in_out/' . $id)) {
                    rmdir('uploads/staff/emp_clock_in_out/' . $id);
                }
                unlink('uploads/staff/employees/' . $data['image_name']->emp_image);
                $this->session->set_flashdata('success_msge', 'Employee delete successfully!');
                return redirect('Staff/index');
            }
        }else{
            echo '<h1 class="text-center">Unable to delete employee</h1>';
        }
    }

}
