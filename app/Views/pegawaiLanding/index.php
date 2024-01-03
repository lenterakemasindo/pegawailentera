<?= $this->extend('pegawaiLanding/template'); ?>

<?= $this->section('content'); ?>
<h1 class="text-center text-secondary"><?= env('APPNAME'); ?> </h1>
<p class="text-center text-sm">Halo <?= $user['nama']; ?> !</p>
<hr class="container">

<?= $this->endSection(); ?>