<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title><?= env('TITLE'); ?></title>

   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="<?= base_url('template/'); ?>https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/fontawesome-free/css/all.min.css">
   <!-- Theme style -->
   <link rel="stylesheet" href="<?= base_url('template/'); ?>dist/css/adminlte.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
   <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
         </ul>

         <!-- Right navbar links -->
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
               </a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                  <i class="fas fa-th-large"></i>
               </a>
            </li>
         </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <!-- Brand Logo -->
         <a href="index3.html" class="brand-link">
            <img src="<?= base_url('template/'); ?>dist/img/sidebar.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light"><?= env('COMPANY'); ?></span>
         </a>

         <!-- Sidebar -->
         <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                  <img src="<?= base_url('template/'); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
               </div>
               <div class="info">
                  <a href="#" class="d-block">Alexander Pierce</a>
               </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
               <div class="input-group" data-widget="sidebar-search">
                  <div class="input-group-append">
                  </div>
               </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <?= $this->include('template/sidebar'); ?>
               </ul>
            </nav>
            <!-- /.sidebar-menu -->
         </div>
         <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
         <div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
            <div class="nav-item dropdown">
               <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Tutup</a>
               <div class="dropdown-menu mt-0">
                  <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Tutup Semua Menu</a>
                  <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Tutup Menu Lain</a>
               </div>
            </div>
            <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
            <ul class="navbar-nav overflow-hidden" role="tablist"></ul>
            <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a>
            <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a>
         </div>
         <div class="tab-content">
            <div class="tab-empty">
               <h2 class="display-4">tidak ada menu aktif</h2>
            </div>
            <div class="tab-loading">
               <div>
                  <h2 class="display-4">Harap Tunggu Sebentar <i class="fa fa-sync fa-spin"></i></h2>
               </div>
            </div>
         </div>
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
         <strong>Copyright &copy; <?= date('Y'); ?> Justin Kelly Lesmana.</strong>
         All rights reserved.
         <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> <?= env('VERSION'); ?>
         </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
   </div>
   <!-- ./wrapper -->

   <!-- jQuery -->
   <script src="<?= base_url('template/'); ?>plugins/jquery/jquery.min.js"></script>
   <!-- jQuery UI 1.11.4 -->
   <script src="<?= base_url('template/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   <script>
      $.widget.bridge('uibutton', $.ui.button)
   </script>
   <!-- Bootstrap 4 -->
   <script src="<?= base_url('template/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- overlayScrollbars -->
   <script src="<?= base_url('template/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
   <!-- AdminLTE App -->
   <script src="<?= base_url('template/'); ?>dist/js/adminlte.js"></script>
</body>

</html>