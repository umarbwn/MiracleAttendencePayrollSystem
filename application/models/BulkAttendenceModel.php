<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BulkAttendenceModel extends CI_Model{
    public function get_terminal_links($id){
        // var_dump($id); exit;
        $response = $this->db
                ->select(
                        'tl.id AS tl_id, '
                        // . 'tl.position_id,'
                        . 'tl.location_id,'
                        // . 'p.id AS p_id, '
                        // . 'p.name AS p_name, '
                        // . 'p.location AS p_loc_id, '
                        // . 't.id AS t_id, '
                        . 't.location AS t_location, '
                        . 't.name AS t_name')
                // ->join('positions p', 'tl.position_id = p.id', 'left')
                ->join('terminals t', 'tl.location_id = t.id', 'left')
                ->where(['tl.id' => $id])
                ->get('terminal_links tl')
                ->result();
        
        return $response;
    }

    public function get_pos_by_loc($id){
        $response = $this->db
            ->where([ 'id' => $id ])
            ->get('terminal_links')
            ->row();
        
        return $response;
    }
    public function get_all_employees($id){
        // echo $id; exit;
        // $response = $this->db
        //     ->select('e.id AS emp_id, e.emp_image, e.first_name, e.last_name')
        //     ->join('terminal_links', 'terminal_links.position_id = e.position', 'left')
        //     ->join('positions', 'positions.id = terminal_links.position_id', 'left')
        //     ->join('terminals', 'positions.location = terminals.id', 'left')
        //     ->where( [ 'terminal_links.id' => $id ] )
        //     ->get('employees e')->result();
        $response = $this->db
            ->select('id as emp_id, emp_image, first_name, last_name')
            ->where([ 'position' => $id ])
            ->get('employees')
            ->result();
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