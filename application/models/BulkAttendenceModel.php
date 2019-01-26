<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BulkAttendenceModel extends CI_Model{
    public function get_terminal_links($id){
        $response = $this->db
                ->select(
                        'tl.id AS tl_id, '
                        . 'tl.position_id,'
                        . 'p.id AS p_id, '
                        . 'p.name AS p_name, '
                        . 'p.location AS p_loc_id, '
                        . 't.id AS t_id, '
                        . 't.location AS t_location, '
                        . 't.name AS t_name')
                ->join('positions p', 'tl.position_id = p.id', 'left')
                ->join('terminals t', 'p.location = t.id', 'left')
                ->where(['tl.id' => $id])
                ->get('terminal_links tl')
                ->result();
        
        return $response;
    }
    public function get_all_employees($id){
        // echo $id; exit;
        $response = $this->db
            ->select('*')
            ->join('terminal_links', 'terminal_links.position_id = employees.position', 'left')
            ->join('positions', 'positions.id = terminal_links.position_id', 'left')
            ->join('terminals', 'positions.location = terminals.id', 'left')
            ->where( [ 'terminal_links.id' => $id ] )
            ->get('employees')->result();
        return $response;
    }
    public function get_emp_details($id){
        $response = $this->db
                ->where(['id' => $id])
                ->get('employees')
                ->row();
        return $response;
    }
}