<?php
require_once('Geocoding.php');

use myPHPnotes\Geocoding;

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('UserModel', 'model');
        // $admin_exists = $this->model->if_exist_superadmin();
        // var_dump($admin_exists); exit;
        //  var_dump($this->session->userdata('attendence_user')); exit;
        if (!$this->session->userdata('user_id')) {
            return redirect('Users');
        }
        $this->session->set_flashdata('active_slug', $this->active_slug());
    }
    public function active_slug()
    {
        $uri = $this->uri->segment(1);
        return $uri;
    }
    public function lat_lng_to_loc($lat, $lng)
    {
        $geo = new Geocoding('AIzaSyDZUGQeUX65hAXw-vH0z5EWlnbpjl-y5Gk');
        $address = $geo->getAddress($lat, $lng);
        return $address;
    }

    public function numExtracter($str){
        preg_match_all('!\d+!', $str, $matches);
        $num = (int)$matches[0][0];
        return $num;
    }
}