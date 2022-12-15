<!--app-content open-->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Offer Wall</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Offer Lists</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-3">
                    <div class="card">
                        <div class="card-body text-danger bg-warning-transparent card-transparent">
                            <a href="javascript:void(0)" class="btn btn-primary" onclick="add();">Add</a>
                        </div>
                        <div class="card-body text-danger bg-warning-transparent card-transparent">
                            <span id="selections"></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-9">
                    <div class="card">
                        <div class="card-header bg-danger-gradient">
                            <h3 class="card-title text-white">Offer List Master</h3>
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
                        <div class="card-body text-danger bg-danger-transparent card-transparent">
                            <div class="table-responsive">
                                <table id="table1" class="table table-bordered border text-nowrap mb-0">
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-gray-dark text-white">
                            Offer Card Panel
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTAINER CLOSED -->
            <div class="position-fixed end-0 p-3" style="z-index: 9999; top:60px;">
                <div id="liveToast" class="toast hide text-white bg-danger border-0 toast-danger" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-dark text-white">
                        <img src="https://sprsinfotech.com/assets/images/favicon.png" class="rounded me-2" alt="icon"
                            height="24" width="24">
                        <strong class="me-auto">Alert</strong>
                        <small>Just Now</small>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                    </div>
                    <div class="toast-body">
                        Wellcome here ...
                    </div>
                </div>
            </div>
            <div class="position-fixed end-0 p-3" style="z-index: 9999; top:60px;">
                <div id="liveToast1" class="toast hide text-white bg-primary border-0 toast-success" role="alert"
                    aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-dark text-white">
                        <img src="https://sprsinfotech.com/assets/images/favicon.png" class="rounded me-2" alt="icon"
                            height="24" width="24">
                        <strong class="me-auto">Alert</strong>
                        <small>Just Now</small>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                    </div>
                    <div class="toast-body">
                        Wellcome here ...
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--app-content closed-->

    <!-- PageModal -->
    <div class="modal fade" id="ofr_mdl" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content card">
                <div class="modal-header">
                    <h5 class="modal-title">Offer Panel</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form name="ofr_frm" id="ofr_frm" action="#" method="post">
                    <div class="modal-body card-body">
                        <div class="mb-3">
                            <img id="imgPreview"
                                src="https://codeigniter.spruko.com/sash/sash/assets/images/media/24.jpg" alt="img"
                                class="br-5">
                        </div>
                        <div class="mb-3">
                            <input class="form-control form-control-sm" type="file" id="file" name="file"
                                accept="image/png, image/jpeg" placeholder="Select offer image">
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <input type="hidden" value="1" name="status" id="status_chk_inp" />
                            <div>
                                Set Offer Status </div>
                            <div class="material-switch pull-right">
                                <input id="status_chk" type="checkbox" checked value="1">
                                <label for="status_chk" class="label-success"></label>
                            </div>
                        </div>
                        <div class="form-group d-flex justify-content-between">
                            <div> *Special User </div>
                            <div class="material-switch pull-right">
                                <input type="text" value="" name="user" id="user"
                                    class="form-control form-control-sm" />
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary updatefile_btn" style="display:none;">Update</button>
                    <button class="btn btn-primary add_btn">Add</button>
                </div>

            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
var path = "https://" + window.location.hostname;
const fileInput = document.getElementById("file");
fileInput.addEventListener("change", function(e) {
    e.preventDefault();
    var file = fileInput.files[0];
    if (file != null) {
        (async () => {
            var resp = await fileInfo(fileInput);
            console.log(resp.size / 1024);
            if (resp.status == 1) {
                xsize = resp.size / 1024;
                if (xsize > 4096 || xsize < 2) {
                    $('.toast-danger').toast('show');
                    $('.toast-body').html('Image size should be 512KB to 4MB');
                    fileInput.value = '';
                    return;
                }
                if (resp.height < 200 || resp.width > 800) {
                    $('.toast-danger').toast('show');
                    $('.toast-body').html('Image Dimension should be appx 220 x 350');
                    fileInput.value = '';
                    return;
                }
                //post2server();
            } else {
                $('.toast-danger').toast('show');
                $('.toast-body').html(resp.msg);
            }
            //callbackAlert(resp);
        })()
    }
});

function sendFile1(formid, sUrl) {
    const url = sUrl;
    const formElement = document.querySelector("#" + formid);
    const formData = new FormData(formElement);
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText["status"] == 0) {
                console.log(this.responseText["msg"]);
            } else {
                console.log(this.responseText["msg"]);
            }
            location.reload();
        } else {
            console.log("Server Error!");
        }
    };
    xhttp.open("POST", url, true);
    xhttp.send(formData);
}

$(function() {
    $('#updatefile_btn').css('display', 'block');
    $('#table1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_offer'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            },
            {
                title: "IMAGE",
                data: "offer_url",
                className: "dt-center editor-adimg",
                render: function(data) {
                    if (data != null) {
                        return (
                            '<img src="' +
                            "https://control.fatafatguru.in/uploads/offers/" +
                            data +
                            '" width="40px">'
                        );
                    } else {
                        return '<button id="adimg" type="button" class="btn btn-sm btn-info"><span class="fe fe-upload"></span></button>';
                    }
                },
            }, {
                title: "MOBILE",
                data: 'mobile',
            },
            {
                title: "STAT",
                data: "status",
            },
            {
                title: "DEL",
                className: "dt-center editor-delete",
                defaultContent: '<button type="button" class="btn btn-sm btn-danger" data-tbl="tbl_offer" data-tblid="table1"><span class="fe fe-trash-2"></span></button>',
                orderable: false,
            },

        ],
        scrollY: 400
    });

    $("#file").change(function() {
        const file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $("#imgPreview")
                    .attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });

    $("#table1").on(
        "click",
        "td.editor-delete",
        function() {
            var tbl = $(this).find("button").data("tbl");
            var tblid = $(this).find("button").data("tblid");
            var table = $("#" + tblid).DataTable();
            var data = table.row(this).data();
            const formData = new FormData();
            formData.append("action", "delOffer");
            formData.append("id", data.id);
            formData.append("tbl", tbl);
            sendData(formData, path + "/admin/", callback);
        }
    );

    $('.updatefile_btn').on('click', function(e) {
        e.preventDefault();
        $('#status_chk').change(function() {
            if ($(this).is(":checked")) {
                $('#status_chk_inp').val(1);
            } else {
                $('#status_chk_inp').val(0);
            }
        });
        if ($('#file').val() == '') {
            $('.toast').toast('show');
            $('.toast-body').html('No Image detected!');
            return;
        }
        sendFile('ofr_frm', '../submitOffer/', callback);
    });

    $('.add_btn').on('click', function(e) {
        e.preventDefault();
        $('#status_chk').change(function() {
            if ($(this).is(":checked")) {
                $('#status_chk_inp').val(1);
            } else {
                $('#status_chk_inp').val(0);
            }
        });
        if ($('#file').val() == '') {
            $('.toast').toast('show');
            $('.toast-body').html('No Image detected!');
            return;
        }
        sendFile('ofr_frm', '../submitOffer/', callback);
    });

});

function callback(param) {
    $('.toast').toast('show');
    $('.toast-body').html('Success!');
    location.reload();
}

function formatImg(val, row) {
    if (val) {
        return '<img src="https://control.fatafatguru.in/uploads/offers/' + val +
            '" alt="img" class="br-5" style="height:120px; width:350px;">';
    } else {
        return val;
    }
}

function add() {
    $('#updatefile_btn').css('display', 'none');
    $('#add_btn').css('display', 'block');
    $('#ofr_mdl').modal('show');
}
</script>