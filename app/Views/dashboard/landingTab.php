<?= $this->extend('template/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  Hello <?= findout()['nama']; ?> !
</div>
<?= $this->endSection(); ?>