<?php

/**
 * Created by PhpStorm.
 * User: THIS PC
 * Date: 12/24/2018
 * Time: 6:22 PM
 */
class StaffModel extends CI_Model {

    public function add_employee($data) {
//        var_dump($data); exit;
        $query = $this->db->insert('employees', $data['emp_data']);
        if($query){
            $insert_id = $this->db->insert_id();

            $data['pays_data']['emp_id'] = $insert_id;
            $query = $this->db->insert('pays', $data['pays_data']);

            $data['leaves']['emp_id'] = $insert_id;
            $query = $this->db->insert('leaves', $data['leaves']);

            return $insert_id;
        }
    }

    public function get_all_employees() {
        $query = $this->db
                        ->select(''
                                . 'e.id, '
                                . 'e.first_name, '
                                . 'e.last_name, '
                                . 'e.email_addr, '
                                . 'e.phone_no, '
                                . 'e.password, '
                                . 'e.emp_image, '
                                . 'e.position, '
                                . 'e.role, '
                                . 'p.name')
                        ->join('positions p', 'e.position = p.id', 'left')
                        ->get('employees e')->result();
        return $query;
    }

    public function get_all_payroll_cards(){
        $response = $this->db
                ->get('payroll_cards')
                ->result();
//        var_dump($response); exit;
        return $response;
    }
    public function get_single_employee($id) {
        $query = $this->db
                ->where(['id' => $id])
                ->get('employees');
        return $query->row();
    }

    public function login_staff($data) {
        $query = $this->db
                ->where($data)
                ->get('employees');
        return $query->row();
    }

    public function get_all_positions() {
        $response = $this->db->get('positions')->result();
        return $response;
    }

    public function delete_employee($id) {
        $response = $this->db
            ->where( [ 'emp_id' => $id ] )
            ->delete('leaves');
        if($response){
            $response = $this->db
                ->where( [ 'emp_id' => $id ] )
                ->delete('pays');
            if($response){
                $data = array();
                $data['image_name'] = $this->db
                            ->where(['id' => $id])
                            ->get('employees')->row();
                $data['response'] = $this->db
                        ->where(['id' => $id])
                        ->delete('employees');
                if ($data['response']) {
                    $data['response'] = $this->db
                            ->like(['emp_id' => $id])
                            ->delete('time_clock');
                    return $data;
                }
            }
        }
    }
    
    public function update_emp_img_name($new_name, $insert_id){
        $response = $this->db
                ->set($new_name)
                ->where(['id' => $insert_id])
                ->update('employees');
        return $response;
    }
}
