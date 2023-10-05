<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<div class="boky_index">
    <ol>
        <?php foreach ($rows as $key => $row) { ?>
            <li>
                <?php echo  anchor('boky/' . $row['b_sname'], $row['b_name']) ?>
            </li>
        <?php } ?>
    </ol>
</div>
<?php $this->endSection(); ?>