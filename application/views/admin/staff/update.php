<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Staff
            <small>Update Employee</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Employee</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <?php echo form_open_multipart('Staff/add_employee'); ?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="
                                    form-group
                                    <?php
                                    $error = form_error(
                                        'first_name', '<small class="form-error">', '</small>'
                                    );
                                    if (!empty($error)) {
                                        echo 'has-error';
                                    }
                                    ?>
                                    ">
                                    <label for="first_name">First name:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="first_name"
                                        id="first_name"
                                        placeholder="Enter first name"
                                        value="<?php echo set_value('first_name', $employee->first_name); ?>"
                                        >
                                        <?php echo $error; ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group
                                    <?php
                                    $error = form_error(
                                        'last_name', '<small class="form-error">', '</small>'
                                    );
                                    if (!empty($error)) {
                                        echo 'has-error';
                                    }
                                    ?>">
                                    <label for="last_name">Last name:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="last_name"
                                        id="last_name"
                                        placeholder="Enter last name"
                                        value="<?php echo set_value('last_name', $employee->last_name); ?>"
                                        >
                                        <?php echo $error; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group
                                    <?php
                                    $error = form_error(
                                        'email_addr', '<small class="form-error">', '</small>'
                                    );
                                    if (!empty($error)) {
                                        echo 'has-error';
                                    }
                                    ?>">
                                    <label for="email_addr">Email address:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="email_addr"
                                        id="email_addr"
                                        placeholder="Enter email address"
                                        value="<?php echo set_value('email_addr', $employee->email_addr); ?>"
                                        >
                                        <?php echo $error; ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group
                                <?php
                                    $error = form_error(
                                        'phone_no', '<small class="form-error">', '</small>'
                                    );
                                    if (!empty($error)) {
                                        echo 'has-error';
                                    }
                                    ?>">
                                    <label for="phone_no">Phone #:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="phone_no"
                                        id="phone_no"
                                        placeholder="Enter phone number"
                                        value="<?php echo set_value('phone_no', $employee->phone_no); ?>"
                                        >
                                        <?php echo $error; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" name="user_password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Select position:</label>
                                    <select class="form-control" name="position">
                                        <?php //if( !empty($employee->) ): ?>
                                        <option value="">Select position</option>
                                        <?php foreach ($positions as $position): ?>
                                            <option value="<?php echo $position->id; ?>">
                                                <?php echo $position->name; ?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                    <?php
                                    echo form_error('position', 
                                    '<span class="form-error">', '</span>');
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label>Select payroll card:</label>
                                    <select class="form-control" name="payroll_card">
                                        <option value="">Select payroll card</option>
                                        <?php foreach ($payroll_cards as $card): ?>
                                            <option value="<?php echo $card->id; ?>">
                                                <?php echo $card->card_title; ?>
                                            </option>
                                        <?php endforeach;?>
                                    </select>
                                    <?php
                                        echo form_error(
                                            'payroll_card', '<span class="form-error">', '</span>');
                                        ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="
                                form-group
                                <?php
                                $error = $image_error;
                                if (!empty($error)) {
                                echo 'has-error';
                                }
                                ?>">
                                <label for="emp_image">Upload image:</label>
                                <input type="file" id="emp_image" name="emp_image">
                                <p class="help-block"><?php echo $error; ?></p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="form-group">
                                <label for="" class="control-label">Employee salary type</label>
                                <select name="salary_type" id="select-salary-type" class="form-control">
                                    <?php if(set_value('salary_type') != ''): ?>
                                        <option value="<?php echo set_value('salary_type'); ?>">
                                            <?php echo set_value('salary_type').' selected';?>
                                        </option>
                                    <?php endif; ?>
                                    <option value="" id="salary-type-option">Select salary type</option>
                                    <option value="wages">Wages</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                                <?php echo form_error('salary_type',
                                    '<span class="form-error">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3" id="vages-inputs">
                            <div class="form-group">
                                <label for="" class="control-label">Enter per hour amount:</label>
                                <input type="text" class="form-control" 
                                    name="per_hour_amount" 
                                    value="<?php echo set_value('per_hour_amount'); ?>">
                                <?php echo form_error('per_hour_amount', 
                                '<span class="form-error">', '</span>'); ?>
                            </div>
                        </div>
                        <div class="col-sm-6 col-sm-offset-3" id="monthly-inputs">
                            <div class="form-group">
                                <label for="" class="control-label">Enter monthly salary:</label>
                                <input type="text" class="form-control" 
                                name="monthly_salary" 
                                value="<?php echo set_value('monthly_salary'); ?>">
                                <?php echo form_error('monthly_salary',
                                    '<span class="form-error">', '</span>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label">Montlhy weakend leaves:</label>
                                <select name="leaves" id="" class="form-control">
                                    <option value="1">1 Sun</option>
                                    <option value="2">2 Sat, Sun</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    Leave condition
                                    <?php echo form_error('leave_condition',
                                        '<span class="form-error">', '</span>')?>
                                </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="leave_condition" value="1"
                                            <?php echo set_value('leave_condition') == '1' ? 'checked' : ''; ?>
                                        >
                                        If user will get leave with weekend leave then both leaves salary will be
                                        deducted.
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="leave_condition" value="2"
                                            <?php echo set_value('leave_condition') == '2' ? 'checked' : ''; ?>
                                        >
                                        User can get leaves with weekend & those leaves are valid leaves
                                        Salary will not be deducted.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>

