<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="pull-left">
            Payroll
            <small>All payroll</small>
        </h1>
        <a href="<?php echo base_url('Payroll/add_rate_card'); ?>" class="btn btn-primary pull-right margin-bottom">New
            Rate Card</a>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php $response = $this->session->flashdata('success_msge');if (!empty($response)): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    Success!
                    <?php echo $response; ?>
                </div>
                <?php endif;?>
                <?php $response = $this->session->flashdata('error_msge');if (!empty($response)): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    Failed!
                    <?php echo $response; ?>
                </div>
                <?php endif;?>
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">All Payroll</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid"
                                        aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 20px;">
                                                    <label>
                                                        <input type="checkbox" class="minimal select-all">
                                                    </label>
                                                </th>
                                                <th>Card Title</th>
                                                <th>Pay rate</th>
                                                <th>Daily Hours</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($rate_cards as $rate_card): /*var_dump($rate_card); exit;*/?>
                                            <tr role="row" class="odd">
                                                <td>
                                                    <label>
                                                        <input type="checkbox" class="minimal" value="<?php echo $rate_card->id; ?>">
                                                    </label>
                                                </td>
                                                <td>
                                                    <?php echo $rate_card->card_title; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rate_card->pay_rate.'%'; ?>
                                                </td>
                                                <td>
                                                    <?php echo $rate_card->daily_hours . ' Hours'; ?>
                                                </td>
                                                <td width="100px">
                                                    <a 
                                                        href="<?php 
                                                            echo base_url('Payroll/update_rate_card/')
                                                            .$rate_card->id; 
                                                        ?>"
                                                        class="btn btn-primary btn-xs">
                                                        Edit
                                                    </a>
                                                    <button type="button" 
                                                        data-toggle="modal" 
                                                        data-target=".dialoge"
                                                        class="btn btn-danger btn-xs"
                                                        onclick="get_delete_id(<?php echo $rate_card->id; ?>);">
                                                        delete
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                        <!-- <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Cell Phone</th>
                                                <th>Home Phone</th>
                                                <th>Email</th>
                                                <th>Group</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot> -->
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                        Showing 1 to 10 of 57 entries
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled" id="example1_previous"><a
                                                    href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a>
                                            </li>
                                            <li class="paginate_button active"><a href="#" aria-controls="example1"
                                                    data-dt-idx="1" tabindex="0">1</a>
                                            </li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                    data-dt-idx="2" tabindex="0">2</a></li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                    data-dt-idx="3" tabindex="0">3</a></li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                    data-dt-idx="4" tabindex="0">4</a></li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                    data-dt-idx="5" tabindex="0">5</a></li>
                                            <li class="paginate_button "><a href="#" aria-controls="example1"
                                                    data-dt-idx="6" tabindex="0">6</a></li>
                                            <li class="paginate_button next" id="example1_next"><a href="#"
                                                    aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a>
                                            </li>
                                        </ul>
                                    </div>
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
        <!-- /.row -->
    </section>
</div>