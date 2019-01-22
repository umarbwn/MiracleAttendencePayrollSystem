<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Payroll
            <small>New rate card</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add rate card</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open_multipart('Payroll/add_rate_card'); ?>
                    <input type="hidden" name="id" value="<?php 
                        if( isset($rate_card->id) ){
                            echo $rate_card->id;
                        }else{
                            echo '';
                        }
                    ?>">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group
                                    <?php
                                        $error = form_error(
                                            'payroll_title', '<small class="form-error">', '</small>'
                                        );
                                        if (!empty($error)) {
                                            echo 'has-error';
                                        }
                                        ?>">
                                    <label for="payroll_title">Card title:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="payroll_title"
                                        id="first_name"
                                        placeholder="Enter card title"
                                        value="<?php 
                                            if(isset($rate_card->card_title)){
                                                $payroll_title = $rate_card->card_title;
                                            } else{
                                                $payroll_title = '';
                                            }
                                            echo set_value('payroll_title', $payroll_title); 
                                        ?>">
                                        <?php echo $error; ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3">
                                <label for="">Daily overtime:</label>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label for="" class="control-label">After</label>
                                        <select name="daily_hours" id="" class="form-control">
                                            <?php if(isset($rate_card->daily_hours ) ){
                                                    $hours = $rate_card->daily_hours;
                                                } else{ $hours = ''; } ?>
                                            <?php if(!empty($hours)): ?>
                                                <option value="<?php echo $hours; ?>">
                                                    <?php echo $hours.'hrs selected'; ?>
                                                </option>
                                            <?php endif; ?>
                                            <?php for ($i = 1; $i < 24; $i++): ?>
                                                <?php $hrs = ($i == 1) ? $hrs = 'hr' :  $hrs = 'hrs'; ?>
                                                <option value="<?php echo $i; ?>">
                                                    <?php echo $i.' '.$hrs; ?>
                                                </option>
                                                <option value="<?php echo $i.'.5'; ?>">
                                                    <?php echo $i . '.5' . ' ' . $hrs; ?>
                                                </option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="form-group
                                        <?php
                                            if (isset($rate_card->pay_rate)) {
                                            $pay_rate = $rate_card->pay_rate;
                                            } else {
                                            $pay_rate = '100';
                                            }
                                            $error = form_error(
                                                'pay_rate',
                                                '<small class="form-error">',
                                                '</small>'
                                            );
                                            if (!empty($error)) {
                                                echo 'has-error';
                                            }
                                            ?>">
                                        <label for="" class="control-label">pay rate changes to</label>
                                        <input type="text" class="form-control" 
                                        name="pay_rate" 
                                        value="<?php echo set_value('pay_rate', $pay_rate.'%'); ?>">
                                        <?php echo $error; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-block"
                                        id="btn-submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title pull-left">Hourly Rate Chart</h3>
                            <button class="btn btn-primary pull-right btn-sm">Save</button>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php echo form_open_multipart('Payroll/add_rate_card'); ?>
                        <?php 
                            if( isset($rate_card->hrly_rate_chart) ){
                                $hrly_rate_chart = json_decode($rate_card->hrly_rate_chart, true);
                            }else{
                                $hrly_rate_chart = array(
                                    'sun0'  => '100%',
                                    'mon0'  => '100%',
                                    'tue0'  => '100%',
                                    'wed0'  => '100%',
                                    'thu0'  => '100%',
                                    'fri0'  => '100%',
                                    'sat0'  => '100%',
                                    'sun0pm'  => '100%',
                                    'mon0pm'  => '100%',
                                    'tue0pm'  => '100%',
                                    'wed0pm'  => '100%',
                                    'thu0pm'  => '100%',
                                    'fri0pm'  => '100%',
                                    'sat0pm'  => '100%',
                                );
                            }
                        ?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-hourly-chart">
                                        <thead>
                                            <tr class="active">
                                                <th class="tbl-cell-header-border"></th>
                                                <th class="text-center tbl-cell-header-border">
                                                    Sunday
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    Monday
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    Tuesday
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    Wednesday
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    Thursday
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    Friday
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    Saturday
                                                </th>
                                            </tr>
                                            <tr class="active">
                                                <th class="tbl-cell-header-border"></th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="sun0"
                                                    value="<?php 
                                                        echo set_value('sun0', $hrly_rate_chart['sun0']); 
                                                    ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="mon0"
                                                    value="<?php 
                                                            echo set_value('mon0', $hrly_rate_chart['mon0']);
                                                    ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="tue0"
                                                    value="<?php 
                                                            echo set_value('tue0', $hrly_rate_chart['tue0']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="wed0"
                                                    value="<?php 
                                                            echo set_value('wed0', $hrly_rate_chart['wed0']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="thu0"
                                                    value="<?php 
                                                            echo set_value('thu0', $hrly_rate_chart['thu0']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="fri0"
                                                    value="<?php 
                                                            echo set_value('fri0', $hrly_rate_chart['fri0']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="sat0"
                                                    value="<?php 
                                                            echo set_value('sat0', $hrly_rate_chart['sat0']);
                                                            ?>">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < 12; $i++): ?>
                                                <tr class="text-center my-input-row">
                                                    <td class="active text-right tbl-cell-header-border">
                                                        <?php echo ($i == 0) ? '12 am' : $i . ' am'; ?>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" for="" name="<?php echo '_am_ip_sun' . $i ?>" id="<?php echo 'sun' . $i ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" for="" name="<?php echo '_am_ip_mon' . $i ?>" id="<?php echo 'mon' . $i ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" for="" name="<?php echo '_am_ip_tue' . $i ?>" id="<?php echo 'tue' . $i ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" for="" name="<?php echo '_am_ip_wed' . $i ?>" id="<?php echo 'wed' . $i ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" for="" name="<?php echo '_am_ip_thu' . $i ?>" id="<?php echo 'thu' . $i ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" for="" name="<?php echo '_am_ip_fri' . $i ?>" id="<?php echo 'fri' . $i ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" for="" name="<?php echo '_am_ip_sat' . $i ?>" id="<?php echo 'sat' . $i ?>" value="100%" >
                                                    </td>
                                                </tr>
                                            <?php endfor;?>
                                        </tbody>
                                    </table>
                                    <table class="table table-bordered table-hourly-chart1">
                                        <thead>
                                            <tr class="active">
                                                <th class="tbl-cell-header-border"></th>
                                                <th class="text-center tbl-cell-header-border">Sunday</th>
                                                <th class="text-center tbl-cell-header-border">Monday</th>
                                                <th class="text-center tbl-cell-header-border">Tuesday</th>
                                                <th class="text-center tbl-cell-header-border">Wednesday</th>
                                                <th class="text-center tbl-cell-header-border">Thursday</th>
                                                <th class="text-center tbl-cell-header-border">Friday</th>
                                                <th class="text-center tbl-cell-header-border">Saturday</th>
                                            </tr>
                                            <tr class="active">
                                                <th class="tbl-cell-header-border"></th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="sun0pm"
                                                    value="<?php 
                                                            echo set_value('sun0pm', $hrly_rate_chart['sun0pm']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="mon0pm"
                                                    value="<?php 
                                                            echo set_value('mon0pm', $hrly_rate_chart['mon0pm']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="tue0pm"
                                                    value="<?php 
                                                            echo set_value('tue0pm', $hrly_rate_chart['tue0pm']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="wed0pm"
                                                    value="<?php 
                                                            echo set_value('wed0pm', $hrly_rate_chart['wed0pm']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="thu0pm"
                                                    value="<?php 
                                                            echo set_value('thu0pm', $hrly_rate_chart['thu0pm']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="fri0pm"
                                                    value="<?php 
                                                            echo set_value('fri0pm', $hrly_rate_chart['fri0pm']);
                                                            ?>">
                                                </th>
                                                <th class="text-center tbl-cell-header-border">
                                                    <input type="text" class="form-control"
                                                    name="sat0pm"
                                                    value="<?php 
                                                            echo set_value('sat0pm', $hrly_rate_chart['sat0pm']);
                                                            ?>">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 12; $i < 24; $i++): ?>
                                                <tr class="text-center my-input-row">
                                                    <td class="active text-right tbl-cell-header-border">
                                                        <?php echo ($i == 0) ? '12 pm' : $i . ' pm'; ?>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="<?php echo '_pm_ip_sun' . $i; ?>" for="" id="<?php echo 'sun' . $i . 'pm'; ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="<?php echo '_pm_ip_mon' . $i; ?>" for="" id="<?php echo 'mon' . $i . 'pm'; ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="<?php echo '_pm_ip_tue' . $i; ?>" for="" id="<?php echo 'tue' . $i . 'pm'; ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="<?php echo '_pm_ip_wed' . $i; ?>" for="" id="<?php echo 'wed' . $i . 'pm'; ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="<?php echo '_pm_ip_thu' . $i; ?>" for="" id="<?php echo 'thu' . $i . 'pm'; ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="<?php echo '_pm_ip_fri' . $i; ?>" for="" id="<?php echo 'fri' . $i . 'pm'; ?>" value="100%" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" name="<?php echo '_pm_ip_sat' . $i; ?>" for="" id="<?php echo 'sat' . $i . 'pm'; ?>" value="100%" >
                                                    </td>
                                                </tr>
                                            <?php endfor;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </form>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>

