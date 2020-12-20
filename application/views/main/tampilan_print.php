<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sim Pengasuhan | STPN</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SPG</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIM</b>PENGASUHAN</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Control Sidebar Toggle Button -->

          <li>
            <a href="<?php echo site_url("login/logout"); ?>"><i class="glyphicon glyphicon-log-out"></i> Log Out</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin Pengasuhan</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?php echo site_url("main/dashboard"); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Tabel Pengasuhan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url("main/peristiwa/penghargaan"); ?>"><i class="fa fa-circle-o" name="penghargaan"></i>Penghargaan</a></li>
            <li><a href="<?php echo site_url("main/peristiwa/pelanggaran"); ?>"><i class="fa fa-circle-o" name="pelanggaran"></i>Pelanggaran</a></li> 
          </ul>
        </li>
       
        <li class="treeview">
                  <a href="#"><i class="fa fa-plus-square"></i> Entry Nilai
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo site_url("main/peristiwa/entry_individu"); ?>"><i class="fa fa-circle-o"></i> Entry Nilai Individu</a></li>
                    <li><a href="<?php echo site_url("main/peristiwa/entry_massal"); ?>"><i class="fa fa-circle-o"></i> Entry Nilai Massal</a></li>
                  </ul>
                </li>

        <li class="treeview"> <a href="#"> <i class="fa fa-table"></i>
<span>Tabel Rekap</span> <span class="pull-right-container"> <i class="fa
fa-angle-left pull-right"></i> </span> </a> <ul class="treeview-menu"> <li><a
href="<?php echo site_url("main/peristiwa/rekap_harga"); ?>"><i class="fa
fa-circle-o"></i> Rekap Penghargaan</a></li> <li><a href="<?php echo
site_url("main/peristiwa/rekap_langgar"); ?>"><i class="fa fa-circle-o"></i>
Rekap Pelanggaran</a></li> <li><a href="<?php echo
site_url("main/peristiwa/rekap_taruna"); ?>"><i class="fa fa-circle-o"></i>
Rekap Taruna</a></li> </ul> </li> <li class="treeview"> <a href="#"> <i
class="fa fa-share"></i> <span>Laporan</span> <span
class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i>
</span> </a> <ul class="treeview-menu"> <li class="treeview"> <a href="#"><i
class="fa fa-circle-o"></i> Cetak <span class="pull-right-container"> <i
class="fa fa-angle-left pull-right"></i> </span> </a> <ul
class="treeview-menu"> <li><a href="#"><i class="fa fa-circle-o"></i> Surat
Keterangan Taruna</a></li> <li><a href="#"><i class="fa fa-circle-o"></i>
Level Three</a></li> </ul> </li> </ul> </li> </ul> </li>         </ul>
</section> <!-- /.sidebar --> </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
      <?php $this->load->view($content);?>
    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->  
   
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>asset/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>asset/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>asset/bower_components/fastclick/lib/fastclick.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>asset/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>asset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>asset/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>asset/dist/js/demo.js"></script>
<script>
$.noConflict();
jQuery( document ).ready(function( $ ) {
    $('#example2').DataTable();
  // $(document).ready(function () {
    $('.sidebar-menu').tree();
    // $('#example2').DataTables();
  })
  
</script>
</body>
</html>
