<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Time Clock Locations
        <small>All locations</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Time Clock Locations</a></li>
        <li class="active">All locations</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php $response = $this->session->flashdata('success_msge'); if( !empty( $response ) ): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Success! <?php echo $response; ?>
                    </div>
                <?php endif; ?>
                <?php $response = $this->session->flashdata('error_msge'); if( !empty( $response ) ): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                        Failed! <?php echo $response; ?>
                    </div>
                <?php endif; ?>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title pull-left">
                            <?php //date_default_timezone_set("Asia/Karachi"); echo date("F j, Y, g:i a"); ?>
                            All time clock locations
                        </h3>
                        <a 
                            class="btn btn-primary pull-right btn-sm" 
                            type="button" 
                            href="<?php echo base_url('timeclock/location/add'); ?>">
                            Add New
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th>Terminal name</th>
                                        <th>Location</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($results as $location): ?>
                                        <tr role="row">
                                            <td><?php echo $location->name; ?></td>
                                            <td><?php echo $location->location; ?></td>
                                            <td>
                                                <button 
                                                    type="button" 
                                                    data-toggle="modal" 
                                                    data-target="#dialoge"
                                                    class="btn btn-primary btn-sm"
                                                    onclick="delete_location(<?php echo $location->id; ?>);">Delete</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
<?php $this->load->view('admin/time_clock/dialoge_modal'); ?>


