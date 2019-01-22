<div class="content-wrapper" style="min-height: 1126.3px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">User profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <div
                                class="profile-user-img custom-img-circle"
                                style="background-image: url(
                                        '<?php
                                echo base_url('uploads/staff/employees/')
                                    . $employee->emp_image;
                                ?>')"
                        ></div>

                        <h3 class="profile-username text-center">
                            <?php echo $employee->first_name . ' ' . $employee->last_name; ?>
                        </h3>
                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Employee Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fas fa-envelope"></i> Email address</strong>

                        <p class="text-muted">
                            <?php echo $employee->email_addr; ?>
                        </p>

                        <hr>

                        <strong><i class="fas fa-phone-square"></i> Phone number</strong>

                        <p class="text-muted">
                            <?php echo $employee->phone_no; ?>
                        </p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Details</a></li>
                        <!--                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>-->
                        <!--                        <li><a href="#settings" data-toggle="tab">Settings</a></li>-->
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">

                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>