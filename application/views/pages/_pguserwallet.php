<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Wallet Details</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-success br-te-3 br-ts-3">
                            <h3 class="card-title  text-white">All User Wallet Table</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-fullscreen"
                                    data-bs-toggle="card-fullscreen"><i class="fe fe-maximize text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove text-white"
                                    data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="walletTbl" class="table table-bordered border text-nowrap mb-0"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
    <!-- MODAL EFFECTS -->
    <div class="modal fade" id="updateWalletMdl">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Update Wallet</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="wlt_update_form" method="post" action="#">
                        <ul class="list-group no-margin">
                            <li class="list-group-item d-flex ps-3">
                                <div class="social social-profile-buttons me-2">
                                    <a class="social-icon text-primary" href="javascript:void(0)"><i
                                            class="fe fe-user"></i></a>
                                </div>
                                <input class="form-control mb-4" placeholder="User Mobile" readonly="" type="text"
                                    id="mobile_txt" name="mobile">
                            </li>
                            <li class="list-group-item d-flex ps-3">
                                <div class="social social-profile-buttons me-2">
                                    <a class="social-icon text-primary" href="javascript:void(0)"><i
                                            class="fe fe-edit"></i></a>
                                </div>
                                <input class="form-control mb-4" placeholder="0.00" type="text" id="amount_txt"
                                    name="amount">
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="pull-left text-align-left">SET DEBIT / CREDIT</h6>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="custom-switch form-switch mb-0">
                                            <input type="checkbox" id="money_switch" class="custom-switch-input">
                                            <span class="custom-switch-indicator custom-switch-indicator-md"></span>
                                            <span class="custom-switch-description">
                                                <div class="tag tag-danger">
                                                    DEBIT
                                                    <span class="tag-addon"><i class="fe fe-arrow-down"></i></span>
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <input type="hidden" value="debit" id="trtype_txt" name="trtype" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="update_wlt_btn">Update Wallet</button> <button
                        class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--app-content closed-->
</div>

<script>
function callback(params) {
    $('#updateWalletMdl').modal('hide');
    alert(params.message);
    // $('.dataTxt').html(params.message);
    // $('.toast').toast('show');
    location.reload();
}

$(function() {
    $("#update_wlt_btn").on("click", function(event) {
        event.preventDefault();
        var amount = $("#pass_update_form").val();
        var form = $("#wlt_update_form");
        var data = form.serialize() + '&action=' + 'add_amount_update';
        sendData(data, "https://control.fatafatguru.in/admin/", callback);
    });

    $('#money_switch').change(function() {
        if ($(this).is(":checked")) {
            $('.custom-switch-description').html(
                '<div class="tag tag-danger">CREDIT<span class="tag-addon"><i class="fe fe-arrow-up"></i></span></div>'
            );
            $("#trtype_txt").val('credit');
        } else {
            $('.custom-switch-description').html(
                '<div class="tag tag-success">DEBIT<span class="tag-addon"><i class="fe fe-arrow-down"></i></span></div>'
            );
            $("#trtype_txt").val('debit');
        }
    });

    $('#walletTbl').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'https://control.fatafatguru.in/datafunction/get_wallet_combo/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table1: 'tbl_users',
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            }, {
                title: "MOBILE",
                data: 'mobile',
            }, {
                title: "FULLNAME",
                data: 'fullname',
            }
            /* , {
                            title: "STATUS",
                            data: 'status',
                        } */
            , {
                title: "BAL",
                data: null,
                render: function(data, type, row, meta) {
                    return row.credit - row.debit;
                },
            }, {
                title: "CREDIT",
                data: 'credit',
            }, {
                title: "DEBIT",
                data: 'debit',
            },
            {
                title: "Update",
                className: "dt-center editor-update",
                defaultContent: '<button type="button" class="btn btn-sm btn-primary"><span class="fe fe-umbrella"></span></button>',
                orderable: false
            }, {
                title: "View",
                className: "dt-center editor-view",
                defaultContent: '<button type="button" class="btn btn-sm btn-warning"><span class="fe fe-github"></span></button>',
                orderable: false
            }
        ],
        scrollY: 400
    });

    $('#walletTbl').on('click', 'td.editor-update', function() {
        var table = $('#walletTbl').DataTable();
        var data = table.row(this).data();
        $('#mobile_txt').val(data.mobile);
        $('#updateWalletMdl').modal('show');
    });

});
</script>