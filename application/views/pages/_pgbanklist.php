<?
//require_once(APPPATH . "views/widgets/functions.php");
?>
<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">BANK & UPI</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bank & UPI Lists</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">BANK & UPI SETTINGS</h3>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <ul class="list-group">
                                    <li class="list-group-item justify-content-between">
                                        TOTAL UPI USERS
                                        <span class="badgetext badge bg-primary rounded-pill">20</span>
                                    </li>
                                    <li class="list-group-item justify-content-between">
                                        TOTAL BANK USERS
                                        <span class="badgetext badge bg-danger rounded-pill">15</span>
                                    </li>
                                    <li class="list-group-item justify-content-between">
                                        REGULAR WITHDRAWSL USER
                                        <span class="badgetext badge bg-success rounded-pill">10</span>
                                    </li>
                                    <li class="list-group-item justify-content-between">
                                        Access Change UPI
                                        <span class="badgetext badge bg-warning rounded-pill">8</span>
                                    </li>
                                    <li class="list-group-item justify-content-between">
                                        Access Change of BANK
                                        <span class="badgetext badge bg-info rounded-pill">1</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-danger-gradient">
                            <h3 class="card-title text-white">UPI Lists</h3>
                            <div class="card-options">
                                <span class="tag tag-rounded tag-icon tag-red"><i class="fe fe-clock"></i>Time <a
                                        href="javascript:void(0)" class="tag-addon tag-addon-cross tag-red"></a></span>
                                <a href="javascript:void(0)"><i class="mdi mdi-refresh text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove" data-bs-toggle="card-remove"><i
                                        class="fe fe-x text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table2" class="table table-bordered border text-nowrap mb-0"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-2">

                </div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header bg-danger-gradient">
                            <h3 class="card-title text-white">BANK Lists</h3>
                            <div class="card-options">
                                <span class="tag tag-rounded tag-icon tag-red"><i class="fe fe-clock"></i>Time <a
                                        href="javascript:void(0)" class="tag-addon tag-addon-cross tag-red"></a></span>
                                <a href="javascript:void(0)"><i class="mdi mdi-refresh text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove" data-bs-toggle="card-remove"><i
                                        class="fe fe-x text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table3" class="table table-bordered border text-nowrap mb-0"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
</div>

<script>
$(function() {
    $('#table2').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_upi'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            },
            {
                title: "MOBIEL NO",
                data: 'mobile',
            },
            {
                title: "UPI ID",
                data: 'bank_upi',
            }, {
                title: "STATUS",
                data: 'status',
                orderable: false,
                searchable: false,
                /*  width: "42px", */
                render: function(data, type, row, meta) {
                    if (data == 1) {
                        return '<span class="tag tag-lime">Active</span>';
                    } else {
                        return '<span class="tag tag-dark-gray">In Active</span>';
                    }
                },
                createdCell: function(td, cellData, rowData, row, col) {
                    // Some code that assigns click events to the rendered buttons/icons, sometimes based on the data of the row
                }
            },
            {
                title: "Edit",
                className: "dt-center editor-edit",
                defaultContent: '<button type="button" class="btn  btn-sm btn-primary"><span class="fe fe-edit"></span></button>',
                orderable: false
            },
            {
                title: "Delete",
                className: "dt-center editor-delete",
                defaultContent: '<button type="button" class="btn  btn-sm btn-danger"><span class="fe fe-trash-2"></span></button>',
                orderable: false
            }
        ],
        scrollY: 400
    });
    $('#table3').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_bank'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            },
            {
                title: "MOBIEL NO",
                data: 'mobile',
            },
            {
                title: "BANK NAME",
                data: 'bank_name',
            }, {
                title: "ACC NO",
                data: 'bank_acc',
            }, {
                title: "IFSC NO",
                data: 'bank_ifsc',
            }, {
                title: "STATUS",
                data: 'status',
            },
            {
                title: "Edit",
                className: "dt-center editor-edit",
                defaultContent: '<button type="button" class="btn  btn-sm btn-primary"><span class="fe fe-edit"></span></button>',
                orderable: false
            },
            {
                title: "Delete",
                className: "dt-center editor-delete",
                defaultContent: '<button type="button" class="btn  btn-sm btn-danger"><span class="fe fe-trash-2"></span></button>',
                orderable: false
            }
        ],
        scrollY: 400
    });
});
</script>