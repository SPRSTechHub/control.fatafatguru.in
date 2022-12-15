<?php
date_default_timezone_set('Asia/Kolkata');
defined('BASEPATH') or exit('No direct script access allowed');

class Adapi extends CI_Controller
{
    protected $authchecker = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model("Api_model", "api");
        $this->load->model(array('Homemodel' => 'home'));
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        //  header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
        $this->authchecker = $this->api->Authcheck('apicall');
        if ($this->authchecker == false) {
            echo 'Access Denied!';
            exit;
        }
    }

    function checkPermission($variable)
    {
        if ($this->api->Authcheck($variable) == false) {
            $result = array();
            $result['status'] = 1;
            $result['message'] = 'Access Blocked by Admin';
            echo json_encode($result, JSON_PRETTY_PRINT);
            exit;
        } else {
            return false;
        }
    }

    function GetMethodName($action)
    {
        $data = $this->input->post('action');
        if ((array_key_exists('action', $data)) !== false) {
            return $data;
            unset($data['action']);
        } else {
        }
    }

    function RandS($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function index()
    {
        $result = array();
        $data = $this->input->post();
        if (empty($data['action'])) {
            $result['status'] = '1';
            $result['message'] = 'No action decided yet!';
        } else {
            switch ($data['action']) {
                case "getnotify":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $allusers = $this->api->find(array('status' => 0), 'tbl_notify');
                    if ($allusers) {
                        $result['status'] = 0;
                        $result['message'] = 'Notification found!';
                        $result['data'] = $allusers->result();
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No Notification for today!';
                        $result['data'] = null;
                    }
                    break;
                case "getgames":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $allgames = $this->api->find(array('status' => 0), 'tbl_gamelist');
                    if ($allgames) {
                        $result['status'] = 0;
                        $result['message'] = 'games found!';
                        $result['data'] = $allgames->result();
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No active games found!';
                        $result['data'] = null;
                    }
                    break;
                    /*case "getgames":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $allgames = $this->api->find(array('status' => 0), 'tbl_gamelist');
                    if ($allgames) {
                        $result['status'] = 0;
                        $result['message'] = 'games found!';
                        $result['data'] = $allgames->result();
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No active games found!';
                        $result['data'] = null;
                    }
                    break;*/
                case "fetchProfile":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $profile = $this->api->find(array('status' => 0, 'mobile' => $data['mobile']), 'tbl_users');
                    if ($profile) {
                        $profileDetails = $profile->row();
                        $resp = array(
                            'userid' => $profileDetails->userid,
                            'fullname' => $profileDetails->fullname,
                            'mobile' => $profileDetails->mobile,
                            'refer_id' => $profileDetails->refer_id,
                            'status' => $profileDetails->status
                        );
                        $getLogin =  $this->api->find(array('status' => 0, 'mobile' => $data['mobile']), 'tbl_login');
                        if ($getLogin) {
                            $LoginDetails = $getLogin->row();
                            $resp['password'] = $LoginDetails->password;
                        }
                        $getWallet =  $this->getBalance($data['mobile']);
                        if ($getWallet) {
                            $resp['Bal'] = $getWallet;
                        }
                        $result['status'] = 0;
                        $result['message'] = 'User found!';
                        $result['data'] = $resp;
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No active games found!';
                        $result['data'] = null;
                    }
                    break;
                case "getGemsbyday":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $allgames = $this->api->find(array('status' => 0, 'day' => $data['day']), 'tbl_gamelist');
                    if ($allgames) {
                        $result['status'] = 0;
                        $result['message'] = 'games found!';
                        $result['data'] = $allgames->result();
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No active games found!';
                        $result['data'] = null;
                    }
                    break;

                case "showbets":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $cgid = $data['game_id'];
                    $cgid = !empty($cgid) ? $cgid : 'FFLV2';

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
                                $sd['sd_bet_c'] = $row_data->bbi;
                            }
                            if ($row_data->bet_type == 'SinglePanna') {
                                $sp[$row_data->bet_val] = $row_data->bb;
                                $sp['sp_bet_c'] = $row_data->bbi;
                            }
                            if ($row_data->bet_type == 'DoublePanna') {
                                $dp[$row_data->bet_val] = $row_data->bb;
                                $dp['dp_bet_c'] = $row_data->bbi;
                            }
                            if ($row_data->bet_type == 'TripplePanna') {
                                $tp[$row_data->bet_val] = $row_data->bb;
                                $tp['tp_bet_c'] = $row_data->bbi;
                            }
                            if ($row_data->bet_type == 'cp') {
                                $cp[$row_data->bet_val] = $row_data->bb;
                                $cp['cp_bet_c'] = $row_data->bbi;
                            }
                        }
                        $result['status'] = 0;
                        $result['message'] = $sp;
                    } else {

                        $result['status'] = 1;
                        $result['message'] = null;
                    }
                    break;
                case "addresult":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    if (empty($data['match_id'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Game id is required!';
                    } else if (empty($data['win_type'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Bet type is required!';
                    } else {
                        $cp_stat = 0;
                        $sd_stat = 0;
                        $prime_stat = 0;

                        $findGame = $this->home->find(array('match_id' => $data['match_id']), 'tbl_gamelist');
                        if ($findGame) {
                            //add game Result List//
                            $gm_result_data = array(
                                'match_id' => $data['match_id'],
                                'game_title' => $findGame->row()->game_title,
                                'cat_title' => $findGame->row()->cat_title,
                                'digit' => $data['win_digit'],
                                'patti' => $data['win_val'],
                                'win_type' => $this->selector($data['win_type']),
                                'month' => date('M'),
                                'date' => date('d-m-Y'),
                            );

                            $result_add = $this->home->insert_check(array('match_id' => $gm_result_data['match_id'], 'date' => date('d-m-Y'), 'win_type' => $gm_result_data['win_type']), $gm_result_data, 'tbl_results');

                            if ($result_add) {
                                // check Primary //
                                $primecheck = $this->chkBets($findGame->row(), $data['win_type'], $data['win_val'], $this->selector($data['win_type']));
                                if (!empty($primecheck) && count($primecheck)) {
                                    $Update_prime_wins = $this->updateWinners($primecheck, $data['match_id']);
                                    $prime_stat = $Update_prime_wins; // true
                                }
                                // check SD Final//
                                $sdcheck = $this->chkBets($findGame->row(), 'sd', $data['win_digit'], 'SingleDigit');
                                if (!empty($sdcheck) && count($sdcheck)) {
                                    $Update_sd_wins = $this->updateWinners($sdcheck, $data['match_id']);
                                    $sd_stat = $Update_sd_wins; // true
                                }
                                // check CP //
                                $cpcheck = $this->chkBets($findGame->row(), 'cp', $data['win_val'], 'cp');
                                if (!empty($cpcheck) && count($cpcheck)) {
                                    $Update_cp_wins = $this->updateWinners($cpcheck, $data['match_id']);
                                    $cp_stat = $Update_cp_wins; // true
                                }

                                if ($sd_stat == 0 && $prime_stat == 0) {
                                    $blank_win_data = array(
                                        'match_id' => $data['match_id'],
                                        'cat_id' => $findGame->row()->cat_id,
                                        'game_id' => $findGame->row()->game_id,
                                        'win_val' => $data['match_id'],
                                        'win_amnt' => 0,
                                        'win_type' => $this->selector($data['win_type']),
                                        'date' => date('d-m-Y'),
                                        'time' => date('h:i'),
                                        'mobile' => '0000000000'
                                    );
                                    $insert_no_winner = $this->home->insert_check(array('match_id' => $data['match_id'], 'date' => date('d-m-Y'), 'win_type' =>  $this->selector($data['win_type'])), $blank_win_data, 'tbl_winnings');
                                    $prime_stat = 1;
                                }

                                $result['status'] = 0;
                                $result['message'] = 'Result Updated : SD-' . $sd_stat . ' CP-' . $cp_stat . ' PRIME-' . $prime_stat;
                            } else {
                                $result['status'] = 1;
                                $result['message'] = 'Result already Exists!';
                            }
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'Update Error!';
                        }
                    }
                    break;
                case "addpymnt":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    if (empty($data['mobile'])) {
                        $result['status'] = 1;
                        $result['message'] = 'User mobile is missing!';
                    } else {
                        $rsp = $this->home->find(array('mobile' => $data['mobile']), 'tbl_wallet');
                        if ($rsp) {
                            $date = date('d-m-Y');
                            $insert_data = array(
                                'mobile' => $data['mobile'],
                                'amount' => $data['amount'],
                                'trtype' => $data['trtype'],
                                'balance' => 0,
                                'trdetails' => 'admin_update',
                                'trno' => $this->RandS(19),
                                'date' => $date,
                                'time' => date('H:i')
                            );
                            $insertdata = $this->home->insert_check_update(array('mobile' => $data['mobile'], 'amount' => $data['amount'], 'date' => $date), $insert_data, 'tbl_wallet');
                            $result['status'] = 0;
                            $result['message'] = !empty($insertdata) ? 'Update Successfully' : 'Update Error!';
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'Update Error, No User found!';
                        }
                    }
                    break;

                default:
                    $result['status'] = 1;
                    $result['message'] = 'Invalid action!';
                    $result['data'] = null;
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    function getBalance($mobile)
    {
        $getCr = $this->api->get_bal(array('mobile' => $mobile, 'trtype' => 'credit'));
        $getDr = $this->api->get_bal(array('mobile' => $mobile, 'trtype' => 'debit'));
        $getBal = round(((!empty($getCr) ? $getCr : 0) - (!empty($getDr) ? $getDr : 0)), 2);
        if ($getBal > 0) {
            return $getBal;
        } else {
            return false;
        }
    }

    function chkBets($param, $bet, $betVal, $bet_type)
    {
        $arr = array();
        $data = date('d-m-Y');
        $mktRatio = $this->home->find(array('cat_id' => $param->cat_id), 'tbl_market_ration');
        if ($mktRatio) {
            $setAmnt = $mktRatio->row()->$bet;
        }
        if ($bet_type == 'cp') {
            $find_sd_bets = $this->home->findLike(array('match_id' => $param->match_id, 'date' => $data, 'bet_type' => $bet_type, 'bet_val' => $betVal), 'tbl_bets');
        } else {
            $find_sd_bets = $this->home->find(array('match_id' => $param->match_id, 'date' => $data, 'bet_type' => $bet_type, 'bet_val' => $betVal), 'tbl_bets');
        }
        if ($find_sd_bets) {
            foreach ($find_sd_bets->result() as $rowData) {
                $arr[] = array(
                    'match_id' => $param->match_id,
                    'cat_id' => $param->cat_id,
                    'game_id' => $param->game_id,
                    'win_val' => $rowData->bet_val,
                    'win_amnt' => round($rowData->bet_amnt * $setAmnt),
                    'win_type' => $rowData->bet_type,
                    'date' => $data,
                    'time' => date('H:i'),
                    'mobile' => $rowData->mobile
                );
            }
            return $arr;
        } else {
            return false;
        }
    }

    function selector($type)
    {
        switch ($type) {
            case "sd":
                $result = 'SingleDigit';
                break;
            case "sp":
                $result = 'SinglePanna';
                break;
            case "dp":
                $result = 'DoublePanna';
                break;
            case "tp":
                $result = 'TripplePanna';
                break;
            case "jodi":
                $result = 'jodi';
                break;
            case "cp":
                $result = 'cp';
                break;
            default:
                $result = null;
        }
        return $result;
    }

    public function updateWinners($params, $match_id)
    {
        if (count($params) == 1) {
            $insert_winner = $this->home->insert_check(array('match_id' => $match_id, 'date' => date('d-m-Y'), 'win_type' => $params[0]['win_type']), $params[0], 'tbl_winnings');
            $walletdata = $this->make_winner_bal($params);
            $insert_winner_wallet = $this->home->insert_check(array('mobile' => $params[0]['mobile'], 'date' => date('d-m-Y'), 'trdetails' => $params[0]['win_type'] . '_win_amnt'), $walletdata, 'tbl_wallet');
            return ($insert_winner_wallet) ? true : false;
        } else {
            $insert_winner = $this->home->insert_batch_check(array('match_id' => $match_id, 'date' => date('d-m-Y')), $params, 'tbl_winnings');
            $walletdata = $this->make_winner_bal($params);
            $insert_winner_wallet = $this->home->insert_batch_check(array('trdetails' => $params[0]['win_type'] . '_win_amnt', 'date' => date('d-m-Y')), $walletdata, 'tbl_wallet');
            return ($insert_winner_wallet) ? true : false;
        }
    }

    public function make_winner_bal($param)
    {
        $arr = array();
        if (count($param) == 1) {
            $arr = array(
                'mobile' => $param[0]['mobile'],
                'amount' => $param[0]['win_amnt'],
                'trtype' => 'credit',
                'trdetails' => $param[0]['win_type'] . '_win_amnt',
                'trno' => $this->RandS(3),
                'date' => date('d-m-Y'),
                'time' => date('h:i'),
            );
        } else {
            foreach ($param as $keyVal) {
                $arr[] = array(
                    'mobile' => $keyVal['mobile'],
                    'amount' => $keyVal['win_amnt'],
                    'trtype' => 'credit',
                    'trdetails' => $keyVal['win_type'] . '_win_amnt',
                    'trno' => $this->RandS(3),
                    'date' => date('d-m-Y'),
                    'time' => date('h:i'),
                );
            }
        }
        return $arr;
    }
}