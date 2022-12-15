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
                <h1 class="page-title">PAYMENT MANAGEMENT</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Payment Managements</li>
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
                                        <form>
                                            <div class="d-flex justify-content-between">
                                                <span> ONLINE PAYMENT </span>
                                                <label class="custom-switch ps-0">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input" checked="">
                                                    <span class="custom-switch-indicator me-3"></span>
                                                </label>
                                            </div>
                                        </form>
                                    </li>
                                    <li class="list-group-item justify-content-between">
                                        <form>
                                            <div class="d-flex justify-content-between">
                                                <span> OFFLINE PAYMENT </span>
                                                <label class="custom-switch ps-0">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input" checked="">
                                                    <span class="custom-switch-indicator me-3"></span>
                                                </label>
                                            </div>
                                        </form>
                                    </li>
                                    <li class="list-group-item justify-content-between">
                                        <?
                                        $getoff_qr = $this->home->find(array('status' => 1), 'tbl_pay_qr');
                                        if ($getoff_qr) {
                                        ?>
                                        <div class="media overflow-visible">
                                            <h6>OL QR</h6>
                                            <a href="javascript:void(0)" class="thumbnail">
                                                <img src="<?= base_url() . 'uploads/payqr/' . $getoff_qr->row()->offer_url; ?>"
                                                    alt="thumb1"
                                                    data-src="<?= base_url() . 'uploads/payqr/' . $getoff_qr->row()->offer_url; ?>"
                                                    class="thumbimg" style="height:100 ;width: 120px;" id="img_qr">
                                            </a>
                                            <div class="media-body valign-middle text-end overflow-visible mt-2">
                                                <button class="btn btn-sm btn-primary" type="button"
                                                    onclick="offqrbox();">Update New</button>
                                            </div>
                                        </div>
                                        <?
                                        } else {
                                            echo 'No Qr Set!';
                                        }
                                        ?>

                                        <!-- <form>
                                            <div class="d-flex justify-content-between">
                                                <span> OFFLINE PAYMENT </span>
                                                <label class="custom-switch ps-0">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        class="custom-switch-input" checked="">
                                                    <span class="custom-switch-indicator me-3"></span>
                                                </label>
                                            </div>
                                        </form> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">PAYMENT GATEWAY SETTINGS</h3>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <ul class="list-group">
                                    <? $tbl_col = $this->db->list_fields('client_api_secret');

                                    $listsort = array('id', 'timesamp', 'client_site_url', 'client_cb_url', 'api_details');
                                    foreach ($listsort as $keyv) {
                                        if (($key = array_search($keyv, $tbl_col)) !== false) {
                                            unset($tbl_col[$key]);
                                        }
                                    }
                                    foreach ($tbl_col as $key) {
                                        if ($key == 'api_type') {
                                    ?>
                                    <li class="list-group-item justify-content-between">
                                        <form>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select name="country" class="form-control form-select select2"
                                                        data-bs-placeholder="Api Type">
                                                        <? $cbd = $this->home->getValue($key, 'client_api_secret');
                                                                echo !empty($cbd) ? '<option value="' . $cbd . '" selected>' . strtoupper($key) . '</option>' : ' <option value="" selected>Select Api Type</option>';
                                                                ?>
                                                    </select>
                                                    <button class="btn btn-light" type="button"
                                                        id="sbmt_btn_cb">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                    <? } else { ?>
                                    <li class="list-group-item justify-content-between">
                                        <form name="<?= $key . '_frm'; ?>" id="<?= $key . '_frm'; ?>"
                                            class="form_update">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="<?= $key; ?>"
                                                        placeholder="<?= strtoupper($key); ?>" aria-label="Client Id"
                                                        aria-describedby="button-addon1"
                                                        value="<?= $this->home->getValue($key, 'client_api_secret'); ?>">
                                                    <button class="btn btn-light sbmt_btn" type="button"
                                                        id="<?= $key . '_btn'; ?>">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                    <? }
                                    }
                                    ?>
                                </ul>
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

<!-- ssssssssss  -->
<div class="modal fade" id="oflq_mdl" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <h5 class="modal-title">PAYMENT QR BOX</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form name="pay_qr_frm" id="pay_qr_frm" action="#" method="post">
                <div class="modal-body card-body">
                    <div class="mb-3">
                        <img id="imgPreview" src="https://codeigniter.spruko.com/sash/sash/assets/images/media/24.jpg"
                            alt="img" class="br-5">
                    </div>
                    <div class="mb-3">
                        <input class="form-control form-control-sm" type="file" id="file" name="file"
                            accept="image/png, image/jpeg" placeholder="Select QR image">
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="updateQR_btn">Update</button>
            </div>

        </div>
    </div>
</div>

<script>
$(function() {
    $('.sbmt_btn').click(function() {
        var id = $(this).attr('id');
        var formid = id.slice(0, -3) + 'frm';
        const form = document.getElementById(formid);
        const formData = new FormData(form);
        formData.append('action', 'pymntgear');
        sendData(formData, '<?= base_url(); ?>admin/', callback);
    });
});

function callback(params) {
    console.log(params);
    $('.toast').toast('show');
    $('.toast-body').html(params);
    //location.reload();
}

function offqrbox() {
    $('#imgPreview').attr("src", $('#img_qr').attr('data-src'));
    $('#oflq_mdl').modal('show');
}

$('#updateQR_btn').on('click', function(e) {
    e.preventDefault();
    console.log('sss');
    if ($('#file').val() == '') {
        $('.toast').toast('show');
        $('.toast-body').html('No Image detected!');
        return;
    }
    sendFile('pay_qr_frm', '../submitOffer1/', callback);
});
</script>