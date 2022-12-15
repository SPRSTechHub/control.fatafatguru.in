<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="./css/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <style>
    .bg-navy {
        color: aliceblue;
        position: relative;
        background: radial-gradient(69.22% 58.06% at 50% 50%, #03204A 0%, #000F24 76.17%);
    }

    .newText {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 700;
        font-size: 20px;
    }

    .badge {
        --bs-badge-padding-x: 0.7em;
        --bs-badge-padding-y: 0.3em;
        margin: 2px;
    }

    * {
        box-sizing: border-box;
    }

    .img_cat {
        height: 76px;
        width: 92px;
        border-radius: 12px;
    }

    .mycard {
        border-radius: 25px !important;
    }
    </style>
</head>

<body class="bg-navy text-white">
    <div class="container-fluid">
        <div>
            <!--  <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#tabone" data-bs-toggle="tab">GAME LISTS</a>
                </li>
            </ul> -->
            <div class="tab-content">
                <div class="tab-pane fade show active mb-2" id="tabone">
                    <?
                    $data = $this->home->fetchResult(array('status' => 0), 'cat_id', 'tbl_results');
                    ?>
                    <? if ($data) {
                        foreach ($data->result() as $rowvalue) {
                            echo $rowvalue->cat_id;
                            $getCat = $this->home->fetchResult(array('status' => 0, 'cat_id' => $rowvalue->cat_id), '', 'tbl_game_catagory');
                            if ($getCat) {
                                $getCat = $getCat->row();
                            }
                    ?>
                    <div class="bg-dark bg-gradient mb-2 p-2 mt-4 shadow rounded mycard">
                        <a href="<?= base_url() . '/results/result/' . $getCat->cat_id . '/0'; ?>"
                            style="text-decoration:none;">
                            <div class="row">
                                <div class="col-md-4 col-4">
                                    <img src="<?= base_url() . '/uploads/cat_img/' . $getCat->cat_iurl; ?>"
                                        class="img_cat" />
                                </div>
                                <div class="col-md-8 col-8">
                                    <div class="d-flex flex-column">
                                        <div class="text-white p-2">
                                            <h4 class="newText"><?= $getCat->cat_title; ?></h4>
                                        </div>
                                        <button class="btn btn-block btn-light newText">View</button>
                                    </div>

                                </div>


                            </div>
                        </a>
                    </div>
                    <? }
                    } else { ?>
                    <center>
                        <span class="blur">
                            No games
                        </span>
                    </center>
                    <hr>
                    <? }
                    ?>

                </div>
                <div class="tab-pane fade" id="tabtwo">
                    <div class="d-flex flex-wrap">
                        <script type='text/javascript'>
                        function changeColour(elementId) {
                            var interval = 100;
                            var colour1 = '#ff00ff',
                                colour2 = 'blue';
                            if (document.getElementById) {
                                var element = document.getElementById(elementId);
                                element.style.color = (element.style.color == colour1) ? colour2 : colour1;
                                setTimeout("changeColour('" + elementId + "')", interval);
                            }
                        }
                        </script>
                        <p id="blinky">Add Your Text Here</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>