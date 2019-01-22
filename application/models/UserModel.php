<?php
class UserModel extends CI_Model{
    public function validate_emp_login($data){
        $data['password'] = base64_encode($data['password']);
        $query = $this->db->where($data)->get('employees');
        return $query->row();
    }
    public function if_exist_superadmin(){
        $query = $this->db
                    ->where(['role != ' => ''])
                    ->get('employees');
        return $query->row();
    }
    public function register_super_admin($data){
        $data['admin_password'] = base64_encode($data['admin_password']);
        // var_dump($data); exit;
        $response = $this->db->insert('super_admin', $data);
        return $response;
    }
    public function att_valid_emp_login($data){
        $data['password'] = $data['password'];
        $query = $this->db->where($data)->get('employees');
        return $query->row();
    }
}