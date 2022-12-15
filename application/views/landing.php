<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <?
        $cgid = 'FFLV15';

        $curr_bets = $this->home->findBets(array('match_id' => $cgid), 'tbl_bets');
        $sd = array();
        $sp = array();
        $dp = array();
        $tp = array();
        $cp = array();

        if ($curr_bets) {
            foreach ($curr_bets->result() as $row_data) {
                if ($row_data->bet_type == 'SingleDigit') {
                    $sd[$row_data->bet_val] = $row_data->bb;
                }
                if ($row_data->bet_type == 'SinglePanna') {
                    $sp[$row_data->bet_val] = $row_data->bb;
                }
                if ($row_data->bet_type == 'DoublePanna') {
                    $dp[$row_data->bet_val] = $row_data->bb;
                }
                if ($row_data->bet_type == 'TripplePanna') {
                    $tp[$row_data->bet_val] = $row_data->bb;
                }
                if ($row_data->bet_type == 'cp') {
                    $cp[$row_data->bet_val] = $row_data->bb;
                }
            }
        } else {
            echo 'no bets';
        }

        echo 'SD';
        foreach ($sd as $key => $value) {
            echo $key . '==' . $value . '<br>';
        }

        echo 'SP';
        foreach ($sp as $key => $value) {
            echo $key . '==' . $value . '<br>';
        }
        echo 'DP';
        foreach ($dp as $key => $value) {
            echo $key . '==' . $value . '<br>';
        }
        ?>

    </div>
</body>

</html>