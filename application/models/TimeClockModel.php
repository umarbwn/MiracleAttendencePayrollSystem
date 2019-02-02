<?php

class TimeClockModel extends CI_Model
{

    public function add_clock_details($data)
    {
        $check_id = $this->db
            ->where([
                'emp_clock_out' => '',
                'emp_id' => $data['emp_id'],
            ])
            ->get('time_clock');
        $check_id = $check_id->row();
        if (empty($check_id)) {
            $this->db->insert('time_clock', $data);
            $insert_id = $this->db->insert_id();
            // if ($insert_id) {
            //     $day_counter_data = array(
            //         'clock_index' => $insert_id,
            //         'emp_id' => $data['emp_id'],
            //         'clock_time' => null
            //     );
            //     $response = $this->db->insert('clock_day_counter', $day_counter_data);
            // }
            return $insert_id;
        } else {
            return 'exists';
        }
    }

    public function update_clock_out_details($data, $id)
    {
        // echo 'coming in data ';
        // var_dump($data); exit;
        $check_id = $this->db
            ->where([
                'emp_clock_out_loc' => '',
                'emp_id' => $id,
            ])
            ->get('time_clock');
        $check_id = $check_id->row();
        if ($check_id) {
            $this->db
                ->set($data)
                ->where([
                    'emp_id' => $id,
                    'id' => $check_id->id,
                ])
                ->update('time_clock');
            return $check_id->id;
        }
    }

    public function update_clock_in_img($img_name, $id, $insert_id)
    {
        $check_id = $this->db
            ->where([
                'id' => $id,
                'emp_clock_out != ' => '',
            ])
            ->get('time_clock');
        $check_id = $check_id->row();
        // var_dump($check_id); exit;
        if (!$check_id) {
            $response = $this->db
                ->set([
                    'clock_in_img' => $img_name,
                    'clock_out_img' => 0,
                ])
                ->where('id', $insert_id)
                ->update('time_clock');
            return $response;
        }
    }

    public function update_clock_out_img($img_name, $id, $insert_id)
    {
        $data = array(
            'clock_out_img' => $img_name,
        );
        $this->db->where([
            'emp_id' => $id,
            'id' => $insert_id,
            'clock_out_img' => 0,
        ]);
        $response = $this->db->update('time_clock', $data);

//            var_dump($this->db->last_query()); exit;
        return $response;
    }

    public function get_clock_in($id)
    {
        // $check_id = $this->db
        // ->where([
        //     ])
        // ->get('time_clock')->row();
        // var_dump($check_id); exit;
        // if($check_id){
        $response = $this->db
            ->select('emp_clock_in, clock_in_img')
            ->where([
                'emp_id' => $id,
                'emp_clock_out' => '0000-00-00 00:00:00',
            ])
            ->get('time_clock');
        return $response->row();
        // }
    }

    public function get_all_employees()
    {
        $response = $this->db->get('employees');
        return $response->result();
    }

    public function get_all_time_clock_details()
    {
        $response = $this->db
            ->select(
                'e.id AS e_id, '
                    . 'e.first_name,'
                    . 'e.last_name,'
                    . 'e.email_addr,'
                    . 'e.phone_no,'
                    . 'e.password,'
                    . 'e.emp_image,'
                    . 'e.role,'
                    . 'e.position,'
                    . 'tc.id AS t_id,'
                    . 'tc.emp_clock_in,'
                    . 'tc.emp_clock_out,'
                    . 'tc.emp_loc,'
                    . 'tc.emp_id,'
                    . 'tc.clock_in_img,'
                    . 'tc.clock_out_img,'
                    . 'tc.emp_clock_out_loc,'
                    . 'p.id AS p_id,'
                    . 'p.name AS p_name,'
                    . 'p.location AS p_loc,'
                    . 't.id AS t_id,'
                    . 't.name AS t_name,'
                    . 't.location AS t_loc,'
                    . 'pc.hrly_rate_chart,'
                    . 'tc.status AS tc_status'
            )
            ->join('employees e', 'tc.emp_id = e.id', 'left')
            ->join('positions p', 'e.position = p.id', 'left')
            ->join('terminals t', 'p.location = t.id', 'left')
            ->join('payroll_cards pc', 'e.payroll_card = pc.id', 'left')
            ->get('time_clock tc');
        return $response->result();
    }

    public function add_clock_location($data)
    {
        $response = $this->db->insert('terminals', $data);
        return $response;
    }

    public function get_clock_locations()
    {
        $response = $this->db->get('terminals');
        return $response->result();
    }

    public function get_all_positions()
    {
        $response = $this->db->get('positions');
        return $response->result();
    }

    public function add_terminal_link($data)
    {
        $response = $this->db->insert('terminal_links', $data);
        return $response;
    }
    public function update_terminal_link($data, $location)
    {
        $response = $this->db
            ->set($data)
            ->where([ 'location_id' => $location ])
            ->update('terminal_links');
        return $response;
    }

    public function get_terminal_links(){
        // $response = $this->db
        //     ->select(
        //         'tl.id AS tl_id, '
        //             . 'tl.position_id,'
        //             . 'p.id AS p_id, '
        //             . 'GROUP_CONCAT(p.name SEPARATOR " | ") AS p_name,'
        //             . 'p.location AS p_loc_id, '
        //             . 't.id AS t_id, '
        //             . 't.location AS t_location, '
        //             . 't.name AS t_name,'
        //             . 'tl.location_id,'
        //     )
        //     ->join('positions p', 'tl.position_id = p.id', 'left')
        //     ->join('terminals t', 'tl.location_id = t.id', 'left')
        //     ->where([ 'tl.link_type' => 'bulk' ])
        //     ->group_by('tl.location_id')
        //     ->get('terminal_links tl')
        //     ->result();

        // return $response;
        $response = $this->db
            ->select('
                t.location,
                t.name,
                tl.id,
                tl.positions,
                t.id AS t_id,
                tl.id AS tl_id
            ')
            ->join('terminals t', 't.id = tl.location_id', 'left')
            ->get('terminal_links tl')
            ->result();
            // ->where()
        return $response;
    }

    public function get_terminal_link_data($id){
        // var_dump($id); exit;
        $response = $this->db
            ->where([ 'id' => $id ])
            ->get('terminal_links tl')
            ->result();
        return $response;
    }

    public function get_single_employee($id)
    {
        $response = $this->db
            ->select('e.id AS e_id,'
                . 'e.first_name,'
                . 'e.last_name,'
                . 'e.email_addr,'
                . 'e.phone_no,'
                . 'e.password,'
                . 'e.emp_image,'
                . 'e.role,'
                . 'e.position,'
                . 'e.payroll_card,'
                . 'e.total_pay,'
                . 'p.id AS p_id,'
                . 'p.name AS p_name,'
                . 'p.location AS p_loc,'
                . 't.id AS t_id,'
                . 't.location AS t_loc,'
                . 't.name AS t_name,'
                . 'tc.id as tc_id,'
                . 'tc.emp_clock_in,'
                . 'tc.emp_clock_out,'
                . 'tc.emp_loc,'
                . 'tc.clock_in_img,'
                . 'tc.clock_out_img,'
                . 'tc.emp_clock_out_loc,'
                . 'tc.clock_pay')
            ->join('positions p', 'e.position = p.id', 'left')
            ->join('terminals t', 'p.location = t.id', 'left')
            ->join('time_clock tc', 'tc.emp_id = e.id', 'left')
            ->where(['e.id' => $id])
            ->get('employees e')
            ->result();
        return $response;
    }

    public function get_emp_info_on_clk_out($insert_id)
    {

        $response = $this->db
            ->select('tc.id AS tc_id,'
                . 'tc.emp_clock_in,'
                . 'tc.emp_clock_out,'
                . 'tc.emp_id,'
                . 'tc.clock_pay,'
                . 'e.payroll_card,'
                . 'pc.id AS pc_id,'
                . 'pays.salary_type,'
                . 'pc.daily_hours,'
                . 'leave.leave_condition,'
                . 'leave.paid_leaves,'
                . 'pays.per_hour_amount,'
                . 'pays.monthly_salary')
            ->join('employees e', 'tc.emp_id = e.id', 'left')
            ->join('payroll_cards pc', 'e.payroll_card = pc.id', 'left')
            ->join('pays pays', 'pays.emp_id = e.id', 'left')
            ->join('leaves leave', 'leave.emp_id = e.id', 'left')
            ->where([
                'tc.id' => $insert_id,
            ])
            ->get('time_clock tc')
            ->row();
        return $response;
    }
    public function update_per_clk_salary($salary, $special_over_time, $insert_id)
    {
        $response = $this->db
            ->set([
                'clock_pay'         => $salary,
                'special_overtime'  => $special_over_time
            ])
            ->where(['id' => $insert_id])
            ->update('time_clock');
        return $response;
    }

    public function delete_location($id)
    {
//        var_dump($id); exit;
        $response = $this->db
            ->where(['location' => $id])
            ->get('positions')
            ->result();
//        var_dump($response); exit;
        if ($response) {
            return false;
        } else {
            $response = $this->db
                ->where(['id' => $id])
                ->delete('terminals');
            return $response;
        }
    }

    public function approve_attendence($id)
    {
        $response = $this->db
            ->set(['status' => 1])
            ->where(['emp_id' => $id])
            ->update('time_clock');
        return $response;
    }
    public function overtime_plus_leave_details($clock_details)
    {
        $id = $clock_details->emp_id;
        // $hrly_rate_chart = $clock_details->hrly_rate_chart;
        $payroll_card = $clock_details->payroll_card;
        $response = $this->db
            ->select('
                leave.id,
                leave.paid_leaves,
                leave.leave_condition,
                pc.hrly_rate_chart
            ')
            ->join('pays pay', 'pay.emp_id = ' . $id, 'left')
            ->join('payroll_cards pc', 'pc.id = ' . $payroll_card, 'left')
            ->where(['leave.emp_id' => $id])
            ->get('leaves leave')
            ->row();
        return $response;
    }

    public function get_clk_day_counter_details($emp_id, $tc_id)
    {
        // echo $emp_id; exit;
        $response = $this->db
            ->where([
                'emp_id' => $emp_id,
                'clock_index' => $tc_id,
                'clock_time !=' => null
            ])
            ->get('clock_day_counter')
            ->result();
        return $response;
    }
    public function add_overtime_day_counter($current_date){
        $response = $this->db
            ->select('id as clock_index, emp_id')
            ->where( [ 'clock_out_img' => '0' ] )
            ->get('time_clock')
            ->result_array();
        // return $response;
        if($response){
            foreach($response as $result){
                $data = array(
                    'clock_index'   => $result['clock_index'],
                    'emp_id'      => $result['emp_id'],
                    'clock_time'    => $current_date
                );
                $this->db->insert('clock_day_counter', $data);
            }
        }
    }

    public function remove_day_counter($emp_id){
        $response = $this->db
            ->where([ 'emp_id' => $emp_id ])
            ->delete('clock_day_counter');
        $response;
    }

    public function delete_terminal_links($id){
        $response = $this->db
            ->where([ 'id' => $id ])
            ->delete('terminal_links');
            
        return $response;
    }

}
