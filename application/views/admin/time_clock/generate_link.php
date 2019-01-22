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
                    <?php echo form_open_multipart('TimeClock/generate_terminal_link');?>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="form-group">
                                        <label for="position_id">Select position:</label>
                                        <select class="form-control" name="position_id">
                                            <option value="">Select location</option>
                                            <?php foreach($positions as $position): ?>
                                            <option value="<?php echo $position->id; ?>">
                                                <?php echo $position->name; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('position_id',
                                                '<span class="form-error">',
                                                '</span>'); ?>
                                    </div>
                                </div>
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

