<?php
class BreakController extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('BreakModel', 'model');
    }

    public function take_break($id){
        // var_dump($id); exit;
        $response = $this->model->get_time_clock($id);
        // var_dump($response); exit;
        $data = array(
            "break_in" => date("Y-m-d H:i:s"),
            "time_clock" => $response->id,
        );
        // var_dump($response); exit;
        $response = $this->model->take_break($data);
        if($response){
            return redirect('timeclock');
        }else{
            echo "<h1>Unable to take break</h1>";
        }
    }

    public function break_out(){
        // var_dump($this->input->post()); exit;
        $data = array(
            "id" => $this->input->post("id"),
            "break_in" => $this->input->post("break_in"),
            "time_clock" => $this->input->post("time_clock"),
            "break_out" => date("Y-m-d H:i:s"),
        );
        $response = $this->model->break_out($data);
        if($response){
            return redirect('timeclock');
        }else{
            echo "<h1>Cannot be clocked out.</h1>";
        }
    }
}
