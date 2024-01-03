<?= $this->extend('pegawaiLanding/template'); ?>

<?= $this->section('content'); ?>
<h1 class="text-center text-secondary">Konfigurasi Data</h1>
<p class="text-center text-sm">Sebelum memulai, harap masukan data anda di formulir berikut.</p>

<?= form_open(); ?>
<div class="card">
  <div class="card-header">
    Form Data Pegawai
  </div>
  <div class="card-body">
    <div class="container">
      <?php if (isset($errors)) : ?>
        <ul>
          <?php foreach ($errors as $e) : ?>
            <li class="text-danger"><?= $e; ?> </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label class="form-label text-center">Nama Lengkap</label>
            <input type="text" class="form-control" placeholder="Masukan data ..." name="nama" value="<?= $user['nama']; ?>" autocomplete="off">
          </div>
          <div class="form-group">
            <label class="form-label text-center mt-3">Kata Sandi</label>
            <input type="text" class="form-control" placeholder="Masukan data ..." name="p@ss" value="<?= $config[0]['value']; ?>" autocomplete="off">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label class="form-label text-center">Tanggal Lahir</label>
            <input type="date" class="form-control" placeholder="Masukan data ..." name="birth_at">
          </div>
          <div class="form-group">
            <label class="form-label text-center mt-3">Nomor KTP</label>
            <input type="text" class="form-control" placeholder="Masukan data ..." name="ktp" autocomplete="off">
          </div>
        </div>
      </div>
      <div class="d-grid gap-2">
        <button class="btn btn-outline-success btn-block mt-5 text-center">Simpan</button>
      </div>
    </div>
  </div>
</div>
<?= form_close(); ?>
<?= $this->endSection(); ?>