<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('application/core/Geocoding.php');

use myPHPnotes\Geocoding;

class BulkAttendance extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('BulkAttendenceModel', 'model');
    }

    public function index($id = null) {
        if($id !== null){
            $bulk_link = $this->model->get_terminal_links($id);
    //        var_dump(json_decode($bulk_link[0]->t_location)->lat); exit;
//            $bulk_link[0]->t_location = $this->lat_lng_to_loc(
//                    json_decode($bulk_link[0]->t_location)->lat, json_decode($bulk_link[0]->t_location)->lng);
//            var_dump($bulk_link); exit;
            $this->load->view('admin/common/header');
            $this->load->view('admin/bulk_attendence/index');
            $this->load->view('admin/common/footer');
        }else{
            return redirect('TimeClock/terminal_links');
        }
    }

    public function bulk_attendence() {
        if(!empty($this->input->post('id')) &&
                !empty($this->input->post('lat')) &&
                !empty($this->input->post('lng'))){
            $lat = $this->input->post('lat');
            $lng = $this->input->post('lng');
            $id = $this->input->post('id');

            $bulk_link = $this->model->get_terminal_links($id);

            $device_loc = $this->lat_lng_to_loc($lat, $lng);
            //        var_dump(json_decode($bulk_link[0]->t_location)->lat); exit;
            $terminal_loc = $bulk_link[0]->t_location;
//            $terminal_loc = $this->lat_lng_to_loc(
//                    json_decode($bulk_link[0]->t_location)->lat, json_decode($bulk_link[0]->t_location)->lng);
            $response = strcmp($device_loc, $terminal_loc);
            if ($response === 0) {
                $this->session->set_flashdata('link_id', $id);
//                var_dump($id); exit;
                $employees = $this->model->get_all_employees();
                $this->load->view('admin/common/header');
                $this->load->view('admin/bulk_attendence/attendance',
                        ['employees' => $employees]);
                $this->load->view('admin/common/footer');
            } else {
                echo 'location didn\'t match';
            }
        }else{
            return redirect('BulkAttendance/index/'.$this->session->flashdata('link_id'));
        }
    }

    public function lat_lng_to_loc($lat, $lng) {
        $geo = new Geocoding('AIzaSyDZUGQeUX65hAXw-vH0z5EWlnbpjl-y5Gk');
        $address = $geo->getAddress($lat, $lng);
        return $address;
    }
    public function user_attendence($id){
//        var_dump($id); exit;
        $response = $this->model->get_emp_details($id);
//        var_dump($response); exit;
        $session_data = array(
            'id'            => $response->id,
            'name'          => $response->first_name.' '.$response->last_name,
            'phone_no'      => $response->phone_no,
            'emp_image'     => $response->emp_image,
            'role'          => $response->role,
        );
        // var_dump($response); exit;
        $this->session->set_userdata('attendence_data', $session_data);
//        $this->session->set_flashdata('attendence_data', $data);
//        var_dump($this->session->userdata());
        return redirect('TimeClock/index/');
    }
}
