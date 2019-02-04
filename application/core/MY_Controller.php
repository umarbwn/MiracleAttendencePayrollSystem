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
        $this->session->set_flashdata('is_admin', $this->is_admin());
        $this->session->set_flashdata('active_slug', $this->active_slug());
    }
    public function is_admin(){
        $is_admin = $this->session->userdata('user_id')['role'] == '' ? null : $this->session->userdata('user_id')['role'];
        return $is_admin;
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

    public function get_gooogle_map_url(){
        $data["google_map_api_url"] = $this->config->item("google_map_api_url");
        $data["google_map_api_private_key"] = $this->config->item("google_map_api_public_key");
        $data["url"] = $data["google_map_api_url"].$data["google_map_api_private_key"];
        return $data;
    }

    public function set_time_to_db($arrivel_time){
        $arrivel_time = explode(" ", $arrivel_time);
        if($arrivel_time[1] === 'PM'){
            $arrivel_time[0] = explode(":", $arrivel_time[0]);
            // var_dump(intval($arrivel_time[0][0])); exit;
            if($arrivel_time[0][0] === "12"){
                $arrivel_time[0][0] = 12 - intval($arrivel_time[0][0]);
                $arrivel_time[0][0] = $arrivel_time[0][0]."0";
            }else{
                $arrivel_time[0][0] = 12 + intval($arrivel_time[0][0]);
            }
            $arrivel_time[0] = (string)$arrivel_time[0][0].":".$arrivel_time[0][1];
        }
        return $arrivel_time[0];
    }
    public function get_time_from_db($arrivel_time){
        $arrivel_time = explode(":", $arrivel_time);
        $am_or_pm = "";
        if( intval($arrivel_time[0]) > 12 ){
            $am_or_pm = "PM";
            $arrivel_time[0] = 12 - $arrivel_time[0];
        }else{
            $am_or_pm = "AM";
        }
        $arrivel_time = $arrivel_time[0].":".$arrivel_time[1]." ".$am_or_pm;
        return $arrivel_time;
    }
}