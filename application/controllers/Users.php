<?php
class Users extends CI_Controller{
    public function index(){
        $this->load->model('UserModel', 'model');
        $admin_exists = $this->model->if_exist_superadmin();
        if(empty($admin_exists)){
            $this->super_admin();
        }else{
            $this->load->view('admin/staff/login');
        }
    }
    public function emp_login(){
        $this->form_validation->set_rules('email_addr', 'Email address', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run()){
            $data = array(
                'email_addr' => $this->input->post('email_addr'),
                'password' => $this->input->post('password'),
            );
            $this->load->model('UserModel', 'model');
            $response = $this->model->validate_emp_login($data);
            if($response){
                $session_data = array(
                    'id'            => $response->id,
                    'name'          => $response->first_name.' '.$response->last_name,
                    'phone_no'      => $response->phone_no,
                    'emp_image'     => $response->emp_image,
                    'role'          => $response->role,
                    'email_addr'    => $response->email_addr
                );
                // var_dump($response); exit;
                // $cookie = array([
                //     'name'      => 'remember_me',
                //     'value'     => $response->email_addr,

                // ]);
                // $this->input->set_cookie($cookie);
                $this->session->set_userdata('user_id', $session_data);
                return redirect('Welcome');
            }else{
                $this->session->set_flashdata('invalid_login', 'Invalid Username/Password!');
                $this->index();
            }
        }else{
            $this->index();
        }
    }
    public function super_admin(){
            // var_dump($this->input->post('emp_image')); exit;
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('phone_no', 'Phone #', 'required|min_length[11]|max_length[11]|numeric');
            $this->form_validation->set_rules('email_addr', 'Email', 'valid_email|is_unique[employees.email_addr]');

            $config['upload_path']          = './uploads/staff/employees';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2000;
            $config['max_width']            = 1920;
            $config['max_height']           = 1080;
            $config['overwrite']            = TRUE;


            $this->load->library('upload', $config);
            
            $data = $error = "";

            if($this->form_validation->run() == TRUE && $this->upload->do_upload('emp_image')){
                $data = array(
                    'first_name'    => $this->input->post('first_name'),
                    'last_name'     => $this->input->post('last_name'),
                    'email_addr'    => $this->input->post('email_addr'),
                    'phone_no'      => $this->input->post('phone_no'),
                    'password'      => base64_encode($this->input->post('admin_password')),
                    'emp_image'     => $this->upload->data()['file_name'],
                    'role'          => 'superadmin'
                );
                // var_dump($data); exit;
                $this->load->model('StaffModel', 'model');
                $response = $this->model->add_employee($data);
                if($response){
                    $this->session->set_flashdata('success_msge', 'Employee added successfully!');
                    return redirect('Staff/index');
                }
            }else{
                $error = array('error' => $this->upload->display_errors('<span class="form-error">', '</span>'));
                // var_dump($error); exit;
                $this->load->view('admin/superadmin/register', ['error' => $error['error']]);
            }
        }
    public function logout_user(){
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('attendence_data');
        return redirect('Users');
    }
}