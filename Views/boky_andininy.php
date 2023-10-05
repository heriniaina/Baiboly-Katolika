<?php $this->extend(getenv('serasera.layout')) ?>
<?php $this->section('main'); ?>
<?php $request = service('request'); ?>
<div class="baiboly_index">
    <div class="float-end tehirizo">

        <?php echo anchor('baiboly/tahiry/create?uri=' . urlencode(uri_string() . "?" . $request->getUri()->getQuery()) . '&name=' . $page_title, lang('Baiboly.tehirizo') . ' <i class="bi-bookmark"></i>', ['class' => 'btn btn-default']) ?>
    </div>
    <h1 class="clearfix">
        <?php echo $boky['b_name'] ?>
    </h1>
    <?php if ($boky['b_intro']) { ?>
        <p class="b_intro">
            <?php echo $andininy['0']['b_intro'] ?>
        </p>
    <?php } ?>


    <div>
        <?php if ($andininy) { ?>
            <?php $latest = ['t_b_id' => 0, 'b_t_id' => 0, 'b_and' => 0] ?>
            <?php foreach ($andininy as $a) { ?>

                <?php if ($a['b_t_id'] != $latest['b_t_id']) { ?>

                    <h3 class="toko clearfix">
                        <?php echo ($a['b_toko'] == 1) ? lang('Baiboly.toko_voalohany') : lang('Baiboly.toko_faha', [$a['b_toko']]); ?>
                    </h3>
                <?php } ?>

                <?php if (
                    $a['b_and'] == 1
                    && !isset($andininy)
                ) { ?>
                    <p class="t_intro">
                        <?php echo $a['t_intro']; ?>
                    </p>
                    <p class="and clearfix">
                    <?php } ?>

                    <sup>
                        <?php echo $a['b_and'] ?>
                    </sup>
                    <?php echo $a['b_text']; ?>

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
</div>
<?php $this->endSection(); ?>

<?php $this->section('headers'); ?>


<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $andininy['0']['b_sname'] . " " . $tokosyandininy ?>" />
<meta property="og:image" content="<?php echo site_url(uri_string()) ?>?output=sary.jpg" />
<meta property="og:description" content="<?php echo $andininy['0']['b_text'] ?>..." />
<meta property="og:url" content="<?php echo site_url(uri_string()); ?>" />

<?php $this->endSection(); ?>