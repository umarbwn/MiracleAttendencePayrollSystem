<div class="modal modal-danger fade in dialoge">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Are you sure want to delete?</h4>
            </div>
            <div class="modal-body">
                <p>If you will delete the Rate Card, you couldn't be able to restore.</p>
            </div>
            <form id="delete-form">
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-outline" id="delete-btn">Yes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var delete_ratecard_url = '<?php echo base_url('ratecard/delete/'); ?>';
</script>