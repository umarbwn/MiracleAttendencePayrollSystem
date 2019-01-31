<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// var_dump($this->session->userdata('user_id')['emp_image'] ); exit;
    $is_admin = $this->session->flashdata('is_admin');
    // echo uri_string(); exit;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Humanity dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>plugins/iCheck/all.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/'); ?>bower_components/select2/dist/css/select2.min.css">
</head>
<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <i class="fas fa-bars"></i>
        </a>
          <!-- Centered Tabs -->
          <ul class="nav nav-pills pull-left">
              <li class="<?php $slug = $this->session->flashdata('active_slug');
                      if($slug == 'welcome' ){ echo 'active'; }
                      elseif($slug == 'welcome'){echo 'active'; }
                      ?> ">
                  <a href="<?php echo base_url('welcome'); ?>"> 
                      <i class="fas fa-tachometer-alt top-menu-icons"></i> 
                      Dashboard
                  </a>
              </li>
              <?php if($is_admin): ?>
                <li class="<?php echo (uri_string() == 'position' || uri_string() == 'position/add') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('position'); ?>">
                        <i class="fas fa-solar-panel top-menu-icons"></i>
                        Position
                    </a>
                </li>
              <?php endif; ?>
              <li class="<?php echo (uri_string() == 'timeclock' || uri_string() == 'timeclock/location') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url('timeclock'); ?>">
                      <i class="far fa-clock top-menu-icons"></i>
                      Time Clock
                  </a>
              </li>
              <!--<li><a href="#">Leave</a></li>-->
              <!--<li><a href="#">Training</a></li>-->
              <?php if($is_admin): ?>
                <li class="<?php echo uri_string() == 'staff' ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('staff'); ?>">
                        <i class="far fa-user top-menu-icons"></i>
                        Staff
                    </a>
                </li>
              <?php endif; ?>
              <li class="<?php echo uri_string() == 'payroll' ? 'active' : ''; ?>">
                  <a href="<?php echo base_url('payroll'); ?>">
                      <i class="fas fa-wallet top-menu-icons"></i>
                      Payroll
                  </a>
              </li>
              <li class="<?php echo ($this->uri->segment(1) == 'ratecard' || uri_string() == 'ratecard') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url('ratecard'); ?>">
                    <i class="fas fa-id-card-alt top-menu-icons"></i>
                      Rate Card
                  </a>
              </li>
              <li class="<?php echo (uri_string() == 'terminal/generate' || uri_string() == 'terminal') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url('terminal'); ?>">
                      <i class="fas fa-thumbtack top-menu-icons"></i>
                      Terminal
                  </a>
              </li>
              <!--<li><a href="#">Payroll</a></li>-->
              <!--<li><a href="#">Reports</a></li>-->
          </ul>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url('uploads/staff/employees/').$this->session->userdata('user_id')['emp_image']; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs">
                  <?php echo $this->session->userdata('user_id')['name']; ?>
                </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url('uploads/staff/employees/').$this->session->userdata('user_id')['emp_image']; ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $this->session->userdata('user_id')['name']; ?>
                    <small>
                      <?php echo $this->session->userdata('user_id')['phone_no']; ?>
                    </small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- <li class="user-body"> -->
                  <!-- <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div> -->
                  <!-- /.row -->
                <!-- </li> -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('Users/logout_user'); ?>" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'welcome'): ?>
            <li class="active treeview">
              <a href="#">
                <i class="fas fa-tachometer-alt"></i> &nbsp; &nbsp; <span>Dashboard</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if(uri_string() == 'welcome'){ echo 'active'; } ?>">
                  <a href="<?php echo base_url('welcome'); ?>">
                    <i class="fa fa-circle-o"></i> Dashbaord
                  </a>
                </li>
                <li class="<?php if(uri_string() == 'welcome/inbox'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/inbox'); ?>"><i class="fa fa-circle-o"></i> Inbox</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if($is_admin): ?>
            <?php if($this->uri->segment(1) == 'timeclock'): ?>
              <li class="active treeview">
                <a href="#">
                  <i class="fas fa-tachometer-alt"></i> &nbsp; &nbsp; <span>Management</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?php if(uri_string() == 'timeclock'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('timeclock'); ?>">
                      <i class="fa fa-circle-o"></i>Manage Time Sheets
                    </a>
                  </li>
                  <li class="<?php if(uri_string() == 'timeclock/location' || uri_string() == 'timeclock/location/add'){ echo 'active'; } ?>">
                    <a href="<?php echo base_url('timeclock/location'); ?>">
                      <i class="fa fa-circle-o"></i>Time Clock Locations
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif; ?>
          <?php endif; ?>
          <?php if($this->uri->segment(1) == 'position'): ?>
            <li class="active treeview">
              <a href="#">
                <i class="fas fa-solar-panel"></i> &nbsp; &nbsp; <span>Position</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if(uri_string() == 'position' || uri_string() == 'position/add'){ echo 'active'; } ?>">
                  <a href="<?php echo base_url('position'); ?>">
                    <i class="fa fa-circle-o"></i>All positions
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
            <?php if($this->uri->segment(1) == 'payroll'): ?>
            <li class="active treeview">
              <a href="#">
                <i class="fas fa-wallet"></i> &nbsp; &nbsp; <span>Payroll</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php if($this->uri->segment(1) == 'payroll'){ echo 'active'; } ?>">
                  <a href="<?php echo base_url('payroll'); ?>">
                    <i class="fa fa-circle-o"></i>Confirmed Time Sheets
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <script>
      var slug_for_js = '';
    </script>
