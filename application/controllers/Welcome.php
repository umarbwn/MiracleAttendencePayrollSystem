<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('WelcomeModel', 'model');
	}
	public function index(){
	    $employees = $this->model->get_all_online_users();
		$notices = $this->model->get_all_notices();
		// var_dump($employees);
		$this->load->view('admin/common/header');
		$this->load->view('admin/dashboard/index', [
			'employees' => $employees,
			'notices' 	=> $notices
		]);
		$this->load->view('admin/common/footer');
		$this->load->view('admin/dashboard/dialoge_modal');
	}

	public function inbox(){
		$this->load->view('admin/common/header');
		$this->load->view('admin/dashboard/inbox');
		$this->load->view('admin/common/footer');
	}

	public function add_notice(){
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');

		$data['errors'] = array(
			"name" 			=> "",
			"description"	=> ""
		);

		if($this->form_validation->run()){
			// echo 'validation success';
			// var_dump($this->input->post());

			$data = array(
				'name' 			=> $this->input->post('name'),
				'description' 	=> $this->input->post('description')
			);
			$response = $this->model->add_notice($data);
			if($response){
				$data['success'] = true;
				$this->session->set_flashdata('success_msge', 'New notice added successfully!');
				// return redirect('Welcome');
			}else{
				$data['success'] = false;
			}
		}else{
			$data['errors'] = array(
				'name' => form_error('name', '<span class="form-error">', '</span>'),
				'description' => form_error('description', '<span class="form-error">', '</span>'),
			);
		}
		echo json_encode($data);

	}

	public function delete_notice($id){
		$response = $this->model->delete_notice($id);
		if($response){
			$this->session->set_flashdata('success_msge', 'New notice deleted successfully!');
			return redirect('Welcome');
		}else{
			$this->session->set_flashdata('error_msge', 'Unable to delete!');
		}
	}

	public function get_single_notice($id){
		$response = $this->model->get_single_notice($id);
		$data['data'] = array(
			'id'	=> $response->id,
			'name'	=> $response->name,
			'description'	=> $response->description
		);
		echo json_encode($data);
	}
}