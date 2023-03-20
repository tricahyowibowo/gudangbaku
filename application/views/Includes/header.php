<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $pageTitle ?></title>
  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/SIAMIR.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte2/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte2/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte2/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap.min.css">
  <!-- Sweetalert -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert/dist/sweetalert.css">
  <!-- DateTime -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/datetimepicker/css/bootstrap-datetimepicker.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte2/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte2/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">

  <style>
    .error{
      color:red;
      font-weight: normal;
    }

    .modal-dialog{
    width: 90%;
    }

    #load{
    width: 100%;
    height: 100%;
    position: fixed;
    text-indent: 100%;
    background: #0A1452 url('./assets/images/spinner-b.gif') no-repeat center;
    z-index: 1;
    opacity: 0.6;
  }
  </style>
<script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <!-- <body class="sidebar-mini skin-black-light"> -->
  <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  <div id="load"></div>
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>KSM</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Wasim | Mirota KSM</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-user"></i>
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header" style="height: 80px ;">
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
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
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="">
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
            </li>
            <?php
            if($role == ROLE_ADMIN || $role == ROLE_KABAG){?>
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-list"></i> <span>Master Data</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>Datasupplier"><i class="fa fa-circle-o"></i> Data Supplier</a></li>
                <li><a href="<?php echo base_url(); ?>Datamaklon"><i class="fa fa-circle-o"></i> Data Perusahaan</a></li>
                <li><a href="<?php echo base_url(); ?>Databahan"><i class="fa fa-circle-o"></i> Data Bahan Baku</a></li>
                <li><a href="<?php echo base_url(); ?>Uploadstok"><i class="fa fa-circle-o"></i> Upload Stok</a></li>
              </ul>
            </li>
            <?php } ?>
            <li class="header">GUDANG BAHAN BAKU</li>
            <li>
              <a href="<?php echo base_url(); ?>Databarangmasuk">
                <i class="fa fa-sign-in"></i> 
                <span>Stok Bahan Baku</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>Databarangkeluar">
                <i class="fa fa-sign-out"></i> 
                <span>Data Bahan Baku Keluar</span>
              </a>
            </li>
            <li class="header">Laporan</li>
            <li>
              <a href="<?php echo base_url(); ?>Laporankeluar">
                <i class="fa fa-file"></i>
                <span>Laporan Barang Keluar</span>
              </a>
            </li>
            <?php
            if($role == ROLE_ADMIN)
            {
            ?>
            <li class="header">User Management</li>
            <li>
              <a href="<?php echo base_url(); ?>userListing">
                <i class="fa fa-users"></i>
                <span>Users</span>
              </a>
            </li>
            <?php
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
