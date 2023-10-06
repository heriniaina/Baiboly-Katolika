<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>
        <?php echo $page_title ?? lang('Baiboly.home'); ?> - baiboly.katolika.org
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="/css/styles.css?<?php echo time(); ?>" rel="stylesheet">


    <?php $this->renderSection('headers'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
        media="print">
    <link rel="stylesheet" href="/css/print.css?1671925410" media="print">
</head>

<body>


    <div id="header">

        <div class="container container border-bottom border-white">

            <div class="row">
                <div class="col-md-3">
                    <a href="<?php echo base_url() ?>"><img id="logo" src="/img/logo.jpg?v=2023"
                            class="img-fluid"></a>
                </div>
                <div class="col-md-9" id="topub">
                    <div>




                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-sm" id="mainmenu">
        <div class="container">
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                        <?php echo anchor('/', lang('Baiboly.home'), ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?php echo anchor('baiboly/fitadiavana', lang('Baiboly.fitadiavana'), ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?php echo anchor('boky', lang('Baiboly.boky_rehetra'), ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?php echo anchor('baiboly', lang('Baiboly.hamaky'), ['class' => 'nav-link']) ?>
                    </li>
                    <li class="nav-item">
                        <?php echo anchor('fomba-fampiasana-ny-takelaka', lang('Baiboly.momba_ny_takelaka'), ['class' => 'nav-link']) ?>
                    </li>

                    <?php if (isset($user['username'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link position-relative" aria-current="page" href="/baiboly/tahiry">
                                <i class="bi-person-fill"></i>
                                <?php echo $user['username'] ?>
                                <?php if ($notification_count = notification_count($user['username']) > 0) { ?>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $notification_count; ?>
                                    </span>
                                <?php } ?>
                            </a>
                        </li>

                        <li class="nav-item border-0">
                            <a class="nav-link" aria-current="page" href="/logout">
                                <?php echo lang('Serasera.logout') ?>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="https://login.serasera.org/member/signup">
                                <?php echo lang('Serasera.register') ?>
                            </a>
                        </li>
                        <li class="nav-item border-0">
                            <a class="nav-link" aria-current="page" href="/login">
                                <?php echo lang('Serasera.login') ?>
                            </a>
                        </li>
                    <?php } ?>

                </ul>

            </div>

        </div>
    </nav>
    <div class="container pt-3 bg-white" id="page">
        <div class=" p-2">
            <div class="row ">
                <div id="main">

                    <?php if (session('error') !== null): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session('error') ?>
                        </div>
                    <?php endif ?>

                    <?php if (session('message') !== null): ?>
                        <div class="alert alert-success" role="alert">
                            <?= session('message') ?>
                        </div>
                    <?php endif ?>

                    <?php if (session('info') !== null): ?>
                        <div class="alert alert-info" role="alert">
                            <?= session('info') ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($validation)) { ?>

                        <div class="alert alert-danger">
                            <?php echo $validation->listErrors(); ?>
                        </div>

                    <?php } ?>

                    <?php $this->renderSection('main'); ?>
                    <?php $this->renderSection('content'); ?>
                </div>


            </div>

        </div>

        <div class="pt-3 mt-4 text-muted border-top text-center small">
            &copy; <a href="https://hery.serasera.org" target="_blank">Eugene Heriniaina</a> - serasera.org 1999 -
            <?php echo date('Y') ?> - page load {elapsed_time}
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="/js/app.js"></script>

    <?php $this->renderSection('scripts'); ?>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V2BH03QC8R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-V2BH03QC8R');
    </script>

</body>

</html>