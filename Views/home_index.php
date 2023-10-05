<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<div class="row">
    <div class="col-md-6">
    <div class="mb-3 homebox">
            <h1>
                <?php echo $page_title ?>
            </h1>
            <div>
                <?php echo lang('Baiboly.fandraisana_intro') ?>
            </div>
        </div>
        
        <div class="mb-3 homebox">
            <h1>
                <?php echo lang('Baiboly.hamaky_baiboly') ?>
            </h1>
            <div>
                <?php echo lang('Baiboly.hamaky_baiboly_intro', [anchor('baiboly', lang('Baiboly.mamaky_baiboly_mitohy'), ['class'=> 'fw-bold']), anchor('baiboly/tahiry', lang('Baiboly.pejy_voatahiry'), ['class'=> 'fw-bold'])]) ?>
            </div>
        </div>
        

<div class="mb-3 homebox">
            <h1>
                <?php echo lang('Baiboly.fitadiavana') ?>
            </h1>
            <form action="<?php echo site_url('baiboly') ?>" method="get">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <div class="row">
                            <div class="d-sm-none col-4">
                                <label class="form-label" for="autoSizingInput">
                                    <?php echo lang('Baiboly.boky') ?>
                                </label>
                            </div>
                            <div class="col-auto">
                                <select class="form-select form-control" id="boky" name="boky">
                                    <option value=''>-----
                                        <?php echo lang('Baiboly.boky_rehetra') ?> ------
                                    </option>
                                    <?php foreach ($boky as $b) { ?>
                                        <option value="<?php echo $b['b_sname']; ?>">
                                            <?php echo $b['b_sname']; ?>
                                        </option>

                                    <?php } ?>
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="row">
                            <div class="d-sm-none col-4">
                                <label class="form-label" for="autoSizingInput">
                                    <?php echo lang('Baiboly.toko') ?>
                                </label>
                            </div>
                            <div class="col-8 col-sm-12">
                                <input type="text" class="form-control" name="toko" id="toko"
                                    placeholder="<?php echo lang('Baiboly.toko') ?>">
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <div class="row">
                            <div class="d-sm-none col-4">
                                <label class="form-label" for="autoSizingInput">
                                    <?php echo lang('Baiboly.andininy') ?>
                                </label>
                            </div>
                            <div class="col-8 col-sm-12">
                                <input type="text" class="form-control" name="andininy" id="andininy"
                                    placeholder="<?php echo lang('Baiboly.andininy') ?>">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <div class="row">
                            <div class="d-sm-none col-4">
                                <label class="form-label" for="autoSizingInput">
                                    <?php echo lang('Baiboly.hotadiavina') ?>
                                </label>
                            </div>
                            <div class="col-8 col-sm-12">
                                <input type="text" class="form-control" name="teny" id="teny"
                                    placeholder="<?php echo lang('Baiboly.hotadiavina') ?>">
                            </div>

                        </div>
                    </div>
                </div>
                <button class="btn btn-success w-100" type="submit">
                    <?php echo lang('Baiboly.tadiavo') ?>
                </button>

            </form>
        </div>

        
    </div>
    <div class="col-md-6">
    <div class="mb-3 homebox">
            <h1>
                <?php echo lang('Baiboly.boky_rehetra') ?>
            </h1>
            <div>
                <?php $i = 0; ?>
                <?php foreach ($boky as $b) { ?>
                    <?php if ($i > 0)
                        echo " - "; ?>
                    <?php $i++; ?>
                    <?php echo anchor('boky/' . $b['b_sname'], $b['b_sname']); ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php $this->endSection(); ?>