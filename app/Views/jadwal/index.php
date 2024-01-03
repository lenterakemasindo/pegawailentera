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

<!-- Card Tabel Pegawai -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Tabel Jadwal</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <!-- Tabel data -->
    <table id="table" class="table table-bordered table-stripped">
      <thead>
        <tr>
          <th>No.</th>
          <th>Hari</th>
          <th>Jam Masuk</th>
          <th>Jam Keluar</th>
          <th>Ubah</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 ?>
        <?php foreach ($datatable as $data) : ?>
          <tr>
            <td><?= $i; ?> </td>
            <td><?= $day[$i++ - 1]; ?></td>
            <td><?= $data['masuk']; ?></td>
            <td><?= $data['keluar']; ?></td>
            <td>
              <div class="row">
                <div class="col">
                  <a href="<?= base_url('menu/jadwal/edit/') . $data['id']; ?>" class="btn btn-outline-warning btn-block" title="Ubah Data">
                    <i class="fas fa-edit"></i>
                  </a>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class=" card-footer">
    <?= env('APPNAME'); ?>
  </div>
</div>
<?= $this->endSection(); ?>