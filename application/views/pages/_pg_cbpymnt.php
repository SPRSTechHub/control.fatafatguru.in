<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script type="text/javascript">
    function moveToScreen() {
        Android.moveToNextScreen();
    }
    </script>
</head>

<body>
    <main>
        <div class="container-fluid">
            <div class="">
                <? $stat = $this->input->get('prevStat'); ?>

                <?
                $od = $this->input->get('OD');
                $datum = $this->session->has_userdata('sprspymntod');
                if ($stat == 'COMPLETED') {
                ?>
                <div class="row">
                    <div class="col-12">
                        <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_jbrw3hcz.json"
                            background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay>
                        </lottie-player>
                        <h1>Your Payment <?= $stat; ?></h1>
                    </div>
                </div>

                <?
                } else {
                ?>
                <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_ed9D2z.json" background="transparent"
                    speed="1" style="width: 300px; height: 300px;" loop autoplay></lottie-player>
                <h1>Your Payment <?= $stat; ?></h1>
                <?
                }
                ?>
            </div>
            <div class="">
                <button onclick="moveToScreen();" class="btn btn-success">moveToScreen</button>
                <button onClick="document.location.href='http://exitme';" class="btn btn-success">Exit</button>
            </div>
        </div>
    </main>
</body>

</html>