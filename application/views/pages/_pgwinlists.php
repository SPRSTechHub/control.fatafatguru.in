<? require_once(APPPATH . "views/widgets/functions.php");
$tgp = !empty($tgp) ? $tgp->num_rows() : 0;
$tdgc = !empty($tdg) ? $tdg->num_rows() : 0;
$tgf = round($tdgc - $tgp);
?>

<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Winner Board</h1>
                <?
                echo date('H:i');
                ?>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Game Winner</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-md-12">
                    SSPD
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header bg-danger-gradient">
                            <h3 class="card-title text-white">Game List Master </h3>

                            <div class="card-options">
                                <button class="btn btn-sm btn-pill btn-primary off-canvas" type="button"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
                                    aria-controls="offcanvasBottom">+ Add Result</button>

                                <a href="javascript:void(0)"><i class="mdi mdi-refresh text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove" data-bs-toggle="card-remove"><i
                                        class="fe fe-x text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-body card-transparent">
                            <div class="table-responsive">
                                <table id="tableWinning" class="table table-bordered border text-nowrap mb-0"></table>
                            </div>
                        </div>
                        <div class="card-footer bg-gray-dark text-white">
                            This is Basic card footer
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
</div>

<? $this->load->view('widgets/results_add'); ?>
<script>
function callResultMdl() {
    $('#ress_modal').modal('show');
}
</script>

<script>
$(function() {
    $('#tableWinning').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_winnings'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            },
            {
                title: "MOBILE",
                data: 'mobile',
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
                title: "WIN NO",
                data: 'win_val',
            },
            {
                title: "WIN AMOUNT",
                data: 'win_amnt',
            },
            {
                title: "WIN TYPE",
                data: 'win_type',
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