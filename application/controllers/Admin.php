<?php
date_default_timezone_set('Asia/Kolkata');
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Homemodel' => 'home'));
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    }

    public function index()
    {
        $result = array();
        $fData = $this->input->post();
        if (empty($fData['action'])) {
            $result['status'] = '1';
            $result['message'] = 'No action decided yet!';
        } else {
            switch ($fData['action']) {
                case "addNewGameCatagory":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }

                    if (empty($fData['cat_name'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Catagory Name is missing!';
                    } else {
                        $fileStore = $this->upload_image('file', 'uploads/cat_img/');
                        if ($fileStore) {
                            $fData['cat_iurl'] = $fileStore;
                        } else {
                            $fData['cat_iurl'] = null;
                        }

                        $rsp = $this->addCatagory($fData);
                        if ($rsp) {
                            $result['status'] = 1;
                            $result['message'] = 'Data insert Successfully!';
                        } else {
                            echo $fileStore;
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "addNewGameItem":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['item_name'])) {
                        $result['status'] = 0;
                        $result['message'] = 'Item Name is missing!';
                    } else {
                        $rsp = $this->addGameItem($fData);
                        if ($rsp) {
                            $result['status'] = 1;
                            $result['message'] = 'Data insert Successfully!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "addmktRatio":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['cat_id'])) {
                        $result['status'] = 0;
                        $result['message'] = 'Item Name is missing!';
                    } else {
                        $rsp = $this->home->insert_check_update(array('cat_id' => $fData['cat_id']), $fData, 'tbl_market_ration');
                        if ($rsp) {
                            $result['status'] = 1;
                            $result['message'] = 'Data insert Successfully!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "hideGame":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['id'])) {
                        $result['status'] = 0;
                        $result['message'] = 'Id is missing!';
                    } else {

                        if ($fData['tbl'] == 'tbl_gamelist') {
                            $rsp =  $this->home->update(array('id' => $fData['id']), array('status' => $fData['status']), 'tbl_gamelist_all');
                        }

                        $rsp =  $this->home->update(array('id' => $fData['id']), array('status' => $fData['status']), $fData['tbl']);

                        if ($rsp) {
                            $result['status'] = 1;
                            $result['message'] = 'Game status updated Successfully!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "delGame":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['id']) || empty($fData['tbl'])) {
                        $result['status'] = 0;
                        $result['message'] = 'Id /n data is missing!';
                    } else {
                        $rsp =  $this->home->delete(array('id' => $fData['id']), $fData['tbl']);
                        if ($rsp) {
                            $result['status'] = 1;
                            $result['message'] = 'Game deleted Successfully!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "delOffer":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['id']) || empty($fData['tbl'])) {
                        $result['status'] = 0;
                        $result['message'] = 'Id /n data is missing!';
                    } else {
                        $rsp =  $this->home->delete(array('id' => $fData['id']), $fData['tbl']);
                        if ($rsp) {
                            $result['status'] = 1;
                            $result['message'] = 'Game deleted Successfully!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "addgameset":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['day'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Day Name is missing!';
                    } elseif (empty($fData['match_time'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Match time missing!';
                    } else {
                        //  get_game_cat_code
                        $cat_title = $this->home->getTitle('cat_title', array('cat_id' => $fData['cat_id']), 'tbl_game_catagory');
                        $fData['cat_title'] = !empty($cat_title) ? $cat_title : '';

                        $item_name = $this->home->getTitle('item_name', array('item_id' => $fData['item_id']), 'tbl_game_items');
                        $fData['item_name'] = !empty($item_name) ? $item_name : '';

                        $rsp = $this->addMatch($fData);
                        if ($rsp) {
                            $result['status'] = 1;
                            $result['message'] = 'Data insert Successfully!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "getGamesbyCat":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['cat_id'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Catagory id is missing!';
                    } else {
                        $rsp = $this->home->find(array('cat_id' => $fData['cat_id'], 'day' => date('l')), 'tbl_gamelist');
                        if ($rsp) {
                            $resVal = array();
                            foreach ($rsp->result() as $value) {
                                $resVal[] = array(
                                    'item_id' => $value->match_id,
                                    'item_name' => $value->game_title,
                                    'match_time' => $value->match_time
                                );
                            }
                            $result['status'] = 1;
                            $result['message'] = $resVal;
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "getItembyCat":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['cat_id'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Catagory id is missing!';
                    } else {
                        $rsp = $this->home->find(array('cat_id' => $fData['cat_id']), 'tbl_game_items');
                        if ($rsp) {
                            $resVal = array();
                            foreach ($rsp->result() as $value) {
                                $resVal[] = array(
                                    'item_id' => $value->item_id,
                                    'item_name' => $value->item_name
                                );
                            }
                            $result['status'] = 1;
                            $result['message'] = $resVal;
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Insert Error, Found same data!';
                        }
                    }
                    break;
                case "add_user_pass":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['mobile'])) {
                        $result['status'] = 1;
                        $result['message'] = 'User mobile is missing!';
                    } else {
                        $rsp = $this->home->find(array('mobile' => $fData['mobile']), 'tbl_login');
                        if ($rsp) {
                            $update_pass = $this->home->update(array('mobile' => $fData['mobile']), array('password' => $fData['password']), 'tbl_login');
                            $result['status'] = 0;
                            $result['message'] = !empty($update_pass) ? 'Update Successfully' : 'Update Error!';
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'Update Error, No User found!';
                        }
                    }
                    break;
                case "add_amount_update":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['mobile'])) {
                        $result['status'] = 1;
                        $result['message'] = 'User mobile is missing!';
                    } else {
                        $rsp = $this->home->find(array('mobile' => $fData['mobile']), 'tbl_wallet');
                        if ($rsp) {
                            $date = date('d-m-Y');
                            $insert_data = array(
                                'mobile' => $fData['mobile'],
                                'amount' => $fData['amount'],
                                'trtype' => $fData['trtype'],
                                'balance' => 0,
                                'trdetails' => 'admin_update',
                                'trno' => $this->RandS(19),
                                'date' => $date,
                                'time' => date('H:i')
                            );
                            //$insertdata = $this->home->insert_check_update(array('mobile' => $fData['mobile'], 'amount' => $fData['amount'], 'date' => $date), $insert_data, 'tbl_wallet');
                            $insertdata = $this->home->insert($insert_data, 'tbl_wallet');
                            $result['status'] = 0;
                            $result['message'] = !empty($insertdata) ? 'Update Successfully' : 'Update Error!';
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'Update Error, No User found!';
                        }
                    }
                    break;
                case "withdrawl_update":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['mobile'])) {
                        $result['status'] = 1;
                        $result['message'] = 'User mobile is missing!';
                    } else {
                        $utr_no = 'WTR' . rand(0000000, 9999999);
                        $rsp = $this->home->find(array('mobile' => $fData['mobile'], 'tr_no' => $utr_no), 'tbl_users_pymnt');
                        if (empty($rsp)) {
                            $date = date('d-m-Y');
                            $insert_data = array(
                                'mobile' => $fData['mobile'],
                                'amount' => $fData['amount'],
                                'pymnt_mode' => $fData['method'],
                                'remarks' => $fData['remarks'],
                                'status' => 0,
                                'tr_no' => $utr_no,
                                'date' => $date,
                                'time' => date('H:i')
                            );

                            $insertdata = $this->home->insert_check_update(array('mobile' => $fData['mobile'], 'amount' => $fData['amount'], 'date' => $date), $insert_data, 'tbl_users_pymnt');
                            //withdrawl request update
                            $updatedataWQ = $this->home->update(array('tr_no' => $fData['tr_no']), array('status' => 1, 'tr_no' => $utr_no), 'tbl_withdrawl_req');
                            // wallet update
                            $updatedataW = $this->home->update(array('trno' => $fData['tr_no']), array('trno' => $utr_no, 'trdetails' => 'withdrawl successful'), 'tbl_wallet');

                            $result['status'] = 0;
                            $result['message'] = !empty($updatedataW) ? 'Update Successfully' : 'Update Error!';
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'Withrawls already processed!';
                        }
                    }
                    break;
                case "deposite_update":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['mobile'])) {
                        $result['status'] = 1;
                        $result['message'] = 'User mobile is missing!';
                    } else {
                        $rsp = $this->home->find(array('mobile' => $fData['mobile'], 'trno' => $fData['trno']), 'tbl_deposit');
                        if ($rsp) {
                            $insert_data = array(
                                'mobile' => $fData['mobile'],
                                'amount' => $fData['amount'],
                                'trtype' => 'credit',
                                'trdetails' => 'offline cr',
                                'trno' => $fData['trno'],
                                'date' => date('d-m-Y'),
                                'time' => date('h:i'),
                            );
                            //store deposite history
                            $updatedataWQ = $this->home->insert_check(array('mobile' => $fData['mobile'], 'trno' => $fData['trno']), $rsp->row(), 'tbl_deposit_all');
                            //wallet update
                            $updatedataW = $this->home->insert_check(array('trno' => $fData['trno']), $insert_data, 'tbl_wallet');
                            //delete deposite
                            $deleteDP = $this->home->delete(array('id' => $rsp->row()->id), 'tbl_deposit');

                            $result['status'] = 0;
                            $result['message'] = !empty($updatedataW) ? 'Update Successfully' : 'Update Error!';
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'Withrawls already processed!';
                        }
                    }
                    break;
                case "CheckGameResult":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['match_id'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Game id is required!';
                    } else if (empty($fData['win_type'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Bet type is required!';
                    } else {
                        $findGame = $this->home->find(array('match_id' => $fData['match_id']), 'tbl_gamelist');
                        if ($findGame) {
                            // check sd
                            $sdcheck = $this->chkBets($findGame->row(), 'sd', $fData['win_digit'], 'SingleDigit');
                            $count_sdcheck = !empty($sdcheck) ? count($sdcheck) : null;
                            // check cp
                            $cpcheck = $this->chkBets($findGame->row(), 'cp', $fData['win_val'], 'cp');
                            $count_cpcheck = !empty($cpcheck) ? count($cpcheck) : null;
                            // check prime
                            $check = $this->chkBets($findGame->row(), $fData['win_type'], $fData['win_val'], $this->selector($fData['win_type']));
                            $count_check = !empty($check) ? count($check) : null;

                            $spcounter = ($fData['win_type'] == 'sp') ? $count_check : null;
                            $dpcounter = ($fData['win_type'] == 'dp') ? $count_check : null;
                            $tpcounter = ($fData['win_type'] == 'tp') ? $count_check : null;

                            $result['status'] = 0;
                            $result['message'] = array(
                                'count_sd_winners' => $count_sdcheck,
                                'count_cp_winners' => $count_cpcheck,
                                'count_jodi_winners' => '',
                                'count_sp_winners' => $spcounter,
                                'count_dp_winners' => $dpcounter,
                                'count_tp_winners' => $tpcounter,
                            );
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'Update Error!';
                        }
                    }
                    break;
                case "AddGameResult":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    if (empty($fData['match_id'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Game id is required!';
                    } else if (empty($fData['win_type'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Bet type is required!';
                    } else {
                        $cp_stat = 0;
                        $sd_stat = 0;
                        $prime_stat = 0;

                        $findGame = $this->home->find(array('match_id' => $fData['match_id']), 'tbl_gamelist');
                        if ($findGame) {
                            //add game Result List//
                            $gm_result_data = array(
                                'match_id' => $fData['match_id'],
                                'game_title' => $findGame->row()->game_title,
                                'cat_title' => $findGame->row()->cat_title,
                                'cat_id' => $findGame->row()->cat_id,
                                'digit' => $fData['win_digit'],
                                'patti' => $fData['win_val'],
                                'win_type' => $this->selector($fData['win_type']),
                                'month' => date('M'),
                                'date' => date('d-m-Y'),
                            );

                            $result['status'] = $gm_result_data;
                            $result_add = $this->home->insert_check(array('match_id' => $gm_result_data['match_id'], 'date' => date('d-m-Y'), 'win_type' => $gm_result_data['win_type']), $gm_result_data, 'tbl_results');

                            if ($result_add) {
                                // check Primary //
                                $primecheck = $this->chkBets($findGame->row(), $fData['win_type'], $fData['win_val'], $this->selector($fData['win_type']));
                                if (!empty($primecheck) && count($primecheck)) {
                                    $Update_prime_wins = $this->updateWinners($primecheck, $fData['match_id']);
                                    $prime_stat = $Update_prime_wins; // true
                                }
                                // check SD Final//
                                $sdcheck = $this->chkBets($findGame->row(), 'sd', $fData['win_digit'], 'SingleDigit');
                                if (!empty($sdcheck) && count($sdcheck)) {
                                    $Update_sd_wins = $this->updateWinners($sdcheck, $fData['match_id']);
                                    $sd_stat = $Update_sd_wins; // true
                                }
                                // check CP //
                                $cpcheck = $this->chkBets($findGame->row(), 'cp', $fData['win_val'], 'cp');
                                if (!empty($cpcheck) && count($cpcheck)) {
                                    $Update_cp_wins = $this->updateWinners($cpcheck, $fData['match_id']);
                                    $cp_stat = $Update_cp_wins; // true
                                }

                                if ($sd_stat == 0 && $prime_stat == 0) {
                                    $blank_win_data = array(
                                        'match_id' => $fData['match_id'],
                                        'cat_id' => $findGame->row()->cat_id,
                                        'game_id' => $findGame->row()->game_id,
                                        'win_val' => $fData['match_id'],
                                        'win_amnt' => 0,
                                        'win_type' => $this->selector($fData['win_type']),
                                        'date' => date('d-m-Y'),
                                        'time' => date('h:i'),
                                        'mobile' => '0000000000'
                                    );
                                    $insert_no_winner = $this->home->insert_check(array('match_id' => $fData['match_id'], 'date' => date('d-m-Y'), 'win_type' =>  $this->selector($fData['win_type'])), $blank_win_data, 'tbl_winnings');
                                    $prime_stat = 1;
                                }

                                $result['status'] = 0;
                                $result['message'] =  'Result Updated : SD-' . $sd_stat . ' CP-' . $cp_stat . ' PRIME-' . $prime_stat;
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
                case "pymntgear":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    foreach ($fData as $colname => $Value) {
                        if ($this->db->field_exists($colname, 'client_api_secret')) {
                            $resp = $this->home->insert_check_update(array($colname => $Value), array($colname => $Value), 'client_api_secret');
                            if ($resp) {
                                $result['status'] = 0;
                                $result['message'] = 'Update Successfull!';
                            } else {
                                $result['status'] = 1;
                                $result['message'] = 'Invalid Entry!';
                            }
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'Invalid Field!';
                        }
                    }
                    break;
                case "updatesetting":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }
                    $data = array(
                        'status' => !empty($fData['status'] == 0) ? 1 : 0,
                        'settings' => $fData['settings'],
                    );

                    $updateSettings = $this->home->update(array('settings' => $fData['settings'],), $data, 'meta_settings');
                    if ($updateSettings) {
                        $result['status'] = 0;
                        $result['message'] = 'Update Successfull!';
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'Update Field!';
                    }
                    break;

                case "metaupdate":
                    if ((array_key_exists('action', $fData)) !== false) {
                        unset($fData['action']);
                    }

                    $updateSettings = $this->home->update(array('title' => $fData['title']), $fData, 'meta_details');
                    if ($updateSettings) {
                        $result['status'] = 0;
                        $result['message'] = 'Update Successfull!';
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'Update Field!';
                    }

                    break;

                default:
                    $result['status'] = 0;
                    $result['message'] = 'Invalid action!';
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    public function updateWinners($params, $match_id)
    {

        $insert_winner = $this->db->insert_batch('tbl_winnings', $params);
        $walletdata = $this->make_winner_bal_new($params);
        //print_r($walletdata);
        $insert_winner_wallet = $this->db->insert_batch('tbl_wallet', $walletdata);
        return ($insert_winner) ? true : false;

        /*  if (count($params) == 1) {
            $insert_winner = $this->home->insert_check(array('match_id' => $match_id, 'date' => date('d-m-Y'), 'win_type' => $params[0]['win_type']), $params[0], 'tbl_winnings');
            $walletdata = $this->make_winner_bal($params);
            //  $insert_winner_wallet = $this->home->insert_check(array('trdetails' => $params[0]['win_type'] . '_win_amnt'), $walletdata, 'tbl_wallet');
            //return ($insert_winner_wallet) ? true : false;
        } else {
            $insert_winner = $this->home->insert_batch_check(array('match_id' => $match_id, 'date' => date('d-m-Y')), $params, 'tbl_winnings');
            $walletdata = $this->make_winner_bal($params);
            // $insert_winner_wallet = $this->home->insert_batch_check(array('trdetails' => $params[0]['win_type'] . '_win_amnt', 'date' => date('d-m-Y')), $walletdata, 'tbl_wallet');
            //  return ($insert_winner_wallet) ? true : false;
        } */
    }


    public function make_winner_bal_new($param)
    {
        //$arr = array();
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

        return $arr;
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
                    'win_amnt' => round($rowData->bet_amnt * ($setAmnt / 10)),
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

    public function addCatagory($data)
    {
        $count = $this->home->counter(array(), 'tbl_game_catagory');
        $dataArr = array(
            'cat_id' => 'FFGC' . (!empty($count) ? $count + 1 : '0'),
            'cat_title' => strtoupper($data['cat_name']),
            'cat_iurl' => $data['cat_iurl'],
            'status' => 0,
            'created_by' => 'admin'
        );
        $insertdata = $this->home->insert_check(array('cat_title' => strtoupper($data['cat_name'])), $dataArr, 'tbl_game_catagory');
        return $insertdata ? true : false;
    }

    public function addGameItem($data)
    {
        $count = $this->home->counter(array(), 'tbl_game_items');
        $dataArr = array(
            'item_id' => 'FFGCID' . (!empty($count) ? $count + 1 : '0'),
            'item_name' => strtoupper($data['item_name']),
            'cat_id' => $data['cat_id'],
            'status' => 0,
            'created_by' => 'admin'
        );
        $insertdata = $this->home->insert_check(array('item_name' => strtoupper($data['item_name'])), $dataArr, 'tbl_game_items');
        return $insertdata ? true : false;
    }

    public function addMatch($params)
    {

        $getlastid = $this->home->last_id(array(''), 'tbl_gamelist');
        if ($getlastid) {
            $count = $getlastid;
        } else {
            $count = $this->home->counter(array(), 'tbl_gamelist');
        }


        $match_id = 'FFLV' . (!empty($count) ? $count + 1 : '0');
        $data = array(
            'match_id' => $match_id,
            'match_time' => $params['match_time'],
            'day' => $params['day'],
            'game_title' => $params['item_name'],
            'game_id' => $params['item_id'],
            'cat_title' => $params['cat_title'],
            'cat_id' => $params['cat_id'],
            'status' => 0,
            'created_by' => 'admin',
        );

        $insertdata = $this->home->insert_check(array('day' => $params['day'], 'match_time' => $params['match_time']), $data, 'tbl_gamelist');
        $insertdata = $this->home->insert_check(array('day' => $params['day'], 'match_time' => $params['match_time']), $data, 'tbl_gamelist_all');
        return $insertdata ? true : false;
    }

    public function getRatio()
    {
        $result = array();
        $cat_id = $this->input->post('cat_id');

        if (empty($cat_id)) {
            $result['status'] = 1;
            $result['message'] = 'Catagory id is missing!';
        } else {
            $rsp = $this->home->find(array('cat_id' => $cat_id), 'tbl_market_ration');
            if ($rsp) {
                $result['status'] = 1;
                $result['message'] = $rsp->row();
            } else {
                $result['status'] = 0;
                $result['message'] = 'Insert Error, Found same data!';
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
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

    function upload_image($param, $path)
    {
        if (isset($_FILES[$param])) {
            $extension = explode('.', $_FILES[$param]['name']);
            $new_name = rand() . '.' . $extension[1];
            $destination = $path . $new_name;
            move_uploaded_file($_FILES[$param]['tmp_name'], $destination);
            return $new_name;
        } else {
            return false;
        }
    }

    public function storeDigits()
    {
        $betType = $this->input->post('betType');
        $betVal = $this->input->post('betVal');
        $betVal = array_filter(array_unique($betVal, SORT_NUMERIC));
        $nbv = array();
        $result = array();
        $resp = false;
        if (empty($betType)) {
            $result['status'] = 0;
            $result['message'] = 'Bet Type missing!';
        } else {
            foreach ($betVal as $value) {
                $nbv = array(
                    'digit_type' => $betType,
                    'digits' => $value,
                );
                $resp = $this->home->insert_check_update($nbv, $nbv, 'tbl_digits') ? true : false;
            }
            if ($resp) {
                $result['status'] = 1;
                $result['message'] = 'Data Added Successfully!';
            } else {
                $result['status'] = 0;
                $result['message'] = 'Insert Error, Found same data!';
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}