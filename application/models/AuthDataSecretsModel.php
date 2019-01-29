<?php
class AuthDataSecretsModel extends CI_Model{
    public function set_auth_data_secrets($data){
        $response = $this->db->insert();
    }

    public function get_secret_key($id){
        $response = $this->db
            ->where([
                'id'    => $id
            ])
            ->get('auth_data_secrets')
            ->row();

        return $response;
    }
}
