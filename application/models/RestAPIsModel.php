<?php
class RestAPIsModel extends CI_Model
{
    public function add_time_clock($data)
    {
        $response = $this->db->insert('time_clock', $data);
        return $response;
    }
}
