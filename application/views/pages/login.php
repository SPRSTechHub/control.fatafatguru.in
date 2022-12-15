<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Fatafat SPRS">
    <meta name="author" content="Fatafat SPRS Group">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,sprs,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url(); ?>assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Fatafat Guru</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/dark-style.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/css/transparent-style.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/skin-modes.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="<?= base_url(); ?>assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?= base_url(); ?>assets/colors/color1.css" />

    <!-- JQUERY JS -->
    <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
    <!-- Perfect SCROLLBAR JS-->
    <script src="<?= base_url(); ?>assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script>
    //    let width = screen.width;
    //  if (width < "400") {
    //  location.replace("<?= base_url('login/errorscreen'); ?>");
    //}
    </script>
</head>

<body class="app sidebar-mini ltr login-img">
    <!-- BACKGROUND-IMAGE -->
    <div class="">
        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="<?= base_url(); ?>assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->
        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <a href="#"><img src="<?= base_url(); ?>assets/images/brand/logo-white.png"
                                class="header-brand-img" alt=""></a>
                    </div>
                </div>
                <div class="p-3 container-login80 position-fixed" style="z-index: 99;vertical-align: middle;">
                    <div class="toast show" id="pr_alert" role="alert" aria-live="assertive" aria-atomic="true"
                        data-bs-autohide="false">
                        <div class="toast-header">
                            <i class="ion-game-controller-b"></i>
                            <strong class="me-auto"> Web Permission</strong>
                        </div>
                        <div class="toast-body">
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="container-login100">
                            <div class="wrap-login100 p-6">
                                <form class="login100-form validate-form">
                                    <span class="login100-form-title pb-5">
                                        Login
                                    </span>
                                    <div class="panel panel-primary">

                                        <div class="panel-body tabs-menu-body p-0 pt-5">
                                            <div class="wrap-input100 validate-input input-group"
                                                data-bs-validate="Valid email is required: ex@abc.xyz">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="email"
                                                    placeholder="Email" id="emailid">
                                            </div>
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <a href="javascript:void(0)"
                                                    class="input-group-text bg-white text-muted">
                                                    <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 border-start-0 form-control ms-0" type="password"
                                                    placeholder="Password" id="pass">
                                            </div>
                                            <div class="text-end pt-4">
                                                <p class="mb-0"><a href="<?= base_url(); ?>forgot-password"
                                                        class="text-primary ms-1">Forgot Password?</a></p>
                                            </div>
                                            <div class="container-login100-form-btn">
                                                <a href="#" class="login100-form-btn btn-primary"
                                                    id="login_btn">Login</a>
                                            </div>
                                            <script>
                                            $(document).ready(function() {
                                                $("#login_btn").click(function() {
                                                    var cpk = getCookie('regKey');
                                                    $.post("<?= base_url('login/getLogin/'); ?>", {
                                                            emailid: $("#emailid").val(),
                                                            pass: $("#pass").val(),
                                                            regK: cpk
                                                        },
                                                        function(resp) {
                                                            if (resp) {
                                                                if (resp['status'] == 0) {
                                                                    location.replace(
                                                                        '/home/');
                                                                } else {
                                                                    swal({
                                                                        title: "Status",
                                                                        text: 'Credential Missmatched!',
                                                                        type: 'warning'
                                                                    });
                                                                    //alert(resp['status']);
                                                                }
                                                            }
                                                        });
                                                });
                                            });
                                            </script>
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <video id="player" controls autoplay style="display: none;"></video>
                    <canvas id="canvas" width="320" height="240"></canvas>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!-- END PAGE -->
    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->
    <!-- BOOTSTRAP JS -->
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="<?= base_url(); ?>assets/js/show-password.min.js"></script>

    <!-- SWEET-ALERT JS -->
    <script src="<?= base_url(); ?>assets/plugins/sweet-alert/sweetalert.min.js"></script>
    <!-- GENERATE OTP JS -->
    <script src="<?= base_url(); ?>assets/js/generate-otp.js"></script>

    <!-- Color Theme js -->
    <script src="<?= base_url(); ?>assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="<?= base_url(); ?>assets/js/custom.js"></script>
    <script src="<?= base_url(); ?>assets/js/main.js"></script>
    <script type="module" src="<?= base_url(); ?>/assets/js/mcf.js" async></script>

    <script>
    $('#pr_alert').show();
    const constraints = {
        video: true,
    };
    var stream;

    const permChek = setInterval(async () => {
        const res = await navigator.permissions.query({
            name: 'camera'
        }).then((result) => {
            if (result.state === 'granted') {
                setCookie('perm', '', -1);
                clearTimeout(permChek);
            } else {
                askCamcode();
            }
        });
    }, 3000);

    const permChek1 = setInterval(async () => {
        const res = await navigator.permissions.query({
            name: 'notifications'
        }).then((result) => {
            if (result.state === 'granted') {
                setCookie('perm1', '', -1);
                clearTimeout(permChek1);
            } else {
                notifyMe();
            }
        });
    }, 3000);

    function askCamcode() {
        if (!navigator.mediaDevices?.enumerateDevices) {
            console.log("enumerateDevices() not supported.");
            setCookie('perm', '', -1);
        } else {
            navigator.mediaDevices.getUserMedia(constraints)
                .then((rstream) => {
                    setCookie('perm', '', -1);
                })
                .catch((err) => {
                    setCookie('perm', err.message, 1);
                });
        }
    }

    function notifyMe() {
        Notification.requestPermission().then((permission) => {
            if (permission === "granted") {
                const notification = new Notification("Hi there!");
                setCookie('perm1', '', 1);
            } else {
                setCookie('perm1', permission, 1);
            }
        });
    }

    const perChek = setInterval(() => {
        //(getCookie('perm') != '') || 
        if ((getCookie('perm1') != '')) {
            $('#pr_alert').show();
        } else {
            $('#pr_alert').hide();
        }
    });

    document.querySelector('#login_btn').addEventListener('click', function() {

    });


    function vidOff() {
        const stream = mediaStream;
        const tracks = stream.getTracks();
        tracks[0].stop;

    }

    function sendData(data) {
        var blob = new Blob([JSON.stringify(data)]);
        var url = URL.createObjectURL(blob);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/push/activation/', true);
        var formData = new FormData();
        formData.append('file', blob, 'ss.jpeg');
        //formData.append('actv', actcode);
        xhr.onload = function(e) {
            console.log("File uploading completed!");
        };
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var tr = JSON.parse(this.responseText);
                if (tr.status == 0) {
                    location.replace('<?= base_url(); ?>');
                } else {
                    alert('Server Error! Try again later.');
                }
            }
        };
        console.log("File uploading started!");
        xhr.send(formData);
    }
    </script>
</body>

</html>