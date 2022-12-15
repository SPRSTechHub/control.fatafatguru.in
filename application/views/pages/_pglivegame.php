<!--app-content open-->
<div class="main-content app-content mt-0">
    <?
    $cgid = $this->input->get('gid');
    $cgid = !empty($cgid) ? $cgid : 'FFLV15';
    $findGame = $this->home->find(array('match_id' => $cgid), 'tbl_gamelist');
    $curr_bets = $this->home->findBets(array('match_id' => $cgid), 'tbl_bets');
    $sd = array();
    $sp = array();
    $dp = array();
    $tp = array();
    $cp = array();
    ?>
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Actual Bets Placement:
                    <?= !empty($findGame) ? $findGame->row()->game_title : Null; ?>
                </h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Live Game</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <?

            if ($curr_bets) {
                foreach ($curr_bets->result() as $row_data) {
                    if ($row_data->bet_type == 'SingleDigit') {
                        $sd[$row_data->bet_val] = $row_data->bb . '<span class="tag-addon tag-info">' . $row_data->bbi . '</span>';
                    }
                    if ($row_data->bet_type == 'SinglePanna') {
                        $sp[$row_data->bet_val] = $row_data->bb . '<span class="tag-addon tag-info">' . $row_data->bbi . '</span>';;
                    }
                    if ($row_data->bet_type == 'DoublePanna') {
                        $dp[$row_data->bet_val] = $row_data->bb . '<span class="tag-addon tag-info">' . $row_data->bbi . '</span>';;
                    }
                    if ($row_data->bet_type == 'TripplePanna') {
                        $tp[$row_data->bet_val] = $row_data->bb . '<span class="tag-addon tag-info">' . $row_data->bbi . '</span>';;
                    }
                    if ($row_data->bet_type == 'cp') {
                        $cp[$row_data->bet_val] = $row_data->bb . '<span class="tag-addon tag-info">' . $row_data->bbi . '</span>';;
                    }
                }
            }
            ?>
            <div class="row mb-2">
                <div class="col-md-7">
                    <div class="expanel expanel-primary">
                        <div class="expanel-heading">
                            <h3 class="expanel-title">Single Digits</h3>
                        </div>
                        <div class="expanel-body py-2">
                            <div class="table-responsive">
                                <table
                                    class="table border text-nowrap text-md-nowrap table-bordered mb-0 table-sm text-center">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-default mb-2">0</a>
                                                    <?
                                                    $sd0 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '0'));
                                                    if ($sd0) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd0->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd0->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-primary  mb-2">1</a>
                                                    <?
                                                    $sd1 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '1'));
                                                    if ($sd1) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd1->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd1->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-secondary  mb-2">2</a>
                                                    <?
                                                    $sd2 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '2'));
                                                    if ($sd2) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd2->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd2->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-success  mb-2">3</a>
                                                    <?
                                                    $sd3 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '3'));
                                                    if ($sd3) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd3->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd3->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-info  mb-2">4</a>
                                                    <?
                                                    $sd4 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '4'));
                                                    if ($sd4) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd4->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd4->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-warning  mb-2">5</a>
                                                    <?
                                                    $sd5 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '5'));
                                                    if ($sd5) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd5->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd5->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-danger  mb-2">6</a>
                                                    <?
                                                    $sd6 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '6'));
                                                    if ($sd6) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd6->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd6->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)" class="btn btn-outline-info mb-2">7</a>
                                                    <?
                                                    $sd7 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '7'));
                                                    if ($sd7) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd7->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd7->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-warning mb-2">8</a>
                                                    <?
                                                    $sd8 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '8'));
                                                    if ($sd8) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd8->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd8->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-outline-danger mb-2">9</a>
                                                    <?
                                                    $sd9 = $this->home->findDBets(array('match_id' => $cgid, 'bet_val' => '9'));
                                                    if ($sd9) {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2">₹ ' . $sd9->bbv . '</span><h6 class="text-yellow btn btn-outline-default"> <span>' . $sd9->bbc . '</span></h6>';
                                                    } else {
                                                        echo '<span class="badge bg-danger rounded-pill float-end mb-2"> --- </span><h6 class="text-yellow btn btn-outline-default"> <span>0</span></h6>';
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between">
                                    <?
                                    if ($sd) {
                                        foreach ($sd as $key => $value) { ?>
                                    <?
                                            echo '<span class="tag tag-dark">No: ' . $key . '<span class="tag-addon tag-warning">' . $value . '</span></span>';
                                        }
                                    } else {
                                        echo '<span class="tag tag-dark">No: XX <span class="tag-addon tag-success"> No bets found! </span></span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="tab-menu-heading bg-danger">
                            <div class="tabs-menu">
                                <ul class="nav panel-tabs">
                                    <li><a href="#sp_tab" class="active" data-bs-toggle="tab">Single Panna</a></li>
                                    <li><a href="#dp_tab" data-bs-toggle="tab">Double Panna</a></li>
                                    <li><a href="#tp_tab" data-bs-toggle="tab">Tripple Panna</a></li>
                                    <li><a href="#jodi_tab" data-bs-toggle="tab">Jodi</a></li>
                                    <li><a href="#cp_tab" data-bs-toggle="tab">CP</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="sp_tab">
                                    <p>
                                        <?
                                        if ($sp) {
                                            foreach ($sp as $key => $value) {
                                                echo '<span class="tag tag-dark">No: ' . $key . '<span class="tag-addon tag-success">' . $value . '</span></span>';
                                            }
                                        } else {
                                            echo '<span class="tag tag-dark">No: XX <span class="tag-addon tag-success"> No bets found! </span></span>';
                                        }
                                        ?>
                                    </p>

                                </div>
                                <div class="tab-pane" id="dp_tab">
                                    <p>
                                        <?
                                        if ($dp) {
                                            foreach ($dp as $key => $value) {
                                                echo '<span class="tag tag-dark">No: ' . $key . '<span class="tag-addon tag-success">' . $value . '</span></span>';
                                            }
                                        } else {
                                            echo '<span class="tag tag-dark">No: XX <span class="tag-addon tag-success"> No bets found! </span></span>';
                                        }
                                        ?>
                                    </p>

                                </div>
                                <div class="tab-pane" id="tp_tab">
                                    <p>
                                        <?
                                        if ($tp) {
                                            foreach ($tp as $key => $value) {
                                                echo '<span class="tag tag-dark">No: ' . $key . '<span class="tag-addon tag-success">' . $value . '</span></span>';
                                            }
                                        } else {
                                            echo '<span class="tag tag-dark">No: XX <span class="tag-addon tag-success"> No bets found! </span></span>';
                                        }
                                        ?>
                                    </p>

                                </div>
                                <div class="tab-pane" id="jodi_tab">
                                    <p>
                                        <?
                                        echo 'no data!';
                                        /* foreach ($sp as $key => $value) {
                                            echo '<span class="tag tag-dark">No: ' . $key . '<span class="tag-addon tag-success">' . $value . '</span></span>';
                                        } */
                                        ?>
                                    </p>

                                </div>
                                <div class="tab-pane" id="cp_tab">
                                    <p>
                                        <?
                                        if ($cp) {
                                            foreach ($cp as $key => $value) {
                                                echo '<span class="tag tag-dark">No: ' . $key . '<span class="tag-addon tag-success">' . $value . '</span></span>';
                                            }
                                        } else {
                                            echo '<span class="tag tag-dark">No: XX <span class="tag-addon tag-success"> No bets found! </span></span>';
                                        }
                                        ?>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-danger-gradient">
                                <h3 class="card-title text-white">Bet Lists</h3>
                                <div class="card-options">
                                    <span class="tag tag-rounded tag-icon tag-red"><i class="fe fe-clock"></i>Time
                                        <a href="javascript:void(0)"
                                            class="tag-addon tag-addon-cross tag-red"></a></span>
                                    <a href="javascript:void(0)"><i class="mdi mdi-refresh text-white"></i></a>
                                    <a href="javascript:void(0)" class="card-options-collapse"
                                        data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                    <a href="javascript:void(0)" class="card-options-remove"
                                        data-bs-toggle="card-remove"><i class="fe fe-x text-white"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table1" class="table table-bordered border text-nowrap mb-0"></table>
                                </div>
                            </div>
                            <div class="card-footer bg-gray-dark text-white">
                                This is Basic card footer
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- CONTAINER CLOSED -->

        </div>

        <!--app-content closed-->
    </div>

    <script>
    function func1() {
        localStorage.setItem('noliveshow', true);
        location.reload();
    }

    $(function() {
        $('#table1').DataTable({
            "search": {
                "search": "<?= $cgid; ?>"
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: 'https://control.fatafatguru.in/datafunction/get_tbl_data/',
                dataType: 'json',
                data: {
                    action: 'getuser',
                    table: 'tbl_bets'
                },
                type: 'POST',
            },
            columns: [{
                    title: "ID",
                    data: 'id',
                },
                {
                    title: "MATCH ID",
                    data: 'match_id',
                },
                {
                    title: "GAME ID",
                    data: 'game_id',
                },
                {
                    title: "BET TYPE",
                    data: 'bet_type',
                },
                {
                    title: "BET NO",
                    data: 'bet_val',
                },
                {
                    title: "AMOUNT",
                    data: 'bet_amnt',
                },
                {
                    title: "MOBILE",
                    data: 'mobile',
                },
                {
                    title: "DATE",
                    data: 'date',
                },
                {
                    title: "TIME",
                    data: 'time',
                }
            ],
            scrollY: 400
        });
    });
    </script>