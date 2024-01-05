<!-- Menggunakan template/menu sebagai parent -->
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

<!-- Lihat Detail -->
<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">Data Lengkap Pegawai</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <!-- Menampilkan Detail Pegawai Secara Lengkap -->
    <h3 class="text-center"><?= $inspect->nama; ?></h3>
    <h6 class="text-center text-secondary"><?= $jabatan['nama']; ?></h6><br>
    <div class="row">
      <div class="col-5">
        <h5>Nomor Induk Kepegawaian</h5>
      </div>
      <div class="col-1">
        <h5 class="text-center">:</h5>
      </div>
      <div class="col-6">
        <h5 style="text-align: end;"><?= $inspect->unicode; ?> </h5>
      </div>
    </div>
    <div class="row">
      <div class="col-5">
        <h5>Tanggal Bergabung</h5>
      </div>
      <div class="col-1">
        <h5 class="text-center">:</h5>
      </div>
      <div class="col-6">
        <h5 style="text-align: end;"><?= formatDate($inspect->join_at); ?> </h5>
      </div>
    </div>
    <div class="row">
      <div class="col-5">
        <h5>Tanggal Lahir</h5>
      </div>
      <div class="col-1">
        <h5 class="text-center">:</h5>
      </div>
      <div class="col-6">
        <h5 style="text-align: end;"><?= formatDate($inspect->birth_at); ?> </h5>
      </div>
    </div>
    <hr style="background-color: chartreuse;">
    <div class=" row">
      <div class="col">
        <div class="text-center">
          <h5>Nomor Induk Kependudukan</h5>
          <p><?= $inspect->user; ?></p>
          <hr style="background-color: aquamarine; width: 90%">
        </div>
        <div class="text-center">
          <h5>Nomor Pokok Wajib Pajak</h5>
          <p><?= $inspect->npwp; ?></p>
          <hr style="background-color: aquamarine; width: 90%">
        </div>
        <div class="text-center">
          <h5>Nomor Kartu Tanda Penduduk</h5>
          <p><?= $inspect->ktp; ?></p>
        </div>
      </div>
      <div class="col">
        <div class="text-center">
          <h5>Uang Gaji</h5>
          <p><?= formatCurrency($inspect->gaji); ?></p>
          <hr style="background-color: aquamarine; width: 90%">
        </div>
        <div class="text-center">
          <h5>Uang Lembur</h5>
          <p><?= formatCurrency($inspect->lembur); ?></p>
          <hr style="background-color: aquamarine; width: 90%">
        </div>
        <div class="text-center">
          <h5>Uang Bonus</h5>
          <p><?= formatCurrency($inspect->bonus); ?></p>
        </div>
      </div>
    </div>
    <hr style="background-color: chartreuse;">
  </div>
  <div class="card-footer">
    <?= env('APPNAME'); ?>
  </div>
</div>

<!-- Ubah Data -->
<div class="card card-primary collapsed-card">
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
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label class="form-label">NIK.</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="nik" value="<?= $inspect->user; ?>">
        </div>
        <div class="form-group">
          <label class="form-label">NIP.</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="nip" value="<?= $inspect->unicode; ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Uang Gaji</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="gaji" value="<?= $inspect->gaji; ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Uang Lembur</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="lembur" value="<?= $inspect->lembur; ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Uang Bonus</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="bonus" value="<?= $inspect->bonus; ?>">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label class="form-label">Nama Pegawai</label>
          <input type="text" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="nama" value="<?= $inspect->nama; ?>">
        </div>
        <div class="form-group">
          <label class="form-label">NPWP</label>
          <input type="number" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="npwp" value="<?= $inspect->npwp; ?>">
        </div>
        <div class="form-group">
          <label class="form-label">Jabatan</label>
          <select name="jabatan" class="form-control select2">
            <?php foreach ($select as $opt) : ?>
              <option value="<?= $opt['id']; ?>" <?= ($opt['id'] === $inspect->jabatan) ? 'active' : ''; ?>> <?= $opt['nama']; ?> </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Tanggal Masuk</label>
          <input type="date" class="form-control form-control-border" placeholder="Masukan Data ..." autocomplete="off" name="masuk" value="<?= $inspect->join_at; ?>">
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

<div class="row mb-5">
  <div class="col-4">
    <a href="<?= base_url('menu/pegawai'); ?> " class="btn btn-outline-warning btn-block">
      <i class="fas fa-arrow-left"></i> Kembali</a>
  </div>
  <div class="col">
    <a href="<?= base_url('menu/pegawai/resetpw/' . $inspect->id); ?> " class="btn btn-outline-danger btn-block" aria-disabled="true">
      <i class="fas fa-sync"></i> Reset Pw
    </a>
  </div>
  <?php if ($inspect->ipaddr  !== null) : ?>
    <div class="col">
      <a href="<?= base_url('menu/pegawai/resetipv4/' . $inspect->id); ?> " class="btn btn-outline-danger btn-block" aria-disabled="true">
        <i class="fas fa-sync"></i> Reset UID
      </a>
    </div>
  <?php else : ?>
    <div class="col">
      <a href="<?= base_url('menu/pegawai/setipv4/' . $inspect->id); ?> " class="btn btn-outline-danger btn-block" aria-disabled="true">
        <i class="fas fa-sync"></i> Register UID
      </a>
    </div>
  <?php endif; ?>
  <?php if ($inspect->leave_at  === null) : ?>
    <div class="col">
      <a href="<?= base_url('menu/pegawai/resign/' . $inspect->id); ?> " class="btn btn-outline-danger btn-block" aria-disabled="true">
        <i class="fas fa-briefcase"></i> Resign
      </a>
    </div>
  <?php else : ?>
    <div class="col">
      <a href="<?= base_url('menu/pegawai/negresign/' . $inspect->id); ?> " class="btn btn-outline-danger btn-block" aria-disabled="true">
        <i class="fas fa-briefcase"></i> Rekrut
      </a>
    </div>
  <?php endif; ?>
  <div class="col">
    <a href="<?= base_url('menu/pegawai/destroy/' . $inspect->id); ?> " class="btn btn-outline-danger btn-block" aria-disabled="true">
      <i class="fas fa-trash"></i> Delete
    </a>
  </div>
</div>
<?= $this->endSection(); ?>