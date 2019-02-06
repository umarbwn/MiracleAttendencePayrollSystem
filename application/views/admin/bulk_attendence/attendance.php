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
                                    <?php //var_dump($pos_filter); exit; ?>
                                    <div class="form-inline pull-right">
                                        <label for="filter">Filter: </label>
                                        <select 
                                            name="filter_positions" 
                                        id="filter" 
                                            class="form-control select2 position_filter"
                                            onchange="pos_filter()">
                                            <option id="pos_filter_option" selected="selected" value=""></option>
                                            <option value="">All positions</option>
                                            <?php foreach($pos_filter as $filter): ?>
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
                        <?php foreach($employees as $employee):  ?>
                            <?php var_dump($employee); ?>
                            <?php //if(!empty($employee)): ?>
                            <?php     //var_dump($employee);  ?>
                                <div class="col-sm-2">
                                    <a 
                                        href="<?php 
                                                echo base_url(
                                                        'BulkAttendance'
                                                        . '/user_attendence/'.$employee[0]->emp_id); 
                                        ?>">
                                        <div class="thumbnail-link img-thumbnail center-block" style="background-image: url(<?php echo base_url(
                                                    'uploads/staff/employees/'
                                                    .$employee[0]->emp_image); ?>);">
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
                                                    $employee[0]->first_name
                                                    .' '
                                                    .$employee[0]->last_name; 
                                            ?>
                                        </p>
                                    </a>
                                </div>
                            <?php //endif; ?>
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
    filter_status = true;
</script>