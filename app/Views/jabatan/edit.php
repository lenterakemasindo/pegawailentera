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

<!-- Form Menambahkan Data -->
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Ubah Data</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <?= form_open(); ?>
    <div class="form-group">
      <label class="form-label">Nama Jabatan</label>
      <input type="text" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="jabatan" value="<?= $datatable->nama; ?>">
      <div class="form-group">
        <button class="btn btn-outline-success btn-block btn-lg mt-3"><i class="fas fa-save"></i> Ubah Data</button>
      </div>
      <?= form_close(); ?>
    </div>
    <div class="card-footer">
      <?= env('APPNAME'); ?>
    </div>
  </div>
</div>
<div class="row mb-5">
  <div class="col-6">
    <a href="<?= base_url('menu/jabatan'); ?> " class="btn btn-outline-warning btn-block">
      <i class="fas fa-chevron-left"></i> Kembali</a>
  </div>
</div>
<?= $this->endSection(); ?>