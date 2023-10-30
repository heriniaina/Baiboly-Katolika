<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<div class="tahiry_delete">
    <h1><?php echo $page_title; ?></h1>
    <p><?php echo lang('Baiboly.hofafaina_ny_tahiry') ?></p>
    <?php echo anchor('baiboly/tahiry' , lang('Baiboly.tsia'), array('class'=> 'btn btn-secondary')); ?>
    <?php echo anchor(uri_string() . '/confirm', lang('Baiboly.eny'), array('class'=> 'btn btn-danger')); ?>
</div>

<?php $this->endSection(); ?>