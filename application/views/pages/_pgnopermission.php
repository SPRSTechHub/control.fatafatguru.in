<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Codeigniter Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin dashboard, admin dashboard template, admin template, bootstrap 5 codeigniter, codeigniter, codeigniter bootstrap admin, codeigniter template, codeigniter bootstrap template, codeigniter admin, codeigniter admin dashboard, codeigniter admin dashboard template, codeigniter admin panel, codeigniter admin template, codeigniter dashboard, dashboard template">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>//assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Sash – Codeigniter Bootstrap 5 Admin & Dashboard Template</title>


    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<?= base_url(); ?>//assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?= base_url(); ?>//assets/css/style.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>//assets/css/dark-style.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>//assets/css/transparent-style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>//assets/css/skin-modes.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="<?= base_url(); ?>//assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?= base_url(); ?>//assets/colors/color1.css" />


    <!-- INTERNAL Switcher css -->
    <link href="<?= base_url(); ?>//assets/switcher/css/switcher.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>//assets/switcher/demo.css" rel="stylesheet" />


</head>

<body class="app text-dark login-img">
    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="<?= base_url(); ?>//assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- PAGE-CONTENT OPEN -->
                <div class="page-content error-page error2 text-white">
                    <div class="container text-left">
                        <div class="error-template">
                            <div class="expanel expanel-default bg-cyan">
                                <div class="expanel-heading">
                                    <h3 class="expanel-title">NO Permission Given</h3>
                                </div>
                                <div class="expanel-body">
                                    <h5 class="error-details">
                                        Access blocked or Permission is unavailable.
                                    </h5>

                                    <ul class="list-group bg-purple text-danger">
                                        <li class="listorder">Allow access to the permission in your browser. To do
                                            this,
                                            click on the lock icon in your browser window and select Reset button.</li>
                                        <li class="listorder">Close all programs that may be using the Permission if
                                            open. If the
                                            problem persists with
                                            your external sources, wait a few
                                            seconds, and then firmly reopen the page after clear catch your browser.
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-center">
                                    <a class="btn btn-secondary mt-5 mb-5" href="<?= base_url(); ?>/entry"> <i
                                            class="fa fa-long-arrow-left"></i> Back to Home </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- END PAGE -->
    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="<?= base_url(); ?>//assets/js/jquery.min.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="<?= base_url(); ?>//assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>//assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Perfect SCROLLBAR JS-->
    <script src="<?= base_url(); ?>//assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="<?= base_url(); ?>//assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="<?= base_url(); ?>//assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="<?= base_url(); ?>//assets/switcher/js/switcher.js"></script>
    <script src="<?= base_url(); ?>assets/js/main.js"></script>
    <script>
    if ((getCookie('perm') == '') || (getCookie('perm1') == '')) {
        location.replace(path + '/entry');
    }
    </script>
</body>

</html>