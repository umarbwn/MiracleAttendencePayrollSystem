<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// exec('echo -e "`crontab -l`\n0 9 * * * /path/to/script/2" | crontab -');
		// exec("echo -e crontab -u mobman -l | grep -v '/path/to/script/2'  | crontab -u mobman -");
		// echo exec('crontab -r');
		// $output = shell_exec('crontab -e');
		// echo '<pre>';
		// print_r($output);
		// exit;
		$this->load->view('admin/common/header');
		$this->load->view('admin/dashboard/index');
		$this->load->view('admin/common/footer');
	}
}
