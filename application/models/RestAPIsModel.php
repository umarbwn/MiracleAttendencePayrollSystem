<?php
class RestAPIsModel extends CI_Model
{
    public function add_time_clock($data)
    {
        var_dump($data); exit;
        $response = $this->db->insert('time_clock', $data);
        return $response;
    }
    public function auth_user($data){
        var_dump($data); exit;
    }
}
