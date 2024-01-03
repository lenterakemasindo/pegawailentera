<?= $this->extend('template/dashboard'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
  Hello <?= findout()['name']; ?> !
</div>
<?= $this->endSection(); ?>