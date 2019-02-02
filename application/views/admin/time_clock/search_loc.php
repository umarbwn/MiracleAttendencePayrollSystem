<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Time Clock Locations
            <small>Add new location</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#">Time Clock Locations</a></li>
            <li class="active">Add new location</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>
                        <h3 class="box-title pull-left">
                            <?php //date_default_timezone_set("Asia/Karachi"); echo date("F j, Y, g:i a"); ?>
                            Add new time clock locations
                        </h3>
                        <button class="btn btn-primary pull-right btn-sm" type="button" data-toggle="modal" data-target="#myModal">Add New</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <?php echo form_open('terminal/location/add', 'id="my-form"'); ?>
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <div class="pac-card" id="pac-card">
                                            <!-- <div>
                                                <div id="type-selector" class="pac-controls">
                                                <input type="radio" name="type" id="changetype-all" checked="checked">
                                                <label for="changetype-all">All</label>
        
                                                <input type="radio" name="type" id="changetype-establishment">
                                                <label for="changetype-establishment">Establishments</label>
        
                                                <input type="radio" name="type" id="changetype-address">
                                                <label for="changetype-address">Addresses</label>
        
                                                <input type="radio" name="type" id="changetype-geocode">
                                                <label for="changetype-geocode">Geocodes</label>
                                                </div>
                                                <div id="strict-bounds-selector" class="pac-controls">
                                                <input type="checkbox" id="use-strict-bounds" value="">
                                                <label for="use-strict-bounds">Strict Bounds</label>
                                                </div>
                                            </div> -->
                                            <div id="pac-container">
                                                <div class="row">
                                                    <div class="form-group col-sm-12">
                                                        <label for="pac-input">Search location:</label>
                                                        <input id="pac-input" 
                                                               type="text"
                                                               class="form-control"
                                                               placeholder="Enter a location">
                                                    </div>
                                                    <div class="form-group col-sm-12">
                                                        <!--<label for="">Or Add current location</label>-->
                                                        <input type="hidden" id="lat" value="" name="lat">
                                                        <input type="hidden" id="long" value="" name="lng">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="map"></div>
                                        <div id="infowindow-content">
                                        <!-- <img src="" width="16" height="16" id="place-icon"> -->
                                            <span id="place-name"  class="title"></span><br>
                                            <span id="place-address"></span>
                                        </div>
                                        <div class="form-group full-width-item">
                                            <label>Terminal name:</label>
                                            <input type="text" 
                                                   name="term_name"
                                                   placeholder="Enter terminal name"
                                                   class="form-control full-width-item">
                                            <?php echo form_error('term_name',
                                                    '<span class="form-error">', 
                                                    '</span>'); ?>
                                        </div>
                                        <div class="form-group full-width-item">
                                            <br>
                                            <button class="btn btn-block 
                                                    btn-primary 
                                                    btn-add-current-loc" 
                                                    type="submit">
                                                <!--<img src="<?php //echo base_url('assets/images/spinner.svg');  ?>" alt="Loading" class="btn-spinner">-->
                                                Add location
                                            </button>
                                        </div>
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
        </div>
    </section>
</div>

<script>
    slug_for_js = 'add_location';
</script>



