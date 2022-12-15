<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Actual Bets Placement:</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lie Game</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <?
            $cgid = $this->input->get('gid');
            $cgid = !empty($cgid) ? $cgid : 'FFLV15';

            $curr_bets = $this->home->findBets(array('match_id' => $cgid), 'tbl_bets');
            $sd = array();
            $sp = array();
            $dp = array();
            $tp = array();
            $cp = array();
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
                <div class="col-md-6">
                    <div class=" expanel expanel-primary">
                        <div class="expanel-heading">
                            <h3 class="expanel-title">Single Digits</h3>
                        </div>
                        <div class="expanel-body py-2">
                            <div class="d-flex justify-content-between">
                                <?
                                if ($sd) {
                                    foreach ($sd as $key => $value) {
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
                <div class="col-md-6">
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
                                    <span class="tag tag-rounded tag-icon tag-red"><i class="fe fe-clock"></i>Time <a
                                            href="javascript:void(0)"
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