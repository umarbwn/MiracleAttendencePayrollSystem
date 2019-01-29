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
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>150</h3>

                        <p>New Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
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
                            style="position: relative; height: 300px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); overflow-y: auto;">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Lorem ipsum dolor sit amet.
                                        </td>
                                        <td>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla ipsam. Reprehenderit dolores, ut harum ab porro officia necessitatibus aliquam quae numquam nihil tenetur ipsam, consequuntur molestiae inventore asperiores explicabo.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Lorem ipsum dolor sit amet.
                                        </td>
                                        <td>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla ipsam. Reprehenderit dolores, ut harum ab porro officia necessitatibus aliquam quae numquam nihil tenetur ipsam, consequuntur molestiae inventore asperiores explicabo.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Lorem ipsum dolor sit amet.
                                        </td>
                                        <td>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla ipsam. Reprehenderit dolores, ut harum ab porro officia necessitatibus aliquam quae numquam nihil tenetur ipsam, consequuntur molestiae inventore asperiores explicabo.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Lorem ipsum dolor sit amet.
                                        </td>
                                        <td>
                                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis, nulla ipsam. Reprehenderit dolores, ut harum ab porro officia necessitatibus aliquam quae numquam nihil tenetur ipsam, consequuntur molestiae inventore asperiores explicabo.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                            <div class="col-sm-12">
                                <form action="">
                                    <div class="form-group">
                                        <label for="name" class="control-label">Name:</label>
                                        <input type="text" class="form-contorl" name="name" id="name" style="width: 100%;">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" rows="6" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary pull-right">
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
                        <h5 class="widget-user-desc">47</h5>
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Employee name 1 <span class="pull-right badge bg-blue">4h - 5m</span></a></li>
                            <li><a href="#">Employee name 2 <span class="pull-right badge bg-aqua">6h - 4m</span></a></li>
                            <li><a href="#">Employee name 3 <span class="pull-right badge bg-green">7h - 12m</span></a>
                            </li>
                            <li><a href="#">Employee name 4 <span class="pull-right badge bg-red">1h - 58m</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>