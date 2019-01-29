<?php //echo uri_string(); exit; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <?php $response = $this->session->flashdata('success_msge');if (!empty($response)): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Alert!</h4>
                        Success!
                        <?php echo $response; ?>
                    </div>
                <?php endif;?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo count($employees); ?></h3>

                        <p>Online Users</p>
                    </div>
                    <div class="icon">
                    <i class="ion ion-person"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <section class="col-lg-7 connectedSortable ui-sortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom" style="cursor: move;">
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right ui-sortable-handle">
                        <li><a href="#sales-chart" data-toggle="tab">Add New</a></li>
                        <li class="active"><a href="#revenue-chart" data-toggle="tab">All Notices</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> Notices</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active" id="revenue-chart"
                            style="cursor: initial; position: relative; height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); overflow-y: auto;">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($notices as $notice): ?>
                                        <tr>
                                            <td>
                                                <?php echo $notice->name; ?>
                                            </td>
                                            <td>
                                                <?php echo $notice->description; ?>
                                            </td>
                                            <td style="width: 90px;">
                                                <div class="btn-group pull-right">
                                                    <a href="#" class="btn btn-sm btn-primary">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button 
                                                        data-toggle="modal" 
                                                        data-target=".dialoge" 
                                                        class="btn btn-sm btn-danger"
                                                        onclick="add_delete_id(<?= $notice->id ?>);">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                            <div class="col-sm-12">
                                <?php echo form_open('Welcome/add_notice', 'id="notice-form"'); ?>
                                    <div class="form-group">
                                        <label for="name" class="control-label">
                                            Name: <span id="name_error"></span>
                                        </label>
                                        <input type="text" class="form-contorl" name="name" id="name" style="width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">
                                            Description: 
                                            <span id="desc_error"></span>
                                        </label>
                                        <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary pull-right" id="add-notice">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.nav-tabs-custom -->
            </section>
            <div class="col-md-5">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-yellow">
                        <div class="widget-user-image">
                            <!-- <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> -->
                            <i class="fas fa-briefcase pull-left" style="font-size: 50px"></i>
                        </div>
                        <!-- /.widget-user-image -->
                        <h3 class="widget-user-username">Who's On Now</h3>
                        <h5 class="widget-user-desc">
                            <?php echo count($employees); ?>
                        </h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <?php foreach($employees as $employee): ?>
                                <li>
                                    <a href="#">
                                        <?php echo $employee->first_name; ?>
                                        <?php echo $employee->last_name; ?>
                                        <span class="pull-right badge bg-blue">4h - 5m</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>