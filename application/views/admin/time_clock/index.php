<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>

                        <h3 class="box-title pull-left">
                            <?php date_default_timezone_set("Asia/Karachi"); echo date("F j, Y, g:i a"); ?>
                        </h3>
                        <h3 class="box-title pull-right" id="timer"></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php echo form_open_multipart('TimeClock/upload_clock_in_image', ['id' => 'clock_form'])?>
                                    <div class="capture-container">
                                        <canvas id="canvas" width="1024" height="768" style="display: none;"></canvas>
                                        <video autoplay="true" id="videoElement"></video>
                                    </div>
                                    <input type="hidden" name="img_url" value="" id="hidden-field">
                                    <input type="hidden" name="lat" value="" id="lat">
                                    <input type="hidden" name="long" value="" id="long">
                                    <div class="btn-group btn-group-justified">
                                        <a type="submit" class="btn btn-success" id="capture-image">
                                            <img src="<?php echo base_url('assets/images/spinner.svg'); ?>" alt="Loading" class="btn-spinner">
                                            <i class="fas fa-camera-retro"></i> <span>Capture Image and Clock In</span>
                                        </a>
                                        <!-- <a href="#" class="btn btn-primary disabled" id="btn-get-loc">
                                            <img src="<?php echo base_url('assets/images/spinner.svg'); ?>" alt="Loading" class="btn-spinner">
                                            Get location
                                        </a>
                                        <a href="#" class="btn btn-primary disabled" id="btn-clock-in">Clock In</a> -->
                                    </div> 
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-bullhorn"></i>
                        <h3 class="box-title">Callouts</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="callout callout-danger">
                            <h4>I am a danger callout!</h4>

                            <p>There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul,
                                like these sweet mornings of spring which I enjoy with my whole heart.</p>
                        </div>
                        <div class="callout callout-info">
                            <h4>I am an info callout!</h4>

                            <p>Follow the steps to continue to payment.</p>
                        </div>
                        <div class="callout callout-warning">
                            <h4>I am a warning callout!</h4>

                            <p>This is a yellow callout.</p>
                        </div>
                        <div class="callout callout-success">
                            <h4>I am a success callout!</h4>

                            <p>This is a green callout.</p>
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
<script>
    var clock_in_time = '<?php echo $emp_clock_in; ?>';
    slug_for_js = '<?php echo $slug_for_js; ?>';
//     alert(clock_in_time);
</script>

