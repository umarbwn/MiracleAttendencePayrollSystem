<?php

class ShiftPlanningModel extends CI_Model {

    public function add_position($data) {
        $response = $this->db->insert('positions', $data);
        return $response;
    }

    public function get_terminal_locs() {
        $response = $this->db->get('terminals');
        return $response->result();
    }

    public function get_all_positions() {
        $response = $this->db
                ->select('positions.id AS p_id,positions.name, terminals.name AS t_name')
                ->join('terminals', 'terminals.id = positions.location', 'left')
                ->get('positions')->result();
        return $response;
    }

}
