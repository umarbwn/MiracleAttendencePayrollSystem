<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model();
	}
	public function index(){
		
		$this->load->view('admin/common/header');
		$this->load->view('admin/dashboard/index');
		$this->load->view('admin/common/footer');
	}

	public function inbox(){
		$this->load->view('admin/common/header');
		$this->load->view('admin/dashboard/inbox');
		$this->load->view('admin/common/footer');
	}
}
