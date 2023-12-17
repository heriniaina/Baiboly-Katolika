<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<?php $request = service('request'); ?>
<div class="baiboly_index">
    <div class="float-end tehirizo">

        <?php echo anchor('baiboly/tahiry/create?uri=' . urlencode(uri_string() . "?" . $request->getUri()->getQuery()) . '&name=' . $page_title, lang('Baiboly.tehirizo') . ' <i class="bi-bookmark"></i>', ['class' => 'btn btn-outline-primary']) ?>
    </div>

    <?php if ($andininy) { ?>
        <?php $latest = ['t_b_id' => 0, 'b_t_id' => 0, 'b_and' => 0] ?>
        <?php foreach ($andininy as $a) { ?>
            <?php if ($a['t_b_id'] != $latest['t_b_id']) { ?>
                <h1 class="clearfix">
                    <?php if ($request->getGet('teny')) { ?>
                        <?php echo $a['b_sname'] ?>
                    <?php } else { ?>
                        <?php echo $a['b_name'] ?>
                    <?php } ?>
                </h1>
                <?php if ($a['b_intro']) { ?>
                    <p class="b_intro">
                        <?php echo $a['b_intro'] ?>
                    </p>
                <?php } ?>

            <?php } ?>
            <?php if ($a['b_t_id'] != $latest['b_t_id']) { ?>

                <h3 class="toko clearfix">
                    <?php echo ($a['b_toko'] == 1) ? lang('Baiboly.toko_voalohany') : lang('Baiboly.toko_faha', [$a['b_toko']]); ?>
                </h3>
            <?php } ?>

            <?php if (
                $a['b_and'] == 1
                && !isset($andininy)
                && !isset($teny)
            ) { ?>
                <p class="t_intro">
                    <?php echo $a['t_intro']; ?>
                </p>
                <p class="and clearfix">
                <?php } ?>

                <sup>
                    <?php echo $a['b_and'] ?>
                </sup>
                <?php if (isset($teny)) { ?>
                    <?php $b_text = $a['b_text']; ?>
                    <?php foreach ($teny as $t) { ?>
                        <?php $b_text = str_replace($t, '<span class="highlight">' . $t . '</span>', $b_text); ?>
                    <?php } ?>
                    <?php echo $b_text; ?>
                <?php } else { ?>
                    <?php echo $a['b_text']; ?>
                <?php } ?>

                <?php // echo $a['b_text']; ?>
                <?php if ($a['b_break'] > 0) { ?>
                </p>
                <p class="and clearfix">
                <?php } ?>
                <?php $latest = $a; ?>
            <?php } ?>
        </p>
    <?php } ?>
    <div>
        <?php if ($pager->getPageCount() > 1) { ?>
            <?php echo $pager->links(); ?>
        <?php } ?>
    </div>

</div>
<?php $this->endSection(); ?>