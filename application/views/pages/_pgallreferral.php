<?
require_once(APPPATH . "views/widgets/functions.php");
?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">User Refferals</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-primary img-card box-primary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"><?= $totalUsers; ?></h2>
                                    <p class="text-white mb-0">Total Users</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-secondary img-card box-secondary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font"><?= $totalreferals; ?></h2>
                                    <p class="text-white mb-0">Total Refers</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-heart-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card  bg-success img-card box-success-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">Cal....</h2>
                                    <p class="text-white mb-0">Active</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-comment-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">Cal....</h2>
                                    <p class="text-white mb-0">InActive</p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-envelope-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All User Refferals</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <table id="userRefTable" class="table table-bordered border text-nowrap mb-0"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
$(function() {
    $('#userRefTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_referal'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            },
            {
                title: "USER ID",
                data: 'userid',
            },
            {
                title: "REFER ID",
                data: 'refer_id',
            }, {
                title: "REFER NO",
                data: 'refer_no',
            }, {
                title: "REFER AMNT",
                data: 'refer_amount',
            }, {
                title: "STAT",
                data: 'refer_status',
                "render": function(data) {
                    return (data == 0) ?
                        '<span class="badge bg-primary-gradient badge-sm  me-1 mb-1 mt-1"><span class="fe fe-user-check"></span></span>' :
                        '<span class="badge bg-danger-gradient badge-sm  me-1 mb-1 mt-1"><span class="fe fe-user-x"></span></span>';
                }
            },
        ],
        scrollY: 400
    });
});
</script>