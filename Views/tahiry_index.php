<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<div class="tahiry_index">
    <h1><?php echo $page_title; ?></h1>
    <p><?php echo lang('Baiboly.lisitry_ny_tahiry') ?></p>
    <?php foreach($rows as $i => $row) { ?>
    <div class="mb-3">
        <div class="fw-bold"><?php echo $i + ($page * 20) - 19  . ". " . anchor($row['uri'], $row['name']) ?></div>       
        <div class="ms-4"><?php echo nl2br(strip_tags($row['note'])) ?></div>
        
    </div>
    <?php } ?>
</div>

<?php $this->endSection(); ?>