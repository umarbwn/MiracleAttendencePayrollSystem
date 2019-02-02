<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="pull-left">
            Payroll
            <small>All payroll</small>
        </h1>
        <a href="<?php echo base_url('Payroll/add_rate_card'); ?>" class="btn btn-primary pull-right margin-bottom">New Rate Card</a>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php $response = $this->session->flashdata('success_msge');
                if (!empty($response)) : ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Success! <?php echo $response; ?>
                    </div>
                <?php endif; ?>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">All Payroll</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable"
                                           role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 20px;">
                                                    <label>
                                                        <input type="checkbox" class="minimal select-all">
                                                    </label>
                                                </th>
                                                <th>Userid</th>
                                                <th>Employee</th>
                                                <!-- <th>Eid</th> -->
                                                <th>Date</th>
                                                <!-- <th>Shift title</th> -->
                                                <th>Location</th>
                                                <th>Position</th>
                                                <th>Rate</th>
                                                <th>Rate Card</th>
                                                <th>Start time</th>
                                                <th>End time</th>
                                                <th>Regular</th>
                                                <th>Special</th>
                                                <th>Overtime</th>
                                                <th>Total</th>
                                                <th>Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($employees as $employee) : ?>
                                                <tr role="row" class="odd">
                                                    <td>
                                                        <label>
                                                            <input 
                                                                type="checkbox" 
                                                                class="minimal" 
                                                                value="<?php echo $employee->emp_id; ?>">
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <?php echo $employee->emp_id; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $employee->first_name . ' '
                                                            . $employee->last_name; ?>
                                                    </td>
                                                    <!-- <td></td> -->
                                                    <td>
                                                        <?php echo str_replace('-', '&nbsp;', $employee->date); ?>
                                                    </td>
                                                    <!-- <td>
                                                        <?php //echo $employee->date; ?>
                                                    </td> -->
                                                    <td>
                                                        <?php echo $employee->t_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $employee->p_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $hourly_rate = $employee->per_hour_amount; 
                                                            if($hourly_rate > 0){
                                                                echo $employee->per_hour_amount;
                                                            }else{
                                                                $month_pay = number_format($employee->monthly_salary);
                                                                $month_pay = $month_pay.'/-';
                                                                echo $month_pay;
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $employee->card_title; ?>
                                                    </td>
                                                    <td>
                                                        <?php 

                                                        $date = explode(',', $employee->start_times);
//                                                            var_dump($array); exit;
                                                        echo date("g:i a", strtotime($date[0])); ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        $array = explode(',', $employee->end_times);
                                                        foreach ($array as $element) {
                                                            $date = $element;
                                                        }
//                                                            var_dump($array); exit;
                                                        echo date("g:i a", strtotime($date)); ?>                                                        
                                                    </td>
                                                    <td>col5</td>
                                                    <td>
                                                        <?php echo $employee->special_overtime.'/-'; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $clock_in = new DateTime($employee->emp_clock_in);
                                                            $clock_out = new DateTime($employee->emp_clock_out);
                                                            $interval = date_diff($clock_in, $clock_out);

                                                            $day_to_hours = 0;
                                                            $day = $interval->format('%d');
                                                            if ($day == '0') {
                                                                $day = '0';
                                                            }
                                                                // echo $day;
                                                            if ($day != null) {
                                                                $day_to_hours = $day * 24;
                                                            }
                                                                // echo $day_to_hours;
                                                            $hours = (int)$interval->format('%h') + (int)$day_to_hours;
                                                                // echo $hours.' | '.
                                                            $hours = $hours;
                                                            if ($hours == '0') {
                                                                $hours = '';
                                                            }
                                                                // var_dump($hours);
                                                            $minutes = $interval->format('%i') . 'm ';
                                                            if ($minutes == '0m ') {
                                                                $minutes = '';
                                                            }
                                                            $seconds = $interval->format('%s') . 'sec';
                                                            
                                                            if( $hours > $employee->daily_Hours ){
                                                                $over_time_hours = doubleval($hours) - doubleval($employee->daily_Hours);
                                                                echo $over_time_hours.'h ' . $minutes . $seconds;                                                                
                                                            }else{
                                                                echo "Not available";
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $hours.'h ' . $minutes . $seconds; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo round($employee->cost, 2); ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <!-- <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Cell Phone</th>
                                                <th>Home Phone</th>
                                                <th>Email</th>
                                                <th>Group</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot> -->
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Showing 1 to 10 of 57 entries
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" id="example1_previous"><a
                                                        href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                                            </li>
                                            <li class="paginate_button active"><a href="#" aria-controls="example1"
                                                                                  data-dt-idx="1" tabindex="0">1</a>
                                            </li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                            data-dt-idx="2" tabindex="0">2</a></li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                            data-dt-idx="3" tabindex="0">3</a></li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                            data-dt-idx="4" tabindex="0">4</a></li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                            data-dt-idx="5" tabindex="0">5</a></li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                                            data-dt-idx="6" tabindex="0">6</a></li>
                                            <li class="paginate_button next" id="example1_next"><a href="#"
                                                                                                   aria-controls="example1"
                                                                                                   data-dt-idx="7"
                                                                                                   tabindex="0">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>
<?php $this->load->view('admin/staff/dialoge_modal'); ?>