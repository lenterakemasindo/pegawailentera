<?php if (roots() === 'dashboard') : ?>
  <li class="nav-item">
    <a href="<?= base_url('dashboard'); ?> " class="nav-link active">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Dasbor
      </p>
    </a>
  </li>

  <li class="nav-item">
    <a href="<?= base_url('absen'); ?> " class="nav-link">
      <i class="nav-icon fas fa-qrcode"></i>
      <p>
        Reader Absensi
      </p>
    </a>
  </li>
<?php endif; ?>

<!-- Mencegah klik jika bukan di halaman admin -->
<li class="nav-item">
  <?= (roots() !== 'admin') ? '<a' : '<span'; ?> href="<?= base_url('admin'); ?>" class="nav-link <?= (roots() === 'admin') ? 'bg-info' : ''; ?>">
  <i class="nav-icon fas fa-desktop"></i>
  <p>
    Admin Workhouse
  </p>
  <?= (roots() !== 'admin') ? '</a>' : '</span>' ?>
</li>

<!-- Menu Khusus Untuk Admin Workspace -->
<?php if (roots() === 'admin') : ?>
  <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-users"></i>
      <p>
        Pengguna
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="<?= base_url('menu/pegawai'); ?>" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Data Pegawai</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('menu/jabatan'); ?>" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Data Jabatan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('template/index.html'); ?>" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Data Pengguna</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-concierge-bell"></i>
      <p>
        Absensi
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="<?= base_url('menu/absen/masuk'); ?>" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Data Absensi Masuk</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('menu/absen/keluar'); ?>" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Data Absensi Keluar</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('menu/absen'); ?>" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Semua Data Absensi</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?= base_url('menu/jadwal'); ?>" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Jadwal Kerja</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="<?= base_url('menu/rules'); ?>" class="nav-link">
      <i class="nav-icon fas fa-list-alt"></i>
      <p>
        Peraturan Perusahaan
      </p>
    </a>
  </li>
<?php endif; ?>