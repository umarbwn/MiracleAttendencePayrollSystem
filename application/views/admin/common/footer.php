<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<script>
//    var slug_for_js = '<?php //echo $slug_for_js; ?>';
    // alert(page_uri);
    base_url = "<?php echo base_url(); ?>";
    var custom_base_url = "<?php echo base_url(); ?>";
    var filter_status = false;
</script>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<!--<script src="--><?php //echo base_url('assets/adminlte/'); ?><!--bower_components/raphael/raphael.min.js"></script>-->
<!--<script src="--><?php //echo base_url('assets/adminlte/'); ?><!--bower_components/morris.js/morris.min.js"></script>-->
<!-- Sparkline -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/adminlte/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/adminlte/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="--><?php //echo base_url('assets/adminlte/'); ?><!--dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/adminlte/'); ?>dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/adminlte/'); ?>plugins/iCheck/icheck.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/adminlte/'); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- page script -->
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })

    $('.select-all').click(function(){
        console.log($(this).prop());
    });
</script>
<script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZUGQeUX65hAXw-vH0z5EWlnbpjl-y5Gk&libraries=places&callback=initMap"
        async defer></script>
</body>
</html>
