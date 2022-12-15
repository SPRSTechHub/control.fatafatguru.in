<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Hello, world!</title>
</head>

<body>

    <?
    $prevStat = $this->input->get('prevStat');
    if (!empty($prevStat)) {
        echo $prevStat;
    }


    ?>
    <h1>Payment Gateway Checker!</h1>


    <input type="text" value="1" id="amnt" />

    <input type="text" value="9051135603" id="mbl" /><br>

    <button id="pressme" type="button">Want to Press Me ?</button>

    <script>
    $('#pressme').click(function() {
        $.post('<?= base_url(); ?>/api/', // url
            {
                action: 'add_money_ct',
                pmgateway: 'upiapi',
                amount: $('#amnt').val(),
                mobile: $('#mbl').val(),
            }, // data to be submit
            function(data, status, jqXHR) { // success callback
                console.log(data);
                if (data['status'] == 0) {
                    location.replace(data['data']['payment_url']);
                    //                    console.log();
                }
                //$('p').append('status: ' + status + ', data: ' + data);
            }, "json");
    });
    </script>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>