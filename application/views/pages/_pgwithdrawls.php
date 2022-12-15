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
                <h1 class="page-title">Withdraw Master</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Game Lists</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-danger-gradient">
                            <h3 class="card-title text-white"> Withdrawl List </h3>
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
                <div></div>
            </div>
            <!-- CONTAINER CLOSED -->
        </div>
    </div>
    <!--app-content closed-->
</div>

<script>
$(function() {

    $('#table3').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_withdrawl_req'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            }, {
                title: "DATE",
                data: 'date',
            }, {
                title: "TIME",
                data: 'time',
            },
            {
                title: "MOBIEL NO",
                data: 'mobile',
            },
            {
                title: "AMOUNT",
                data: 'amount',
            }, {
                title: "UPI",
                data: 'upi_id',
            }, {
                title: "TR NO",
                data: 'tr_no',
            }, {
                title: "STATUS",
                data: 'status',
                orderable: false,
                searchable: false,
                /*  width: "42px", */
                render: function(data, type, row, meta) {
                    if (data != 0) {
                        return '<span class="tag tag-lime">Paid</span>';
                    } else {
                        return '<span class="tag tag-dark-gray">Pending</span>';
                    }
                },
                createdCell: function(td, cellData, rowData, row, col) {
                    // Some code that assigns click events to the rendered buttons/icons, sometimes based on the data of the row
                }
            },
            {
                title: "Edit",
                className: "dt-center editor-edit",
                defaultContent: '<button type="button" class="btn  btn-sm btn-primary"><span class="fe fe-navigation"></span></button>',
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

    $('#table3').on('click', 'td.editor-edit', function() {
        var table = $('#table3').DataTable();
        var data = table.row(this).data();
        $('#mobile_txt').val(data.mobile);
        $('#tr_no_txt').val(data.tr_no);
        $('#amount_txt').val(data.amount);
        $('#update_withdrawls').modal('show');
    });

    $("#updt-amnt-btn").on("click", function(e) {
        e.preventDefault();
        var method = $("input[type='radio']:checked").val();
        if (method == '') {
            $('.dataTxt').html('Select Payment Mode');
            $('.toast').toast('show');
        } else {
            var form = $("#wthdrwl_update_form");
            var data = form.serialize() + '&action=' + 'withdrawl_update';
            sendData(data, "https://control.fatafatguru.in/admin/", callback);
        }
    });

});

function callback(params) {
    $('#wthdrwl_update_form').modal('hide');
    $('.dataTxt').html(params.message);
    $('.toast').toast('show');
    location.reload();
}
</script>


<div class="modal fade" id="update_withdrawls" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UserPayment</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="wthdrwl_update_form">
                    <input type="hidden" id="tr_no_txt" name="tr_no" value="" />
                    <div class="form-group">
                        <label class="form-label mt-0">Mobile</label>
                        <input class="form-control form-control-sm" placeholder="" type="text" id="mobile_txt"
                            name="mobile" required readonly>
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-0">Amount</label>
                        <input class="form-control form-control-sm" placeholder="" type="text" id="amount_txt"
                            name="amount" required>
                    </div>
                    <div class="form-group p-2">
                        <div class="form-label">Radios</div>
                        <div class="custom-controls-stacked row">
                            <label class="custom-control custom-radio col-6">
                                <input type="radio" class="custom-control-input" name="method" id="method"
                                    value="paytm">
                                <span class="custom-control-label">Paytm</span>
                            </label>
                            <label class="custom-control custom-radio col-6">
                                <input type="radio" class="custom-control-input" name="method" id="method"
                                    value="phonepe">
                                <span class="custom-control-label">Phonpe</span>
                            </label>
                            <label class="custom-control custom-radio col-6">
                                <input type="radio" class="custom-control-input" name="method" id="method" value="gpay">
                                <span class="custom-control-label">G Pay</span>
                            </label>
                            <label class="custom-control custom-radio col-6">
                                <input type="radio" class="custom-control-input" name="method" id="method"
                                    value="others" checked>
                                <span class="custom-control-label">Others</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label mt-0">Remarks</label>
                        <input class="form-control form-control-sm" type="text" id="remarks" name="remarks">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" id="updt-amnt-btn">Update</button>
            </div>
        </div>
    </div>
</div>