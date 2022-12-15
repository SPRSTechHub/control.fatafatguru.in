<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Game Master</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Game Lists</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <? $this->load->view('widgets/top_gl'); ?>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header bg-primary br-te-3 br-ts-3">
                            <h3 class="card-title text-white">Game List Set</h3>
                            <div class="card-options ">
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove" data-bs-toggle="card-remove"><i
                                        class="fe fe-x text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-body px-0 text-center">
                            <div class="px-0 mx-0">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-dark" id="add_gm_set_box"><i
                                            class="fe fe-upload me-2"></i>Match</button>
                                    <button type="button" class="btn btn-warning" id="add_gm_cat_box"><i
                                            class="fe fe-plus me-2"></i>Catagory</button>
                                    <button type="button" class="btn btn-success" id="add_mkt_rt_box"><i
                                            class="fe fe-plus me-2"></i>Ratio</button>
                                    <button type="button" class="btn btn-primary" id="add_gm_item_box"><i
                                            class="fe fe-plus me-2"></i>Game</button>
                                    <button type="button" class="btn btn-danger" id="add_gm_dgt_box"><i
                                            class="fe fe-plus me-2"></i>Digits</button>
                                    <button type="button" class="btn btn-default"><i
                                            class="fe fe-plus me-2"></i>OTHERS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-header">
                            <h4 class="card-title fw-semibold">Games Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="browser-stats">
                                <div class="row mb-4">
                                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                        <span class="text-primary"><i
                                                class="fe fe-file-text mx-2 fs-20 text-primary-shadow"></i></span>
                                    </div>
                                    <?
                                    $gc = $this->home->counter(array(), 'tbl_game_catagory');
                                    $pgc = (10 - $gc * 10) . '%';
                                    ?>
                                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                        <div class="d-flex align-items-end justify-content-between mb-1">
                                            <h6 class="mb-1">Total Game Catagories</h6>
                                            <h6 class="fw-semibold mb-1"><?= $gc; ?>/10<span
                                                    class="text-success fs-11">(<i class="fe fe-arrow-up"></i>10)</span>
                                            </h6>
                                        </div>
                                        <div class="progress h-2 mb-3">
                                            <div class="progress-bar bg-primary" style="width: <?= $pgc; ?>;"
                                                role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                        <span class="text-primary"><i
                                                class="fe fe-file-text mx-2 fs-20 text-primary-shadow"></i></span>
                                    </div>
                                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                        <?
                                        $gm = $this->home->counter(array(), 'tbl_gamelist');
                                        $pgm = $gm . '%';
                                        ?>
                                        <div class="d-flex align-items-end justify-content-between mb-1">
                                            <h6 class="mb-1">Total Matches</h6>
                                            <h6 class="fw-semibold mb-1"><?= $gm; ?><span class="text-danger fs-11">(<i
                                                        class="fe fe-arrow-down"></i>100)</span></h6>
                                        </div>
                                        <div class="progress h-2 mb-3">
                                            <div class="progress-bar bg-secondary" style="width: <?= $pgm; ?>%;"
                                                role="progressbar"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-2 col-lg-3 col-xl-3 col-xxl-2 mb-sm-0 mb-3">
                                        <span class="text-primary"><i
                                                class="fe fe-file-text mx-2 fs-20 text-primary-shadow"></i></span>
                                    </div>
                                    <div class="col-sm-10 col-lg-9 col-xl-9 col-xxl-10 ps-sm-0">
                                        <?
                                        $gic = $this->home->counter(array(), 'tbl_game_items');
                                        $pgic = $gic . '%';
                                        ?>
                                        <div class="d-flex align-items-end justify-content-between mb-1">
                                            <h6 class="mb-1">Total Game Items</h6>
                                            <h6 class="fw-semibold mb-1"><?= $gic; ?> <span
                                                    class="text-success fs-11">(<i
                                                        class="fe fe-arrow-down"></i>100%)</span></h6>
                                        </div>
                                        <div class="progress h-2 mb-3">
                                            <div class="progress-bar bg-success" style="width: <?= $pgic; ?>%;"
                                                role="progressbar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <ul class="nav panel-tabs">
                                            <li><a href="#tab5" class="active" data-bs-toggle="tab">ALL MATCHES</a></li>
                                            <li><a href="#tab6" data-bs-toggle="tab">GAME CATAGORIES</a></li>
                                            <li><a href="#tab7" data-bs-toggle="tab">GAME NAMELIST</a></li>
                                            <li><a href="#tab8" data-bs-toggle="tab">MARKET RATIO</a></li>
                                            <li><a href="#tab9" data-bs-toggle="tab">DIGITS MASTER</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="mt-2 tabs-menu-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab5">
                                            <div class="table-responsive">
                                                <table id="table2" class="table table-bordered border text-nowrap mb-0">
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <div class="table-responsive">
                                                <table id="table3" class="table table-bordered border text-nowrap mb-0">
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab7">
                                            <div class="table-responsive">
                                                <table id="table4" class="table table-bordered border text-nowrap mb-0">
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab8">
                                            <div class="table-responsive">
                                                <table id="table5" class="table table-bordered border text-nowrap mb-0">
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab9">
                                            <div class="table-responsive">
                                                <table id="table6" class="table table-bordered border text-nowrap mb-0">
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Match Modal -->
<? $this->load->view('widgets/game_add');
?>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/gamelists.js"></script>