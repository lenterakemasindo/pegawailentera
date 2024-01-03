<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi kepegawaian</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('template/'); ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?= $this->renderSection("page"); ?></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#"><?= $this->renderSection("pages"); ?></a></li>
                <li class="breadcrumb-item active"><?= $this->renderSection('subPage'); ?></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Errors Notification -->
        <?php if (!empty($errors)) : ?>
          <div class="alert alert-danger" role="alert">
            <ul>
              <?php foreach ($errors as $error) : ?>
                <li><?= esc($error) ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('error')) : ?>
          <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error'); ?>
          </div>
        <?php endif ?>

        <?= $this->renderSection('content'); ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('template/'); ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('template/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url('template/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="<?= base_url('template/'); ?>plugins/select2/js/select2.full.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('template/'); ?>dist/js/adminlte.min.js"></script>
  <script src="<?= base_url('js/'); ?>table.js"></script>
</body>

</html>