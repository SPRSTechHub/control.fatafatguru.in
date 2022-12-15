    <!-- Match Modal -->
    <div class="modal fade" id="mkt_rt_mdl" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm modal-dialog-centered text-left" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Market ratio</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_mkt_rtio_frm" method="POST" action="#">
                        <div class="form-group select2-sm mb-3">
                            <label for="catid" class="col-form-label">Select Game Catagory:</label>
                            <select class="form-select form-select select2" id="catid" name="cat_id"
                                onchange="getRatio(this);">
                                <option value="">Select one</option>
                                <? $cats = $this->Homemodel->find(array('status' => 0), 'tbl_game_catagory');
                                if ($cats) {
                                    foreach ($cats->result() as $rowdata) {
                                        echo '<option value="' . $rowdata->cat_id . '">' . $rowdata->cat_title . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">SD</span>
                                    <input type="number" class="form-control" placeholder="0.00" value="" name="sd"
                                        id="sd_txt" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">SP</span>
                                    <input type="number" class="form-control" placeholder="0.00" value="" name="sp"
                                        id="sp_txt" required>
                                </div>
                            </div>
                        </div>

                        <div class=" row mb-4">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">DP</span>
                                    <input type="number" class="form-control" placeholder="0.00" value="" name="dp"
                                        id="dp_txt" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">TP</span>
                                    <input type="number" class="form-control" placeholder="0.00" value="" name="tp"
                                        id="tp_txt" required>
                                </div>
                            </div>
                        </div>

                        <div class=" row mb-4">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">CP</span>
                                    <input type="number" class="form-control" placeholder="0.00" value="" name="cp"
                                        id="cp_txt" required>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">JODI</span>
                                    <input type="number" class="form-control" placeholder="0.00" value="" name="jodi"
                                        id="jodi_txt" required>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="save_mkt_item">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_cat_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm  modal-dialog-centered text-left" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Catagory</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_cat_frm" method="POST" action="#" name="add_cat_frm">
                        <input type="hidden" name="action" value="addNewGameCatagory" />
                        <div class="mb-3">
                            <img id="imgPreview"
                                src="https://codeigniter.spruko.com/sash/sash/assets/images/media/24.jpg" alt="img"
                                class="br-5">
                        </div>
                        <div class="mb-3">
                            <input class="form-control form-control-sm" type="file" id="file" name="file"
                                accept="image/png, image/jpeg" placeholder="Select offer image">
                        </div>
                        <div class="mb-3">
                            <label for="cat_name" class="col-form-label">Set Game Name:</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="save_game_cat">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="gm_item_mdl" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm  modal-dialog-centered text-left" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Game Name</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_gm_item_frm" method="POST" action="#">
                        <div class="mb-3">
                            <label for="item_name" class="col-form-label">Set Game Title:</label>
                            <input type="text" class="form-control" id="item_name" name="item_name">
                        </div>
                        <div class="form-group select2-sm mb-3">
                            <label for="cat_id" class="col-form-label">Select Game Catagory:</label>
                            <select class="form-select form-select select2" id="cat_id" name="cat_id">
                                <option value="">Select one</option>
                                <? $cats = $this->Homemodel->find(array('status' => 0), 'tbl_game_catagory');
                                if ($cats) {
                                    foreach ($cats->result() as $rowdata) {
                                        echo '<option value="' . $rowdata->cat_id . '">' . $rowdata->cat_title . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="save_game_item">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="matchset_mdl" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Add Game Set</h5>
                    <button class="btn-close me-1" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card bg-info img-card box-info-shadow mb-1">
                        <div class="card-header text-white">
                            <div class="card-title">Current Games in Catagory</div>
                        </div>
                        <div class="card-body d-flex">
                            <div class="bg-secondary-transparent d-flex mx-2 expanel-body">
                                <div class="text-white">
                                    <h2 class="mb-2 number-font">7</h2>
                                    <p class="text-white mb-0">Catagory 1 </p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                            <div class="bg-secondary-transparent d-flex mx-2 expanel-body">
                                <div class="text-white">
                                    <h2 class="mb-2 number-font">3</h2>
                                    <p class="text-white mb-0">Catagory 2 </p>
                                </div>
                                <div class="ms-auto"> <i class="fa fa-user-o text-white fs-30 me-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                    <div class="card bg-dark img-card text-white box-primary-shadow">
                        <div class="card-body">
                            <form action="#" method="POST" name="game_form" id="game_form">
                                <div class="row">
                                    <div class="col-sm-6 col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-text">Set Day</span>
                                            <select class="form-control form-select select2"
                                                data-bs-placeholder="Select" name="day" id="sel_day">
                                                <option label="Select">Select Day</option>
                                                <option value="monday">Monday</option>
                                                <option value="tuesday">Tuesday</option>
                                                <option value="wednesday">Wednessday</option>
                                                <option value="thursday">Thurseday</option>
                                                <option value="friday">Friday</option>
                                                <option value="saturday">Saturday</option>
                                                <option value="sunday">Sunday</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-text">Set Match Time</span>
                                            <input class="form-control" placeholder="spinner-border spinner-border-sm"
                                                type="time" name="match_time" id="match_time" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-text">Set Game Catagory</span>
                                            <select class="form-control form-select select2"
                                                data-bs-placeholder="Select" name="cat_id" id="cat_title"
                                                onchange="getUpdate(this)">
                                                <option label="Select">Select Catagory</option>
                                                <? $cats = $this->home->find(array('status' => 0), 'tbl_game_catagory');
                                                if ($cats) {
                                                    foreach ($cats->result() as $rowdata) {
                                                        echo '<option value="' . $rowdata->cat_id . '">' . $rowdata->cat_title . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-group">
                                            <span class="input-group-text">Set Game Name</span>
                                            <select class="form-control form-select select2"
                                                data-bs-placeholder="Select" id="item_name_txt" name="item_id">
                                                <option label="Select">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-1">
                                        <button class="btn btn-primary btn-pill" type="button" id="sbmt_btn">Submit
                                            Game</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- img-card text-white box-primary-shadow -->
                    <div class="card bg-success img-card text-white box-primary-shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table1" class="table table-bordered border text-nowrap mb-0"></table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_gm_dgt_mdl" tabindex="-1" role="dialog">
        <div class="modal-dialog  modal-dialog-centered text-left" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add/ Update Digits</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add_gm_digits_frm" method="POST" action="#">

                        <div class="form-group select2-sm mb-3">
                            <label for="cat_id" class="col-form-label">Select Bet Type:</label>
                            <select class="form-select form-select select2" id="digit_type" name="betType">
                                <option value="">Select one</option>
                                <option value="SingleDigit">Single Digit</option>
                                <option value="SinglePanna">Single Panna</option>
                                <option value="DoublePanna">Double Panna</option>
                                <option value="TripplePanna">Tripple Panna</option>
                            </select>
                        </div>
                        <div class="form-list"></div>
                        <div id="form-template" style="display: none">
                            <div class="form-row from-group">
                                <input type="text" class="form-control col-md-2 mb-0" placeholder="" name="betVal[]"
                                    value="">
                                <input type="text" class="form-control col-md-2 mb-0" placeholder="" name="betVal[]"
                                    value="">
                                <input type="text" class="form-control col-md-2 mb-0" placeholder="" name="betVal[]"
                                    value="">
                                <input type="text" class="form-control col-md-2 mb-0" placeholder="" name="betVal[]"
                                    value="">
                                <input type="text" class="form-control col-md-2 mb-0" placeholder="" name="betVal[]"
                                    value="">
                                <div class="btn-list">
                                    <button type="button" class="btn btn-icon  btn-success add-btn"><i
                                            class="fe fe-plus"></i></button>
                                    <button type="button" class="btn btn-icon  btn-danger remove-btn"><i
                                            class="fe fe-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="save_game_digit">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
$(function() {
    sel_day,
    cat_title,
    cat_title
    $("#sbmt_btn").on("click", function(event) {
        event.preventDefault();
        var form = $("#game_form");
        var data = form.serialize() + '&action=' + 'addgameset';
        $.post("<?= base_url(); ?>/admin/", data, function(result) {
            if (result) {
                result = JSON.parse(result);
                return $.growl.notice1({
                    message: result.message
                });
            }
            $('#matchset_mdl').modal('hide');
            location.reload();
        });
    });

    $("#save_mkt_item").on("click", function(event) {
        event.preventDefault();
        var form = $("#add_mkt_rtio_frm");

        if ($("#sd_txt").val() == '' || $("#sp_txt").val() == '' || $("#dp_txt").val() == '' || $("#tp_txt")
            .val() == '' || $("#cp_txt").val() == '' || $("#jodi_txt").val() == '') {
            return $.growl.notice1({
                message: 'All fields are mandatory!'
            });
        } else {
            var data = form.serialize() + '&action=' + 'addmktRatio';
            $.post("<?= base_url(); ?>/admin/", data, function(result) {
                if (result) {
                    result = JSON.parse(result);
                    return $.growl.notice1({
                        message: result.message
                    });
                }
                $('#mkt_rt_mdl').modal('hide');
                location.reload();
            });
        }
    });

    $('#table1').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url(); ?>/datafunction/get_tbl_data/',
            dataType: 'json',
            data: {
                action: 'getuser',
                table: 'tbl_gamelist'
            },
            type: 'POST',
        },
        columns: [{
                title: "ID",
                data: 'id',
            },
            {
                title: "MATCH ID",
                data: 'match_id',
            },
            {
                title: "MATCH TIME",
                data: 'match_time',
            },
            {
                title: "DAY",
                data: 'day',
            },
            {
                title: "GAME TITLE",
                data: 'game_title',
            }
        ],
        scrollY: 400
    });
});

function getUpdate(obj) {
    var cat_id_value = document.getElementById('cat_title').value;
    data = {
        cat_id: cat_id_value,
        action: 'getItembyCat'
    };
    $.post("/admin/", data,
        function(data, status, xhr) {
            if (data['status'] == 1) {
                let birds = data['message'];
                $('#item_name_txt').empty();
                for (let i = 0; i < birds.length; i++) {
                    $('#item_name_txt').append($('<option>').val(birds[i].item_id).text(birds[i].item_name));
                }
            } else {
                return $.growl.warning1({
                    message: "No Game present here"
                });
            }
        }, 'json');
}

function getRatio(obj) {
    var cat_id_value = document.getElementById('catid').value;
    data = {
        cat_id: cat_id_value
    };
    $.post("/admin/getRatio/", data,
        function(data, status, xhr) {
            if (data['status'] == 1) {
                let rspData = data['message'];
                $('#sd_txt').val(rspData['sd']);
                $('#sp_txt').val(rspData['sp']);
                $('#dp_txt').val(rspData['dp']);
                $('#tp_txt').val(rspData['tp']);
                $('#cp_txt').val(rspData['cp']);
                $('#jodi_txt').val(rspData['jodi']);
            } else {
                return $.growl.warning1({
                    message: "No Ratio present here"
                });
            }
        }, 'json');
}

function addFormElements() {
    $('.form-list').append($("#form-template .form-row").clone())
}

function removeFormElements() {
    $(this).parents('.form-row').remove();
}


$(document).ready(addFormElements);
$(document).on("click", ".add-btn", addFormElements);
$(document).on("click", ".remove-btn", removeFormElements);

$(function() {
    $("#save_game_digit").on("click", function(event) {
        event.preventDefault();
        var form = $("#add_gm_digits_frm");
        var data = form.serialize();
        $.post("<?= base_url(); ?>/admin/storeDigits/", data, function(result) {
            if (result) {
                result = JSON.parse(result);
                return $.growl.warning1({
                    message: result.message
                });
            }
            $('#add_gm_dgt_mdl').modal('hide');
        });
    });
});
    </script>