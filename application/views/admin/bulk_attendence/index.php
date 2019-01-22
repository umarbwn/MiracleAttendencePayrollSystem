<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<!--        <h1>
            Attendence
            <small>Bulk attendence</small>
        </h1>-->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Redirecting</h3>
                    </div>
                    <!-- /.box-header -->
                    <?php echo form_open('BulkAttendance/bulk_attendence/', 
                            ['id' => 'bulk-form']); ?>
                        <input 
                            type="hidden" 
                            value="<?php echo $this->uri->segment(3); ?>" 
                            name="id">
                        <input type="hidden" value="" name="lat" id="lat">
                        <input type="hidden" value="" name="lng" id="long">
                    </form>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>
<!-- Modal -->
<div id="loading" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
<!--      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>-->
      <div class="modal-body loading-modal">
          <img src="<?php echo base_url('assets/images/rolling.svg'); ?>" 
               class="img-responsive pull-left clear loading-image">
          <h1>loading please wait...</h1>
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>
<script>
    slug_for_js = 'bulk_link';
//    alert(slug_for_js);
</script>