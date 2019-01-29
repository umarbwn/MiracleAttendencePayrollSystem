<?php
class WelcomeModel extends CI_Model{
    public function get_all_online_users(){
        $response = $this->db
            ->select()
            ->get();
    }
}
