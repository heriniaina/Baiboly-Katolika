<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<div class="boky_show">
    <h1><?php echo $boky['b_name'] ?></h1>
    <?php foreach ($rows as $key => $row) { ?>
        <div>
            <?php echo $row['t_toko'] . ". " . anchor('boky/' . $boky['b_sname'] . '/' . $row['t_toko'], $row['t_intro']) ; ?>
        </div>
    <?php } ?>
</div>
<?php $this->endSection(); ?>