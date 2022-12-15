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
                <h1 class="page-title">SETTINGS MANAGEMENT</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Master Settings</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">BANK & UPI SETTINGS</h3>
                        </div>
                        <div class="card-body">
                            <? $tbl_fields = $this->home->searchQuery('SELECT * FROM `meta_settings`');

                            /* $listsort = array('timesamp', 'client_site_url', 'client_cb_url', 'api_details');
                            foreach ($listsort as $keyv) {
                                if (($key = array_search($keyv, $tbl_col)) !== false) {
                                    unset($tbl_col[$key]);
                                }
                            } */
                            if ($tbl_fields) {
                            ?>
                            <div class="">
                                <ul class="list-group">
                                    <? foreach ($tbl_fields->result() as $keyFields) { ?>
                                    <li class="list-group-item justify-content-between">
                                        <form name="<?= $keyFields->id . '_frm'; ?>"
                                            id="<?= $keyFields->id . '_frm'; ?>" class="form_update">
                                            <div class="d-flex justify-content-between">
                                                <span> <?= strtoupper($keyFields->descp); ?> </span>
                                                <label class="custom-switch ps-0">
                                                    <input type="checkbox" name="status"
                                                        id="chkb_<?= $keyFields->id; ?>"
                                                        class="custom-switch-input chkb"
                                                        value="<?= $keyFields->status; ?>"
                                                        <?= $keyFields->status == 0 ? 'checked' : ''; ?>>
                                                    <span class="custom-switch-indicator me-3"></span>
                                                </label>
                                            </div>
                                            <input type="hidden" name="settings" value="<?= $keyFields->settings; ?>"
                                                id="<?= $keyFields->id . '_stng'; ?>">
                                        </form>
                                    </li>
                                    <?
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">MetA DATA SETTINGS</h3>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <ul class="list-group">
                                    <?
                                    $tbl_col = $this->home->searchQuery('SELECT * FROM `meta_details`');
                                    foreach ($tbl_col->result() as $key) {
                                    ?>
                                    <li class="list-group-item justify-content-between">
                                        <form name="<?= $key->title . '_frm'; ?>" id="<?= $key->title . '_frm'; ?>"
                                            class="form_update">
                                            <div class="form-group">
                                                <input type="hidden" value="<?= $key->title; ?>" name="title">
                                                <div class="input-group">
                                                    <span
                                                        class="input-group-text"><?= strtoupper($key->title); ?></span>
                                                    <input type="text" class="form-control" name="descp"
                                                        placeholder="<?= strtoupper($key->descp); ?>"
                                                        aria-label="Client Id" aria-describedby="button-addon1"
                                                        value="<?= $key->descp; ?>">
                                                    <button class="btn btn-light update_btn" type="button"
                                                        id="<?= $key->title . '_btn'; ?>">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                    <?
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

<script>
$(function() {
    $('.chkb').click(function() {
        var val = $(this).val();
        var id = $(this).attr('id');
        var col = $('#' + id.charAt(id.length - 1) + '_stng').val();
        const formData = new FormData();
        formData.append('settings', col);
        formData.append('status', val);
        formData.append('action', 'updatesetting');
        sendData(formData, '<?= base_url(); ?>admin/', callback);
    });

    $('.update_btn').click(function() {
        var id = $(this).attr('id');
        var formid = id.slice(0, -3) + 'frm';
        const form = document.getElementById(formid);
        const formData = new FormData(form);
        formData.append('action', 'metaupdate');
        sendData(formData, '<?= base_url(); ?>admin/', callback);
    });
});

function callback(params) {
    if (params['status'] == 0) {
        return $.growl.notice1({
            message: params.message
        });
        location.reload();
    } else {
        return $.growl.notice1({
            message: params.message
        });
    }
}
</script>