<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pegawai Lentera</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="<?= base_url('js/'); ?>bootstrap.css">
</head>

<body style="background-color: lavender; min-height: 1000px;">
  <!-- Navbar -->
  <nav class="navbar navbar-expand bg-body-tertiary fixed-top">
    <div class="container">
      <span class="navbar-brand mb-0 h1">
        <b>Pegawai</b>Lentera
      </span>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/profil">Profil</a></li>
              <li><a class="dropdown-item" href="/absen">Absensi</a></li>
              <li><a class="dropdown-item" href="#">Slip Gaji</a></li>
              <li><a class="dropdown-item" href="/logout">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <!-- Content Here : -->
  <div class="content-wrapper container mt-5">
    <br>
    <?= $this->renderSection('content'); ?>
  </div>
  <!-- End Content -->

  <!-- Footer -->
  <footer class="fixed-bottom bg-body-tertiary text-center text-lg-start">
    <div class="text-center p-3 bg-dark text-light">
      Copyright &copy; <?= env('TITLE'); ?> <?= env('COMPANY'); ?> <?= date('Y'); ?>
    </div>
  </footer>
  <!-- Footer End -->
  <script src="<?= base_url('js/'); ?>bootstrap.js"></script>
</body>

</html>