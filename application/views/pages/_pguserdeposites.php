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
                <h1 class="page-title">Deposite Master</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Deposite Lists</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-danger-gradient">
                            <h3 class="card-title text-white"> Deposite List </h3>
                            <div class="card-options">
                                <a href="javascript:void(0)"><i class="mdi mdi-refresh text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-collapse"
                                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                                <a href="javascript:void(0)" class="card-options-remove" data-bs-toggle="card-remove"><i
                                        class="fe fe-x text-white"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="depositeTbl" class="table table-bordered border text-nowrap mb-0"></table>
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

    $('#depositeTbl').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_deposit'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            }, {
                title: "DATE",
                data: 'date',
            },
            {
                title: "MOBIEL NO",
                data: 'mobile',
            },
            {
                title: "AMOUNT",
                data: 'amount',
            }, {
                title: "TR TYPE",
                data: 'trtype',
            }, {
                title: "TR NO",
                data: 'trno',
            }, {
                title: "STATUS",
                data: 'status',
                orderable: false,
                searchable: false,
                /*  width: "42px", */
                render: function(data, type, row, meta) {
                    if (data == '1') {
                        return '<span class="tag tag-lime">Unpaid</span>';
                    } else {
                        return '<span class="tag tag-dark-gray">Paid</span>';
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

    $('#depositeTbl').on('click', 'td.editor-edit', function() {
        var table = $('#depositeTbl').DataTable();
        var data = table.row(this).data();
        $('#mobile_txt').val(data.mobile);
        $('#tr_no_txt').val(data.trno);
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
            var data = form.serialize() + '&action=' + 'deposite_update';
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
                <h5 class="modal-title">Deposite Update</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="wthdrwl_update_form">
                    <input type="hidden" id="tr_no_txt" name="trno" value="" />
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