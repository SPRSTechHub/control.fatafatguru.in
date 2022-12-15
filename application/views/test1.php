<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-10 col-md-10 col-lg-8">
                <form action="#" method="POST" name="game_form" id="game_form">
                    <div class="form-group col-md-4">
                        <select class="selectpicker form-control single-select" placeholder="Select an Option..."
                            required name="betType">
                            <option></option>
                            <option value="SingleDigit">Single D</option>
                            <option value="SinglePanna">SP</option>
                            <option value="DoublePanna">DP</option>
                            <option value="TripplePanna">TP</option>
                        </select>
                    </div>
                    <div class="form-list">
                    </div>
                    <div class="form-row" style="padding-top: 50px;">
                        <button class="btn btn-primary btn-pill" type="button" id="sbmt_btn">Submit
                            Game</button>
                    </div>
                </form>
            </div>
        </div>


        <div id="form-template" style="display: none">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" placeholder="" name="betVal[]" value="">
                    <input type="text" class="form-control" placeholder="" name="betVal[]" value="">
                    <input type="text" class="form-control" placeholder="" name="betVal[]" value="">
                    <input type="text" class="form-control" placeholder="" name="betVal[]" value="">
                    <input type="text" class="form-control" placeholder="" name="betVal[]" value="">
                </div>
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-success add-btn">Add</button>
                </div>
                <div class="form-group col-md-1">
                    <button type="button" class="btn btn-danger remove-btn">Remove</button>
                </div>
            </div>
        </div>

    </div>
    <script>
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
        $("#sbmt_btn").on("click", function(event) {
            event.preventDefault();
            var form = $("#game_form");
            var data = form.serialize() + '&action=' + 'addgameset';
            $.post("<?= base_url(); ?>/admin/storeDigits/", data, function(result) {
                if (result) {
                    result = JSON.parse(result);
                    console.log(result.message);
                }
                $('#matchset_mdl').modal('hide');
            });
        });
    });
    </script>

</body>

</html>