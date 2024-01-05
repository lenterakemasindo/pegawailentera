<?= $this->extend('template/menu'); ?>

<!-- Konfigurasi Halaman, Sebaiknya Tidak Dirubah -->
<?= $this->section('page'); ?>
<?= $halaman->page; ?>
<?= $this->endSection(); ?>
<?= $this->section('pages'); ?>
<?= $halaman->page; ?>
<?= $this->endSection(); ?>
<?= $this->section('subPage'); ?>
<?= $halaman->subpage; ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<!-- Konten Dari Halaman : -->

<?= form_open(); ?>
<?php foreach ($datatable as $r) : ?>
  <!-- Form Konfirmasi Data -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"><?= $r['pegawai']['nama'] ?> </h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <input type="hidden" name="<?= $r['pegawai']['id']; ?>id" value="<?= $r['pegawai']['id']; ?>">
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label class="form-label">Kehadiran (hari)</label>
            <input type="number" class="form-control form-control-border" autocomplete="off" name="<?= $r['pegawai']['id']; ?>hadir" value="<?= $r['hadir']; ?>">
          </div>
          <div class="form-group">
            <label class="form-label">Bonus</label>
            <input type="text" class="form-control form-control-border" autocomplete="off" name="<?= $r['pegawai']['id']; ?>bonus" placeholder="(keterangan,jumlah;keterangan,jumlah;)" value="null">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label class="form-label">Lembur (jam)</label>
            <input type="number" class="form-control form-control-border" autocomplete="off" name="<?= $r['pegawai']['id']; ?>lembur" value="0">
          </div>
          <div class="form-group">
            <label class="form-label">Potongan</label>
            <input type="text" class="form-control form-control-border" autocomplete="off" name="<?= $r['pegawai']['id']; ?>potongan" placeholder="keterangan,jumlah;keterangan,jumlah;" value="null">
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <?= env('APPNAME'); ?>
    </div>
  </div>
<?php endforeach ?>
<div class="container mb-3">
  <button class="btn btn-outline-success btn-block btn-lg mt-3"><i class="fas fa-save"></i> Buat Data</button>
</div>
<?= form_close(); ?>
<div class="row mb-5">
  <div class="col-6">
    <a href="<?= base_url('menu/jabatan'); ?> " class="btn btn-outline-warning btn-block">
      <i class="fas fa-chevron-left"></i> Kembali</a>
  </div>
</div>
<?= $this->endSection(); ?>