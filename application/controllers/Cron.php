<?php
class Cron extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('TimeClockModel', 'model');
        // echo '<pre>';
        date_default_timezone_set("Asia/Karachi");
        print_r(date("Y-m-d H:i:s", time())); 
        // exit;
    }
    // public function cron_test()
    // {
    //     // is_cli_request() is provided by default input library of codeigniter
    //     $file = fopen('./assets/testfile.php', 'a');
    //     fwrite($file, date('m.d.Y H:i:s') . '\n');
    //     fclose($file);
    // }
    public function add_overtime_day_counter(){
        $current_date = date("Y-m-d H:i:s");
        $this->model->add_overtime_day_counter($current_date);
        // $response = $this->model->add_overtime_day_counter($current_date);
        // echo '<pre>'; print_r($response);
    }
}