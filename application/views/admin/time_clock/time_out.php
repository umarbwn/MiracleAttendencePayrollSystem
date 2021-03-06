<!-- Content Wrapper. Contains page content -->
<?php //var_dump($emp_id); exit; ?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-sm-4">
                                <?php //var_dump($break); exit; ?>
                                <?php if($break === false): ?>
                                    <a 
                                        href="<?php echo base_url("break/get/").$emp_id; ?>" 
                                        class="btn btn-warning text-center">
                                        Take break
                                    </a>
                                <?php else: ?>
                                    <?php echo form_open('break/break_out'); ?>
                                        <input type="hidden" name="id" value="<?php echo $break_out->id; ?>">
                                        <input type="hidden" name="break_in" value="<?php echo $break_out->break_in; ?>">
                                        <input type="hidden" name="break_out" value="<?php echo $break_out->break_out; ?>">
                                        <input type="hidden" name="time_clock" value="<?php echo $break_out->time_clock; ?>">
                                        <button
                                            type="submit" 
                                            class="btn btn-primary text-center">
                                            Break Out
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4">
                                <h3 class="timeout-heading text-center">
                                    <?php date_default_timezone_set("Asia/Karachi"); echo date("F j, Y, g:i a"); ?>
                                </h3>
                            </div>
                            <div class="col-sm-4">
                                <h3 class="box-title pull-right" id="timer"></h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php echo form_open_multipart('TimeClock/upload_clock_out_image', ['id' => 'clock_form'])?>
                                    <div class="capture-container">
                                        <canvas id="canvas" width="1024" height="768" style="display: none;"></canvas>
                                        <video autoplay="true" id="videoElement"></video>
                                    </div>
                                    <input type="hidden" name="img_url" value="" id="hidden-field">
                                    <input type="hidden" name="lat" value="" id="lat">
                                    <input type="hidden" name="long" value="" id="long">
                                    <div class="btn-group btn-group-justified btn-group-clock-in-out">
                                        <a type="submit" 
                                            class="btn btn-danger" 
                                            id="capture-image">
                                            <img src="<?php echo base_url('assets/images/spinner.svg'); ?>" alt="Loading" class="btn-spinner">
                                            <i class="fas fa-camera-retro"></i> <span>Capture Image and Clock Out</span>
                                        </a>
                                        <!-- <a type="submit" class="btn btn-success" id="capture-image">
                                            <i class="fas fa-camera-retro"></i> <span>Capture Image</span>
                                        </a>
                                        <a href="#" class="btn btn-primary disabled" id="btn-get-loc">
                                            <img src="<?php echo base_url('assets/images/spinner.svg'); ?>" alt="Loading" class="btn-spinner">
                                            Get location
                                        </a>
                                        <a href="#" class="btn btn-primary disabled" id="btn-clock-in">Clock In</a> -->
                                    </div>
                                    <!-- <button class="btn btn-danger btn-block" id="btn-clock-out">Clock out</button> -->
                                </form>
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
<script>
    var clock_in_time = '<?php echo $emp_clock_in; ?>';
    // alert(clock_in_time);
    slug_for_js = 'user_clock_out';
//     alert(clock_in_time);
    // var server_time = "<?php echo date('Y-m-d H:i:s'); ?>";
    // alert(server_time);
    // date_default_timezone_set("Asia/Karachi"); 
    // echo date("F j, Y, g:i a");
    // var timestamp = "<?php echo date('F j, Y, g:i a'); ?>";
    var emp_id = "<?php echo $emp_id; ?>";
    setInterval(function(){
        $.ajax({
            type: "POST",
            url: base_url + "/TimeClock/get_updated_time/",
            data: {
                clock_in_time: clock_in_time
            },
            success: function(response){
                $('#timer').html(response);
                // console.log(response);
            }
        });
    }, 1000);

</script>

