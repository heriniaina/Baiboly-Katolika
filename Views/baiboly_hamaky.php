<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<div class="baiboly_hamaky">
    <h1><?php echo lang('Baiboly.hamaky_baiboly') ?></h1>
    <?php if(auth()->loggedIn()) { ?>
        logged in
    <?php } else { ?>
        not logged in
    <?php } ?>
</div>

<?php $this->endSection(); ?>