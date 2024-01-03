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
    <h3 class="card-title">Tabel Kasbon</h3>
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
          <th>Tanggal</th>
          <th>Nama Pegawai</th>
          <th>Pengajuan</th>
          <th>Sisa</th>
          <th>Status</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 ?>
        <?php foreach ($datatable as $data) : ?>
          <tr>
            <td><?= formatDate($data['tgl']); ?> </td>
            <td><?= $pegawai->find($data['idp'])['nama']; ?></td>
            <td><?= formatCurrency($data['jumlah']); ?></td>
            <?php
            $lunas = 0;
            if ($json = json_decode($data['dibayar'])) {
              foreach ($json->data as $d) {
                $lunas += $d->jumlah;
              }
            }
            $lunas = $data['jumlah'] - $lunas;
            ?>
            <td><?= formatCurrency($lunas); ?></td>
            <td class="text-<?= ($lunas == 0) ? 'success' : 'danger'; ?>"><?= ($lunas == 0) ? "Lunas" : "Belum Lunas"; ?></td>
            <td>
              <div class="row">
                <div class="col">
                  <?php if ($lunas != 0) : ?>
                    <a href="<?= base_url('menu/kas/tebus/') . $data['id']; ?>" class="btn btn-outline-warning btn-block" title="Tebus Kas">
                      <i class="fas fa-check"></i>
                    </a>
                  <?php else : ?>
                    <a href="<?= base_url('menu/kas/tebus/') . $data['id'] . '/view'; ?>" class="btn btn-outline-success btn-block" title="Lihat Data">
                      <i class="fas fa-check"></i>
                    </a>
                  <?php endif ?>
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