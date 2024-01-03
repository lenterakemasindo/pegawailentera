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
    <h3 class="card-title">Tambah Data</h3>
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
          <label class="form-label">NIK.</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="nik">
        </div>
        <div class="form-group">
          <label class="form-label">NIP.</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="nip">
        </div>
        <div class="form-group">
          <label class="form-label">Uang Gaji</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="gaji">
        </div>
        <div class="form-group">
          <label class="form-label">Uang Lembur</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="lembur">
        </div>
        <div class="form-group">
          <label class="form-label">Uang Bonus</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="bonus">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label class="form-label">Nama Pegawai</label>
          <input type="text" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="nama">
        </div>
        <div class="form-group">
          <label class="form-label">NPWP</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="npwp">
        </div>
        <div class="form-group">
          <label class="form-label">Jabatan</label>
          <select name="jabatan" class="form-control select2">
            <?php foreach ($select as $opt) : ?>
              <option value="<?= $opt['id']; ?>"> <?= $opt['nama']; ?> </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Tanggal Masuk</label>
          <input type="date" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="masuk">
        </div>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-outline-success btn-block btn-lg"><i class="fas fa-save"></i> Simpan Data</button>
    </div>
    <?= form_close(); ?>
  </div>
  <div class="card-footer">
    <?= env('APPNAME'); ?>
  </div>
</div>

<!-- Card Tabel Pegawai -->
<div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">Tabel Pegawai</h3>
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
          <th>NIP.</th>
          <th>Nama Pegawai</th>
          <th>Jabatan</th>
          <th>Status</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($datatable as $data) : ?>
          <tr>
            <td><?= $data['unicode']; ?></td>
            <td><?= $data['nama']; ?></td>
            <td>
              <?php foreach ($select as $opt) :
                if ($opt['id'] == $data['jabatan']) echo $opt['nama'];
              endforeach; ?>
            </td>
            <td class="text-<?= ($data['leave_at']  === null) ? 'success' : 'danger'; ?>">
              <?= ($data['leave_at']  === null) ? 'Aktif' : 'Keluar'; ?>
            </td>
            <td>
              <a href="<?= base_url('menu/pegawai/details/') . $data['id']; ?>" class="btn btn-outline-info btn-block" title="Lihat Lebih Lanjut">
                <i class="fas fa-eye"></i>
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
  <div class="card-footer">
    <?= env('APPNAME'); ?>
  </div>
</div>
<?= $this->endSection(); ?>