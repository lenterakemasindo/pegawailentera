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

<?php if ($json = json_decode($datatable['dibayar'])) : ?>
  <?php $num = 1;
  foreach ($json->data as $data) : ?>
    <!-- Lihat Data -->
    <div class="card collapsed-card card-info">
      <div class="card-header">
        <h3 class="card-title">Pengajuan Ke-<?= $num++; ?></h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label class="form-label">Tanggal</label>
              <p class="form-control form-control-border"><?= formatDate($data->tgl); ?></p>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label class="form-label">Jumlah</label>
              <p class="form-control form-control-border"><?= formatCurrency($data->jumlah); ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <?= env('APPNAME'); ?>
      </div>
    </div>
  <?php endforeach ?>
<?php endif ?>
<div class="row mb-5">
  <div class="col-6">
    <a href="<?= base_url('menu/kas/tebus'); ?> " class="btn btn-outline-warning btn-block">
      <i class="fas fa-chevron-left"></i> Kembali</a>
  </div>
</div>
<?= $this->endSection(); ?>