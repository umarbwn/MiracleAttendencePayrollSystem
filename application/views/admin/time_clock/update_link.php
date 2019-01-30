<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Terminal links
            <small>Update link</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update terminal link</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open_multipart('TimeClock/update_terminal_link');?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-3">
                                <div class="form-group">
                                    <label for="position_id">Select location</label>
                                    <select class="form-control" name="location">
                                        <?php if(!empty($exist_positions)): ?>
                                            <option value="<?php echo $exist_positions[0]->t_id; ?>">
                                                <?php echo $exist_positions[0]->t_name; ?> Selected
                                            </option>
                                        <?php endif; ?>
                                        <?php foreach($locations as $location): ?>
                                            <option value="<?php echo $location->id; ?>">
                                                <?php echo $location->name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('location',
                                                '<span class="form-error">',
                                                '</span>'); ?>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Select positions</label>
                                    <select class="form-control select2" multiple="multiple"
                                        name="position_id[]"
                                        data-placeholder="Select a State" style="width: 100%;">
                                        <?php if(!empty($exist_positions)): ?>
                                            <?php foreach($exist_positions as $position): ?>
                                                <option value="<?php echo $position->id; ?>" selected>
                                                    <?php echo $position->name; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                    <?php echo form_error('position_id[]',
                                                '<span class="form-error">',
                                                '</span>'); ?>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Generate link</button>
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