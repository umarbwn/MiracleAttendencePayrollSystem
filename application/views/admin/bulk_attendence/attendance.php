<?php //var_dump($employees); exit; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Attendence
            <small>Bulk attendence</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bulk attendance</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="row">
                        <?php foreach($employees as $employee): ?>
                        <div class="col-sm-2">
                            <a 
                                href="<?php 
                                        echo base_url(
                                                'BulkAttendance'
                                                . '/user_attendence/'.$employee->id); 
                                ?>">
                                <img
                                    style=""
                                    class="
                                        img-responsive 
                                        img-thumbnail 
                                        center-block"
                                    src="<?php echo base_url(
                                        'uploads/staff/employees/'
                                        .$employee->emp_image); ?>">
                                <p class="text-center">
                                    <?php echo 
                                            $employee->first_name
                                            .' '
                                            .$employee->last_name; 
                                    ?>
                                </p>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>

<script>
    slug_for_js = '';
//    alert(slug_for_js);
</script>