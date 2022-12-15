<!--Bottom Offcanvas-->
<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel"
    style="height:75vh;">
    <div class="offcanvas-header bg-danger">
        <h5 class="offcanvas-title" id="offcanvasBottomLabel">MAKE WINNERS</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"><i
                class="fe fe-x fs-18"></i></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="d-flex justify-content-between bg-dark m-0 p-2">
            <div class="dimmer active m-0 p-0">
                <div class="lds-hourglass" style="margin:0px;"></div>
            </div>
            <div class="btn-list bg-dark m-0 p-2">
                <a href="javascript:void(0)" class="btn btn-primary btn-pill" id="show_gm_btn">Games</a>
                <a href="javascript:void(0)" class="btn btn-secondary btn-pill">E+</a>
                <a href="javascript:void(0)" class="btn btn-success btn-pill">E++</a>
            </div>
        </div>
        <div class="card card-status bg-blue br-te-7 br-ts-7"></div>
        <div class="card card-body m-0 p-0">
            <div class="expanel expanel-default">
                <div class="expanel-heading d-flex justify-content-between">
                    PLEASE CHECK BELOW DETAILS BEFORE PUBLISH RESULTS
                </div>
                <div class="expanel-body">
                    <form action="#" method="POST" name="game_res_frm" id="game_res_frm">
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-dark">GAME ID</span>
                            <input class="form-control bg-warning" placeholder="Game id" type="text" name="match_id"
                                id="gm_id" />
                            <span class="input-group-text" id="basic-addon2">F</span>
                        </div>
                        <div class="input-group mb-2">
                            <span class="input-group-text bg-dark">BET TYPE</span>
                            <select name="win_type" id="win_type" class="form-control form-select select2 bg-lime"
                                data-bs-placeholder="Select Country">
                                <option value="" selected>Select here</option>
                                <option value="sp">Single Panna</option>
                                <option value="dp">Double Panna</option>
                                <option value="tp">Tripple Panna</option>
                            </select>
                            <span class="input-group-text" id="basic-addon2">X</span>
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-success" id="inputGroup-sizing-lg">RESULT NO.</span>
                                <input type="text" class="form-control bg-danger-transparent" name="win_val"
                                    id="win_val" placeholder="Minimum 3 digits" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-lg" value="" maxlength="3">
                                <input type="text" value="" id="win_digit" name="win_digit"
                                    class="form-control bg-success" />
                                <div class="example p-2 m-2 bg-red">
                                    <div class="tags">
                                        <div class="tag tag-dark">
                                            SP<span class="tag-addon tag-success" id="sp_counter">0</span>
                                        </div>
                                        <div class="tag tag-dark">
                                            SD<span class="tag-addon tag-success" id="sd_counter">0</span>
                                        </div>
                                        <div class="tag tag-dark">
                                            CP<span class="tag-addon tag-success" id="cp_counter">0</span>
                                        </div>
                                        <div class="tag tag-dark">
                                            JODI<span class="tag-addon tag-success" id="jodi_counter">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <button type="button" class="btn btn-success btn-lg mb-3 btn-block me-2"
                                id="save_result">SAVE</button>
                            <!-- <button type="button" class="btn btn-success btn-lg mb-3 btn-block me-2">PUBLISH</button> -->
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!--/Bottom Offcanvas-->

<!-- SMALL MODAL -->
<div class="modal fade" id="gameListsbox">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header row">
                <div class="col-md-4">
                    <h6 class="modal-title">Game Lists</h6>
                </div>
                <div class="col-md-6">
                    <select class="form-control select2 form-select" style="width: 220px;">
                        <option value="">Select catagory here</option>
                        <option value="8">08</option>
                        <option value="9">09</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="">
                    <div class="list-group">
                        <? include(APPPATH . "views/widgets/functions.php");
                        if (!empty($tdg)) {
                            foreach ($tdg->result() as $rowvalue) {
                        ?>
                        <a href="javascript:void(0)" onclick="update_game_id(this);" data="<?= $rowvalue->match_id; ?>"
                            class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?= $rowvalue->game_title; ?></h5>
                                <small class="text-muted"><?= $rowvalue->match_time; ?></small>
                            </div>
                        </a>
                        <? }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- SWEET-ALERT JS -->
<script src="<?= base_url(); ?>/assets/plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/sweet-alert.js"></script>
<script>
function update_game_id(obj) {
    $('#gm_id').val($(obj).attr('data'));
    if ($('#gm_id').val() == '') {
        $('#win_type').prop('disabled', true);
        $('#win_digit').prop('readonly', true);
        $('#win_val').prop('disabled', true);
    } else {
        $('#win_type').prop('selectedIndex', 0);
        $('#win_digit').val('');
        $('#win_val').val('');
        $('#win_type').prop('disabled', false);
    }
}

$(function() {
    "use strict";
    $('#save_result').prop("disabled", true);
    $('#win_val').prop('disabled', true);
    var myOffcanvas = document.getElementById('offcanvasBottom');
    myOffcanvas.addEventListener('show.bs.offcanvas', function() {
        let v = sessionStorage.getItem("live_id");
        if (v == '') {
            $('#gm_id').val($('#live_gm_title').text());
        } else {
            $('#gm_id').val(v);
        }
    });

    $("#show_gm_btn").click(function() {
        $('#gameListsbox').modal('show');
    });

    $("#gm_id").blur(function() {
        $("#global-loader").fadeIn("fast");
        if ($('#gm_id').val() == '') {
            $('#win_type').prop('selectedIndex', 0);
            $('#win_digit').prop('readonly', true);
            $('#win_val').prop('disabled', true);
            $("#global-loader").fadeOut("slow");
        } else {
            $('#win_type').prop('selectedIndex', 0);
            $('#win_digit').val('');
            $('#win_val').val('');
            $('#win_type').prop('disabled', false);
            $("#global-loader").fadeOut("slow");
        }
    });

    $("#win_type").change(function() {
        //$("#global-loader").fadeIn("slow");
        if ($('#win_type option:selected').val() == '') {
            $('#win_digit').prop('readonly', true);
            $('#win_val').prop('disabled', true);
            //$("#global-loader").fadeOut("slow");
        } else {
            $('#win_digit').val('');
            $('#win_val').val('');
            $('#win_val').prop('disabled', false);
            //$("#global-loader").fadeOut("slow");
        }
    });

    $("#win_val").change(function() {
        //$("#global-loader").fadeIn("slow");
        var t = [];
        var sum = 0;
        let num = $(this).val();
        if (num.length >= 3) {
            for (var i = 0; i < num.length; i++) {
                sum += parseFloat(num.charAt(i));
            }
            //get last digit
            $('#win_digit').val(Math.floor(sum % 10));
            if (sum != '') {
                chkBets();
            }
        } else {
            //$("#global-loader").fadeOut("slow");
            $('#win_digit').val('');
            console.log('Please enter Numbers only');
        }
    });

    $('#save_result').on('click', function(e) {
        //$("#global-loader").fadeIn("slow");
        e.preventDefault();
        const form = document.getElementById("game_res_frm");
        const formData = new FormData(form);
        formData.append('action', 'AddGameResult');
        sendData(formData, '<?= base_url(); ?>admin/', callback);
    });
});

function chkBets() {
    var match_id = document.getElementById('gm_id').val;
    var win_type = document.getElementById('win_type').val;
    var win_val = document.getElementById('win_val').val;
    var win_digit = document.getElementById('win_digit').val;
    const form = document.getElementById("game_res_frm");
    const formData = new FormData(form);
    formData.append('action', 'CheckGameResult');
    if (match_id != '' && win_type != '' && win_val != '' && win_digit != '') {
        sendData(formData, '<?= base_url(); ?>admin/', cb_summery);
    } else {
        document.getElementById('win_val').val = '';
        //$("#global-loader").fadeOut("slow");
    }
}

function cb_summery(params) {
    ////$("#global-loader").fadeOut("slow");
    if (params != '') {
        if (params.status == 0) {
            $('#save_result').prop("disabled", false);

            $('#sd_counter').text(params.message['count_sd_winners']);
            $('#cp_counter').text(params.message['count_cp_winners']);
            $('#jodi_counter').text(params.message['count_jodi_winners']);
            $('#sp_counter').text(params.message['count_sp_winners']);
            $('#dp_counter').text(params.message['count_dp_winners']);
            $('#tp_counter').text(params.message['count_tp_winners']);
        }
    }
}

function callback(params) {
    //$("#global-loader").fadeOut("slow");
    if (params != '') {
        if (params.status == 0) {
            swal({
                title: "Status",
                text: params.message,
                type: 'success'
            });
            // location.reload();
        } else {
            swal({
                title: "Status",
                text: params.message,
                type: 'error'
            });
        }
    }
}
</script>