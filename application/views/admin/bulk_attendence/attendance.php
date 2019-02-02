<?php //var_dump($employees); exit; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0px">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            Attendence
            <small>Bulk attendence</small>
        </h1>
    </section> -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="box-title pull-left">Bulk attendance</h3>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-inline pull-right">
                                        <label for="filter">Filter: </label>
                                        <select 
                                            name="filter_positions" 
                                        id="filter" 
                                            class="form-control select2 position_filter"
                                            onchange="pos_filter()">
                                            <option id="pos_filter_option" selected="selected" value=""></option>
                                            <?php foreach($pos_filter as $filter): ?>
                                                <option value="">All positions</option>
                                                <option value="<?php echo htmlentities(json_encode($filter)); ?>">
                                                    <?php echo $filter->name; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="row">
                        <?php foreach($employees as $employee): $employee = $employee[0]; ?>
                        <div class="col-sm-2">
                            <a 
                                href="<?php 
                                        echo base_url(
                                                'BulkAttendance'
                                                . '/user_attendence/'.$employee->emp_id); 
                                ?>">
                                <div class="thumbnail-link img-thumbnail center-block" style="background-image: url(<?php echo base_url(
                                            'uploads/staff/employees/'
                                            .$employee->emp_image); ?>);">
                                    <!-- <img
                                        style=""
                                        class="
                                            img-responsive 
                                            img-thumbnail 
                                            center-block"
                                        src=""> -->
                                </div>
                                <p class="text-center bulk-user-name">
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
    var pos_filter_url = "<?php echo base_url(); ?>";
</script>