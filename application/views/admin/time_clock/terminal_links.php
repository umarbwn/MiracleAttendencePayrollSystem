<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Terminal links
        <small>All links</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">Terminal links</a></li>
        <li class="active">All links</li>
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
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title pull-left">
                            <?php //date_default_timezone_set("Asia/Karachi"); echo date("F j, Y, g:i a"); ?>
                            All terminal links
                        </h3>
                        <a class="btn btn-primary pull-right btn-sm" 
                           type="button" 
                           href="<?php echo base_url('TimeClock/generate_terminal_link'); ?>">Generate link</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th>Link Position name</th>
                                        <th>Location</th>
                                        <th>LInk</th>
                                        <th width="100">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($terminals as $terminal): ?>
                                        <tr role="row">
                                            <td><?php echo $terminal->p_name ?></td>
                                            <td><?php echo $terminal->t_location ?></td>
                                            <td>
                                                <input
                                                    id="term-link-input"
                                                    class="form-control"
                                                    onClick="this.setSelectionRange(0, this.value.length)"
                                                    value="<?php echo base_url('BulkAttendance/index/'.$terminal->tl_id); ?>">
                                            </td>
                                            <td>
                                                <a
                                                    href="<?php 
                                                        echo base_url('TimeClock/update_terminal_link/')
                                                        .$terminal->t_id; ?>"
                                                    class="btn btn-primary btn-sm" >Update</a>
                                                <button 
                                                    onclick="delete_terminal_link(<?php echo $terminal->tl_id; ?>)"
                                                    class="btn btn-danger btn-sm" 
                                                    data-toggle="modal" 
                                                    data-target="#dialoge">Delete</button>
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


