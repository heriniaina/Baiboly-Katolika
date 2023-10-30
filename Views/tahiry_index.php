<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<div id='confirm' class="d-none alert alert-danger">
    <p>
        <?php echo lang('Baiboly.hofafaina_ny_tahiry') ?>
    </p>
    <?php echo anchor(uri_string(), lang('Baiboly.tsia'), array('class' => 'btn btn-secondary text-decoration-none')); ?>
    <?php echo anchor(uri_string() . '/confirm', lang('Baiboly.eny'), array('class' => 'btn btn-danger text-decoration-none')); ?>
</div>
<div class="tahiry_index">
    <h1>
        <?php echo $page_title; ?>
    </h1>
    <p>
        <?php echo lang('Baiboly.lisitry_ny_tahiry') ?>
    </p>
    <?php foreach ($rows as $i => $row) { ?>
        <div class="mb-3">
            <div class="fw-bold">
                <?php echo $i + ($page * 20) - 19 . ". " . anchor($row['uri'], $row['name']) ?>
                <?php echo anchor('baiboly/tahiry/delete/' . $row['id'], '<i id="i-' . $row['id'] . '" class="bi-trash ms-3 text-danger"></i>') ?>
            </div>
            <div class="ms-4">
                <?php echo nl2br(strip_tags($row['note'])) ?>
            </div>

        </div>
    <?php } ?>
</div>

<?php $this->endSection(); ?>
<?php $this->section('scripts'); ?>
<script>
    $(function () {
        $('.bi-trash').on('click', (event) => {
            var divc = $('#confirm');
            var btnc = $('#confirm a.btn-danger');
            if ((divc).hasClass('d-none')) {
                var id = event.target.id.split('-')[1];
                divc.removeClass('d-none');
                btnc.attr('href', '<?php echo site_url('baiboly/tahiry/delete/') ?>' + id + '/confirm');
            } else {

                divc.addClass('d-none');
            }

            event.preventDefault();
        });
    });
</script>
<?php $this->endSection(); ?>