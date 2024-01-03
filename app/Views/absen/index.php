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
<div class="card collapsed-card card-info">
  <div class="card-header">
    <h3 class="card-title">Cari Data</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <?= form_open(); ?>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label class="form-label">Tanggal Mulai</label>
          <input type="date" class="form-control form-control-border" name="start" value="<?= $value[0]; ?>">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label class="form-label">Tanggal Selesai</label>
          <input type="date" class="form-control form-control-border" name="end" value="<?= $value[1]; ?>">
        </div>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-outline-success btn-block btn-lg mt-3"><i class="fas fa-search"></i> Cari Data</button>
    </div>
    <?= form_close(); ?>
    <div class="card-footer">
      <?= env('APPNAME'); ?>
    </div>
  </div>
</div>

<!-- Card Tabel Pegawai -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Tabel Absensi</h3>
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
          <th>Waktu</th>
          <th>Tipe</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($datatable as $data) : ?>
          <tr class="bg-<?= ($data['tipe'] == 0) ? 'success' : 'warning'; ?>">
            <td><?= formatDate($data['dt']); ?> </td>
            <td><?= $pegawai->find($data['idp'])['nama']; ?></td>
            <td><?= formatTime($data['tmp']); ?></td>
            <td>Absensi <?= ($data['tipe'] == 0) ? 'Masuk' : 'Keluar'; ?></td>
            <?php
            $tmp = explode(':', formatTime($data['tmp']));
            $result = ['Tepat Waktu', 'success'];
            if ($data['tipe'] == 0) {
              $case = explode(':', $jadwal['masuk']);
              $result2 = ['Terlambat', 'danger'];
            } elseif ($data['tipe'] == 1) {
              $case = explode(':', $jadwal['keluar']);
              $result2 = ['Lembur', 'warning'];
            }
            // Jika waktu absen lebih dari waktu yang seharusnya
            switch (true) {
              case $tmp[0] > $case[0]:
                $result = $result2;
                break;
              case $tmp[0] > $case[0] && $tmp[1] > $case[1]:
                $result = $result2;
                break;
              case $tmp[0] > $case[0] && $tmp[1] > $case[1] && $tmp[2] > $case[2]:
                $result = $result2;
                break;
            }
            ?>
            <td class="bg-dark">
              <p class="text-<?= $result[1]; ?>">
                <?= $result[0] ?>
              </p>
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