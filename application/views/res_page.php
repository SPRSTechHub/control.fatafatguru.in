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
    <style>
    .bg-navy {
        color: aliceblue;
        position: relative;
        background: radial-gradient(69.22% 58.06% at 50% 50%, #03204A 0%, #000F24 76.17%);
    }

    .text-navy {
        color: #001D43;
    }

    .badge {
        --bs-badge-padding-x: 0.25em;
        /* --bs-badge-padding-y: 0em; */
        margin: 2px;

    }
    </style>
</head>

<body class="bg-navy text-white">
    <br>
    <div class="container-fluid">
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"
                    checked>
                <label class="form-check-label" for="inlineRadio1">SINGLE / PATTI</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                    value="option2">
                <label class="form-check-label" for="inlineRadio2"> JODI</label>
            </div>
        </div>
        <div class="tab-content mt-4">
            <div class="tab-pane fade show active" id="tabone">
                <div>
                    <?
                    $catid = $this->uri->segment(3, 0);
                    $data = $this->home->fetchResultAll(
                        array('status' => 0, 'cat_id' => $catid),
                        'date',
                        array('rowno' => 10, 'start' => 0),
                        'tbl_results'
                    );
                    ?>
                    <? if ($data) { ?>
                    <? foreach ($data->result() as $rowvalue) { ?>
                    <h6><?= $rowvalue->date; ?></h6>
                    <div class="d-flex flex-wrap">
                        <?
                                $dataByDate = $this->home->fetchResultAll(
                                    array('status' => 0, 'cat_id' => $catid, 'date' => $rowvalue->date),
                                    '',
                                    '',
                                    'tbl_results'
                                );
                                if ($dataByDate) {
                                    foreach ($dataByDate->result() as $rowvalue) { ?>
                        <div>
                            <h2>
                                <span class="badge bg-white text-black rounded-3">
                                    <div class="text-warning"><?= $rowvalue->digit; ?></div>
                                    <div class="text-navy"><?= $rowvalue->patti; ?></div>
                                </span>
                            </h2>
                        </div>

                        <? }
                                } ?>
                    </div>
                    <hr>
                    <?
                        }
                    } ?>

                </div>
            </div>

            <div class="tab-pane fade" id="tabtwo">
                <div class="d-flex flex-wrap">
                    ...
                </div>
            </div>
        </div>
</body>

</html>