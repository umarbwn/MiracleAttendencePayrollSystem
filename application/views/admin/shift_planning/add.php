<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="pull-left">
            Positions
            <small>Add Position</small>
        </h1>
        <a href="#" class="btn btn-primary pull-right margin-bottom">Add Positions</a>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Position</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open_multipart('ShiftPlanning/add_position');?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="
                                        form-group
                                        <?php
                                            $error = form_error(
                                                'pos_name',
                                                '<small class="form-error">',
                                                '</small>'
                                            );
                                            if( !empty($error) ){ echo 'has-error'; }
                                        ?>
                                    ">
                                        <label for="first_name">Position name:</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="pos_name"
                                            id="first_name"
                                            placeholder="Enter position name"
                                            value="<?php echo set_value('pos_name'); ?>"
                                        >
                                        <?php echo $error; ?>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="
                                        form-group
                                        <?php
                                            $error = form_error(
                                                'pos_location',
                                                '<small class="form-error">',
                                                '</small>'
                                            );
                                            if( !empty($error) ){ echo 'has-pos_location'; }
                                        ?>
                                    ">
                                        <label for="">Select location:</label>
<!--                                        <input
                                            type="text"
                                            class="form-control"
                                            name="first_name"
                                            id="first_name"
                                            placeholder="Enter first name"
                                            value="<?php echo set_value('pos_location'); ?>"
                                        >-->
                                        <select class="form-control" name="pos_location">
                                            <option value="">Select location</option>
                                            <?php foreach($terminals as $terminal): ?>
                                            <option value="<?php echo $terminal->id; ?>">
                                                    <?php echo $terminal->name; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo $error; ?>
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

