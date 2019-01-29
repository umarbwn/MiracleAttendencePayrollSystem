<?php
class AuthDataSecrets extends CI_Controller{

    private $secret_key = null;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthDataSecretsModel', 'model');
    }
    public function set_key(){
        $key = bin2hex($this->encryption->create_key(32));
        $response = $this->model->set_auth_data_secrets($key);
        if($response){
            return redirect('Users');
        }else{
            echo '<h1 class="text-center text-danger">Error in installation!</h1>'; exit;   
        }
    }

    public function get_key(){
        $secret_key = get_secret_key(1)->key;
        return $secret_key;
    }
    
    public function encryption_initialize(){
        $this->secret_key = $this->get_key();
        $this->encryption->initialize(
                array(
                        'cipher' => 'aes-256',
                        'mode' => 'ctr',
                        'key' => $this->secret_key
                )
        );
    }

    public function encrypt_data($data){
        $plain_text = $data;
        $ciphertext = $this->encryption->encrypt($plain_text);
        return $ciphertext;
    }

    public function decrypt_data($data){
        $ciphertext = $this->encryption->decrypt($data);
        return $ciphertext;
    }

}