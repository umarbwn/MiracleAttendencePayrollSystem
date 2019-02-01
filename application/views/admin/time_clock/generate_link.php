<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Terminal links
            <small>Generate link</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Generate terminal link</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo form_open_multipart('terminal/generate');?>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-3">
                                <div class="form-group">
                                    <label for="position_id">Select location</label>
                                    <select class="form-control" name="location">
                                        <option value="">Select location</option>
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
                                        <?php foreach($positions as $position): ?>
                                            <?php $arr_position['position'] = array(
                                                'id'    => $position->id,
                                                'name'    => $position->name,
                                            ); ?>
                                            <option value="<?php echo htmlentities(json_encode($arr_position)); ?>">
                                                <?php echo $position->name; ?>
                                            </option>
                                        <?php endforeach; ?>
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