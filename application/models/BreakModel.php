<?php
class BreakModel extends CI_Model{
    public function take_break($data){
        $response = $this->db->insert("breaks", $data);
        return $response;
    }

    public function break_out($data){
        // var_dump($data); exit;
        $response = $this->db
            ->set([
                'break_out' => $data['break_out']
            ])
            ->where([
                'id' => $data['id'],
            ])
            ->update("breaks");
        return $response;
    }

    public function delete_break(){

    }

    public function get_breaks(){

    }

    public function get_time_clock($id){
        // var_dump($id); exit;
        $response = $this->db
            ->where([ 'emp_id' => $id ])
            ->get('time_clock')
            ->row()
        ;
        return $response;
    }

}
