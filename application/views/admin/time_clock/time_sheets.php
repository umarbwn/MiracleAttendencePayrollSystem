<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Time Sheets
            <small>All time sheets</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Time Sheets</a></li>
            <li class="active">All time sheets</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php $response = $this->session->flashdata('success_msge');if (!empty($response)): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    Success!
                    <?php echo $response; ?>
                </div>
                <?php endif;?>
                <?php $response = $this->session->flashdata('error_msge');if (!empty($response)): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    Success!
                    <?php echo $response; ?>
                </div>
                <?php endif;?>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title pull-left">
                            <?php //date_default_timezone_set("Asia/Karachi"); echo date("F j, Y, g:i a"); ?>
                            All time sheets
                        </h3>
                        <h3 class="box-title pull-right" id="timer"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th></th>
                                                <th>Employee</th>
                                                <th>Clock in</th>
                                                <th>Clock out</th>
                                                <th>Length</th>
                                                <th>Break</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($employees as $employee): ?>
                                            <tr role="row">
                                                <td></td>
                                                <td>
                                                    <?php echo $employee->first_name . ' ' . $employee->last_name; ?>
                                                </td>
                                                <td class="tooltip-parent">
                                                    <span class="tooltip-span">
                                                        <span class="my-tooltip">
                                                            <img class="img-responsive" src="<?php
                                                                echo base_url('uploads/staff/emp_clock_in_out/') .
                                                                $employee->emp_id . '/' .
                                                                $employee->clock_in_img; ?>">
                                                        </span>
                                                        <button class="btn btn-link tooltip-marker">
                                                            <i class="fas fa-camera"></i>
                                                        </button>
                                                    </span>
                                                    <?php echo date("g:i a", strtotime($employee->emp_clock_in)); ?>
                                                    <span>
                                                        <span class="my-tooltip">
                                                            <?php echo $employee->emp_loc; ?>
                                                        </span>
                                                        <button class="btn btn-link tooltip-marker">
                                                            <!--<i class="fas fa-map-marker-alt"></i>-->
                                                            <?php if ($employee->clk_in_flag): ?>
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <!--<i class="fas fa-check-circle"></i>-->
                                                            <?php else: ?>
                                                            <i class="fas fa-exclamation-triangle form-error"></i>
                                                            <?php endif;?>
                                                        </button>
                                                    </span>
                                                </td>
                                                <td class="tooltip-parent">
                                                    <span class="tooltip-span">
                                                        <span class="my-tooltip">
                                                            <img class="img-responsive" src="<?php
                                                                echo base_url('uploads/staff/emp_clock_in_out/') .
                                                                $employee->emp_id . '/' .
                                                                $employee->clock_out_img; ?>">
                                                        </span>
                                                        <button class="btn btn-link tooltip-marker">
                                                            <i class="fas fa-camera"></i>
                                                        </button>
                                                    </span>
                                                    <?php echo date("g:i a", strtotime($employee->emp_clock_out)); ?>
                                                    <span class="tooltip-span">
                                                        <span class="my-tooltip">
                                                            <?php echo $employee->emp_clock_out_loc; ?>
                                                        </span>
                                                        <button class="btn btn-link tooltip-marker">
                                                            <?php if ($employee->clk_out_flag): ?>
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <!--<i class="fas fa-check-circle"></i>-->
                                                            <?php else: ?>
                                                            <i class="fas fa-exclamation-triangle form-error"></i>
                                                            <?php endif;?>
                                                        </button>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php
                                                        $clock_in = new DateTime($employee->emp_clock_in);
                                                        $clock_out = new DateTime($employee->emp_clock_out);

                                                        // // ---------------------------------------------------------
                                                        // $special_hours = json_decode($employee->hrly_rate_chart)->special_hours;
                                                        // var_dump($special_hours);

                                                        // $clock_in_hour = (int)date('H', strtotime($employee->emp_clock_in));
                                                        // $clock_in_day = date('D', strtotime($employee->emp_clock_in));
                                                        
                                                        // $clock_out_hour = (int)date('H', strtotime($employee->emp_clock_out));
                                                        // $clock_out_day = date('D', strtotime($employee->emp_clock_in));
                                                        
                                                        // var_dump( date( 'D', strtotime($employee->emp_clock_in) ) );
                                                        // // var_dump( date( 'h:i:s', strtotime($employee->emp_clock_out) ).' out' );
                                                        
                                                        // var_dump( date( 'H', strtotime($employee->emp_clock_in) ) );
                                                        // var_dump( date( 'H', strtotime($employee->emp_clock_out) ) );

                                                        // // for($i = $clock_in_hour; $i <= $clock_out_hour; $i++; ){
                                                        // // }
                                                        // for($i = (int)$clock_in_hour; $i<= $clock_out_hour; $i++){
                                                        //     // var_dump($i);
                                                        //     foreach($special_hours as $key => $special_hour){
                                                        //         // var_dump((int)$key);
                                                        //         preg_match_all('!\d+!', $key, $matches);
                                                        //         $hour = (int)$matches[0][0].'<br>';
                                                        //         if($hour == $i){
                                                        //             var_dump(strtolower($key));
                                                        //         }
                                                        //         // $position = strpos($key, strtolower($clock_in_day));
                                                        //         // if($position){
                                                        //         //     preg_match_all('!\d+!', $key, $matches);
                                                        //         //     echo (int)$matches[0][0].'<br>';
                                                        //         // }
                                                        //     }
                                                        // }
                                                        // // -----------------------------------------------------------
                                                        $interval = date_diff($clock_in, $clock_out);
                                                        $day_to_hours = 0;
                                                        // var_dump($interval->format('%d'));
                                                        if(!empty($interval->format('%d'))){
                                                            $day = $interval->format('%d');if ($day == '0') {$day = '0';}
                                                            // var_dump($day); 
                                                            $day_to_hours = $day * 24;
                                                        }
                                                        $hours = $day_to_hours + $interval->format('%h') . 'h ';if ($hours == '0h ') {$hours = '';}
                                                        $minutes = $interval->format('%i') . 'm ';if ($minutes == '0m ') {$minutes = '';}
                                                        $seconds = $interval->format('%s') . 'sec';
                                                        echo $hours . $minutes . $seconds;
                                                        // echo "1h : 20m : 30s";
                                                        ?>
                                                </td>
                                                <td>A</td>
                                                <td>
                                                    <?php if($employee->tc_status == 0 ): ?>
                                                    <a href="<?php echo base_url('TimeClock/approve_attendence/') . $employee->emp_id; ?>"
                                                        class="btn btn-link btn-status">
                                                        <i class="far fa-check-circle"></i>
                                                        Approve
                                                    </a>
                                                    <?php else: ?>
                                                        <span class="approved-left-padding">
                                                            <i class="far fa-check-circle"></i>
                                                            Approved
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
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
    </section>
</div>
<script>
    var clock_in_time = '<?php echo $emp_clock_in; ?>';
    // alert(clock_in_time);
</script>