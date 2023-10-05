<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<?php $request = service('request'); ?>
<div class="tahiry_create">
    <h1><?php echo $page_title; ?></h1>
    <p><?php echo lang('Baiboly.tehirizo_fanazavana') ?></p>
    <form method="post">
        <?php echo csrf_field() ?>
        <input type="hidden" name="uri" value="<?php echo $request->getGet('uri') ?>">
        <input type="hidden" name="name" value="<?php echo $request->getGet('name') ?>">
        <div class="mb-3">
          <label for="" class="form-label"><?php echo lang('Baiboly.ho_tehirizina') ?></label>
          <span class="fw-bold"><?php echo $request->getGet('name') ?></span>
        </div>
        <div class="mb-3">
          <label for="note" class="form-label"><?php echo lang('Baiboly.fanamarihana') ?></label>
          <textarea class="form-control" name="note" id="note" rows="3"></textarea>
        </div>
        <div class="mb-3">
          <button type="submit" name="" id="" class="btn btn-success"><?php echo lang('Baiboly.tehirizo') ?></button>
        </div>
    </form>
</div>
<?php $this->endSection(); ?>