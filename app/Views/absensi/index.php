<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk Ke Aplikasi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('template/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('template/'); ?>dist/css/adminlte.min.css">
  <!-- Jam -->
  <link rel="stylesheet" href="<?= base_url('js/'); ?>absensi.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sistem Absensi Menggunakan Kode QR</p>
        <hr>
        <p class="text-center text-secondary">Livetime Clock :</p>
        <div class="jam-digital">
          <div class="kotak">
            <p id="jam"></p>
          </div>
          <div class="kotak">
            <p id="menit"></p>
          </div>
          <div class="kotak">
            <p id="detik"></p>
          </div>
        </div>
        <hr>
        <div style="width: 90%; margin: auto;" id="qrsec"></div>
        <div id="qrlink" hidden><?= base_url('absen/absensi/'); ?></div><br>
      </div>
      <!-- /.login-card-body -->
      <?php if ($popup) : ?>
        <div class="container">
          <div class="alert alert-<?= $type; ?>"><?= $popup; ?> </div>
        </div>
      <?php endif ?>
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('template/'); ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('template/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('template/'); ?>dist/js/adminlte.min.js"></script>
  <!-- QRCode Resources -->
  <script src="<?= base_url('template/'); ?>plugins/qrcode/qr.min.js"></script>
  <script src="<?= base_url('js/'); ?>absensi.js"></script>
</body>

</html>