<?php
class WelcomeModel extends CI_Model{
    public function get_all_online_users(){
        $response = $this->db
            ->select('
                e.first_name,
                e.last_name,
                e.emp_image,
                e.payroll_card,
                p.name,
                tc.emp_clock_in
            ')
            ->join('positions p', 'p.id = e.position', 'join')
            ->join('time_clock tc', 'tc.emp_id = e.id', 'join')
            ->where([
                'tc.clock_out_img' => '0'
            ])
            ->get('employees e')
            ->result();
        

        return $response;
    }

    public function add_notice($data){
        $response = $this->db->insert('notices', $data);
        return $response;
    }

    public function get_all_notices(){
        $response = $this->db
            ->order_by('id', 'DESC')
            ->get('notices')
            ->result();
        return $response;
    }

    public function delete_notice($id){
        $response = $this->db
            ->where([
                'id' => $id
            ])
            ->delete('notices');
        return $response;
    }

    public function get_single_notice($id){
        $response = $this->db
			->where([
				'id' => $id
			])
			->get('notices')
			->row();
		return $response;
    }
}