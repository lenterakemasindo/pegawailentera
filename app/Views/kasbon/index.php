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
    <div class="form-group">
      <label class="form-label">Tanggal Pengajuan</label>
      <input type="date" class="form-control form-control-border" name="tgl">
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label class="form-label">Nama Pegawai</label>
          <select name="idp" class="form-control select2">
            <?php foreach ($pegawai->findAll() as $data) :  ?>
              <option value="<?= $data['id']; ?>"><?= $data['nama']; ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label class="form-label">Jumlah</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="jumlah">
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">Keterangan</label>
      <input type="text" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="ket">
    </div>
    <div class="form-group">
      <button class="btn btn-outline-success btn-block btn-lg mt-3"><i class="fas fa-save"></i> Simpan Data</button>
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
          <th>Keterangan</th>
          <th>Pengajuan</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1 ?>
        <?php foreach ($datatable as $data) : ?>
          <tr>
            <td><?= formatDate($data['tgl']); ?> </td>
            <td><?= $pegawai->find($data['idp'])['nama']; ?></td>
            <td><?= $data['ket']; ?></td>
            <td><?= formatCurrency($data['jumlah']); ?></td>
            <td>
              <div class="row">
                <div class="col">
                  <a href="<?= base_url('menu/kas/destroy/') . $data['id']; ?>" class="btn btn-outline-danger btn-block" title="Hapus Data">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
                <div class="col">
                  <a href="<?= base_url('menu/kas/edit/') . $data['id']; ?>" class="btn btn-outline-warning btn-block" title="Ubah Data">
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