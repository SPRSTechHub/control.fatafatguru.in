<?
require_once(APPPATH . "views/widgets/functions.php");
?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">User Master</h1>
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
                            <h3 class="card-title">All User Lists</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <table id="userTable" class="table table-bordered border text-nowrap mb-0"></table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All User Password</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove" data-bs-toggle="card-remove"><i
                                        class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <table id="passwordTable" class="table table-bordered border text-nowrap mb-0"></table>
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
    $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_users'
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
                title: "FULLNAME",
                data: 'fullname',
            }, {
                title: "MOBILE",
                data: 'mobile',
            }, {
                title: "REFERID",
                data: 'refer_id',
            }, {
                title: "STAT",
                data: 'status',
                "render": function(data) {
                    return (data == 0) ?
                        '<span class="badge bg-primary-gradient badge-sm  me-1 mb-1 mt-1"><span class="fe fe-user-check"></span></span>' :
                        '<span class="badge bg-danger-gradient badge-sm  me-1 mb-1 mt-1"><span class="fe fe-user-x"></span></span>';
                }
            },
            {
                title: "VIEW",
                className: "dt-center editor-edit-user",
                defaultContent: '<button type="button" class="btn btn-sm btn-primary"><span class="fe fe-zoom-in"></span></button>',
                orderable: false
            },
            {
                title: "ACTN",
                className: "dt-center editor-delete",
                defaultContent: '<button type="button" class="btn btn-sm btn-danger"><span class="fe fe-settings"></span></button>',
                orderable: false
            }
        ],
        scrollY: 400
    });
    $('#passwordTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_login'
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
                title: "PASSWORD",
                data: 'password',
            },
            {
                title: "Edit",
                className: "dt-center editor-edit-pass",
                defaultContent: '<button type="button" class="btn btn-sm btn-primary editor-edit"><span class="fe fe-edit"></span></button>',
                orderable: false
            }
        ],
        scrollY: 400
    });

    $('#passwordTable').on('click', 'td.editor-edit-pass', function() {
        var table = $('#passwordTable').DataTable();
        var data = table.row(this).data();
        $('#cp_id_txt').val(data.mobile);
        $('#update_pass_box').modal('show');
    });

    $('#userTable').on('click', 'td.editor-edit-user', function() {
        $('#update_user_box').modal('show');
    });

    $("#updt-pass-btn").on("click", function(event) {
        event.preventDefault();
        var form = $("#pass_update_form");
        var data = form.serialize() + '&action=' + 'add_user_pass';
        sendData(data, "https://control.fatafatguru.in/admin/", callback);
    });

});

function callback(params) {
    $('#update_pass_box').modal('hide');
    $('.dataTxt').html(params.message);
    $('.toast').toast('show');
    location.reload();
}
</script>

<div class="modal fade" id="update_pass_box" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Password Updator</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pass_update_form" method="post" action="#">
                    <input type="hidden" id="cp_id_txt" name="mobile" />
                    <div class="mb-3">
                        <label for="new_pass" class="col-form-label">New Password:</label>
                        <input type="text" class="form-control" id="new_pass" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" id="updt-pass-btn">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="update_user_box" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Updator</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Not Now</h5>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" id="updt-pass-btn">Update</button>
            </div>
        </div>
    </div>
</div>