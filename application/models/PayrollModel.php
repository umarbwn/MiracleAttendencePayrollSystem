<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PayrollModel extends CI_Model
{

    public function get_all_payroll()
    {
        // print_r($this->is_empty_break()); exit;
        $data = $this->is_empty_break();
        $response = $this->db
            //                ->select('emp_clock_in')
            ->select('tc.emp_id,'
                . 'SUM(tc.clock_pay) AS cost,'
                . 'DATE_FORMAT(tc.emp_clock_in, "%b-%d,-%Y") AS date,'
                . 'e.first_name,'
                . 'e.last_name,'
                . 'e.email_addr,'
                . 'e.phone_no,'
                . 'e.emp_image,'
                . 'e.position,'
                . 'e.payroll_card,'
                . 'p.id AS p_id,'
                . 'p.name AS p_name,'
                . 'p.location AS p_loc,'
                . 't.id AS t_id,'
                . 't.location AS t_loc,'
                . 't.name AS t_name,'
                . 'pc.id AS pc_id,'
                . 'pc.card_title,'
                . 'pay.salary_type,'
                . 'pc.daily_Hours,'
                . 'pc.arrivel_time,'
                . 'pc.fine_time,'
                . 'pc.deduct_hours,'
                . 'leave.leave_condition,'
                . 'leave.paid_leaves,'
                . 'pay.per_hour_amount,'
                . 'pay.monthly_salary,'
                . 'tc.emp_clock_in,'
                . 'tc.emp_clock_out,'
                . 'tc.id AS tc_id,'
                . 'tc.special_overtime,'
                . 'GROUP_CONCAT(b.id SEPARATOR ",") AS breaks,'
                . 'GROUP_CONCAT(tc.emp_clock_in SEPARATOR ",") AS start_times,'
                . 'GROUP_CONCAT(tc.emp_clock_out SEPARATOR ",") AS end_times')
            ->join('employees e', 'tc.emp_id = e.id', 'left')
            ->join('positions p', 'e.position = p.id', 'left')
            ->join('terminals t', 'p.location = t.id', 'left')
            ->join('breaks b', 'b.time_clock = tc.id', 'left')
            ->join('payroll_cards pc', 'e.payroll_card = pc.id', 'left')
            ->join('pays pay', 'tc.emp_id = pay.emp_id', 'left')
            ->join('leaves leave', 'tc.emp_id = leave.emp_id', 'left')
            //                ->group_by('tc.emp_clock_in')
            //                ->distinct()
            ->group_by('date')
            ->group_by('tc.emp_id')
            ->where( $data["where_clause"] )
            ->get('time_clock tc')
            ->result();
                //    print_r($this->db->last_query()); exit;
        return $response;
    }
    public function is_empty_break(){
        $response = $this->db->get("breaks")->num_rows();
        $data = array();
        if($response > 0){
            $data["where_clause"] = array(
                'tc.status' => '1',
                'b.break_out !=' => null,
            );
        }else{
            $data["where_clause"] = array(
                'tc.status' => '1'
            );
        }
        return $data;
    }

    public function add_rate_card($data)
    {
        // var_dump($data); exit;
        $response = $this->db->insert('payroll_cards', $data);
        return $response;
    }
    public function get_all_rate_cards()
    {
        $response = $this->db
            ->get('payroll_cards')
            ->result();
        return $response;
    }

    public function delete_payrol_card($id){
        $is_exists = $this->db
            ->where( [ 'payroll_card' => $id ] )
            ->get('employees')
            ->row();
        if(!$is_exists){
            $response = $this->db
                ->where( [ 'id' => $id ] )
                ->delete('payroll_cards');
            return $response;
        }else{
            return 'exists';
        }
    }

    public function update_rate_card($data, $id){
        $response = $this->db
            ->set( $data )
            ->where( [ 'id' => $id ] )
            ->update('payroll_cards');
        return $response;
    }

    public function get_rate_card($id){
        $response = $this->db
            ->where( [ 'id' => $id ] )
            ->get('payroll_cards')
            ->row();
        return $response;
    }

    public function get_single_user_breaks($ids){
        $ids = explode(", ", $ids);
        // var_dump($ids); exit;
        $response = $this->db
            ->where_in('id', $ids)
            ->get('breaks')
            ->result();
        // var_dump($response); exit;
        return $response;
    }
}
