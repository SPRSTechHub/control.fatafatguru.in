<?
date_default_timezone_set('Asia/Kolkata');
class Api extends CI_Controller
{
    protected $authchecker = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model("Api_model", "api");
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

    public function index()
    {
        $result = array();
        $data = $this->input->post();
        if (empty($data['action'])) {
            $result['status'] = '1';
            $result['message'] = 'No action decided yet!';
        } else {
            switch ($data['action']) {
                case "signup":
                    $this->checkPermission('adduser');
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $AddNewUser = $this->addNewUser($data);
                    if ($AddNewUser == 0) {
                        //createWallet
                        $chkNewUser = $this->api->find(array('mobile' => $data['mobile']), 'tbl_wallet');
                        if (empty($chkNewUser)) {
                            $walletData =  array(
                                'mobile' => $data['mobile'],
                                'amount' => 0,
                                'trtype' => 'credit',
                                'balance' => 0,
                                'trno' => $this->RandS(6),
                                'trdetails' => 'op wallet',
                                'date' => date('d-m-Y'),
                                'time' => date('h:s'),
                            );
                            $createWallet = $this->api->insert($walletData, 'tbl_wallet');
                        }
                        //add refferals
                        $addRef = $this->addRefferal($data);

                        //add Notif
                        $this->home->addNotify(array(
                            'notif' => 'signup',
                            'notif_type' => 'New user just signed up!',
                            'date' => date('d-m-Y'),
                            'time' => date('h:m'),
                        ));

                        $result['status'] = 0;
                        $result['message'] = 'Registration Successfully';
                    } elseif ($AddNewUser == 3) {
                        $result['status'] = 1;
                        $result['message'] = 'User Exists';
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'Database Error';
                    }
                    break;
                case "login":
                    $this->checkPermission('logincheck');
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $checkLogin = $this->checkLogin($data);
                    if ($checkLogin == 0) {
                        $result['status'] = 0;
                        $result['message'] = 'User Login Successfully';
                        $result['result'] = $this->getprofile($data);
                        //add Notif
                        $this->home->addNotify(array(
                            'notif' => 'login',
                            'notif_type' => 'Someone just logged in!',
                            'date' => date('d-m-Y'),
                            'time' => date('h:m'),
                        ));
                    } elseif ($checkLogin == 3) {
                        $result['status'] = 1;
                        $result['message'] = 'User is blocked by Admin!';
                    } elseif ($checkLogin == 2) {
                        $result['status'] = 1;
                        $result['message'] = 'Invalid Password';
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'User not Exist';
                    }
                    break;
                case "get_user":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $User = $this->getUserDetails($data);

                    if ($User == true) {
                        $result['status'] = 0;
                        $result['message'] = 'User Fetched Successfully';
                        $result['result'] = $User;
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'User not Exist';
                    }
                    break;
                case "game_cat":
                    $this->checkPermission('fetchgames');
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    if ((array_key_exists('day', $data)) == false) {
                        $result['status'] = 1;
                        $result['message'] = 'Day is undefined!';
                    } else {
                        $getGameCatagory = $this->getGameCatagory($data);

                        if ($getGameCatagory == 1) {
                            $result['status'] = 1;
                            $result['message'] = 'There are no Game!';
                        } elseif ($getGameCatagory == 3) {
                            $result['status'] = 1;
                            $result['message'] = 'Day is missing...!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = $getGameCatagory;
                        }
                    }
                    break;
                case "game_list":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    if ((array_key_exists('day', $data)) == false || (array_key_exists('cat_id', $data)) == false) {
                        $result['status'] = 1;
                        $result['message'] = 'Some fields are misssing!';
                    } else if ((array_key_exists('action', $data)) !== false) {
                    } else {
                        $getGameList = $this->getGameList($data);
                        if ($getGameList == 3) {
                            $result['status'] = 1;
                            $result['message'] = 'Some fields value are not presents!';
                        } elseif ($getGameList == 1) {
                            $result['status'] = 1;
                            $result['message'] = 'Fetch data error!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Game Fetch successfully';
                            $result['result'] = $getGameList;
                        }
                    }
                    break;
                case "betplace":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    if ((array_key_exists('matchId', $data)) == false || (array_key_exists('betType', $data)) == false) {
                        $result['status'] = 1;
                        $result['message'] = 'Some fields are misssing!';
                    } else {
                        $chkDigits = $this->api->find(array('digits' => $data['betVal'], 'digit_type' => $data['betType']), 'tbl_digits');
                        if ($data['betAmnt'] < 1) {
                            $result['status'] = 1;
                            $result['message'] = 'Minimum Bet Amount Rs. 1';
                        } else {
                            if ($chkDigits) {
                                // check game exists and live
                                $checkGameStat = $this->api->find(array('match_id' => $data['matchId']), 'tbl_gamelist');
                                if ($checkGameStat) {
                                    $cTime = date("H:i");
                                    $match_time = $checkGameStat->row()->match_time;
                                    $lastBetTime = $this->api->get_meta('last_bet_time');
                                    $lastBetTime =  $lastBetTime ? $lastBetTime : '05';
                                    $lbtime = date("H:i", strtotime($match_time) - (strtotime('00:' . $lastBetTime . ':00') - strtotime("00:00:00")));
                                    // checking currtime with lbtime
                                    if ($cTime >= $lbtime) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Time Over! Place bet before 2 Minutes of Match Start';
                                    } else {
                                        //$result['status'] = 1;
                                        //$result['message'] = 'Incorrect bet!';

                                        $data['catId'] = $checkGameStat->row()->cat_id;
                                        $data['game_title'] = $checkGameStat->row()->game_title;
                                        $data['gameId'] = $checkGameStat->row()->game_id;
                                        $placeBets = $this->placeBets($data);

                                        if ($placeBets['status'] == 0) {
                                            $result['status'] = 0;
                                            $result['message'] = $placeBets['val'];
                                            $result['data'] = array('amount' => $this->getBalance($data['mobile']));

                                            //add Notif
                                            $this->home->addNotify(array(
                                                'notif' => 'placed a bet',
                                                'notif_type' => 'Bet has been placed by ' . $data['mobile'],
                                                'date' => date('d-m-Y'),
                                                'time' => date('h:m'),
                                            ));
                                        } else if ($placeBets['status'] == 4) {
                                            $result['status'] = 1;
                                            $result['message'] = $placeBets['val'];
                                        } else {
                                            $result['status'] = 1;
                                            $result['message'] = 'Bet placement failed!';
                                        }
                                    }
                                } else {
                                    $result['status'] = 1;
                                    $result['message'] = 'This Game is not present!';
                                }
                            } else {
                                $result['status'] = 1;
                                $result['message'] = 'Incorrect bet placement!';
                            }
                        }
                    }
                    break;
                case "jodiplace":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $this->checkPermission('jodibet');
                    if ((array_key_exists('matchId1', $data)) == false || (array_key_exists('betVal1', $data)) == false) {
                        $result['status'] = 1;
                        $result['message'] = 'Some fields are misssing!';
                    } else if ((array_key_exists('matchId2', $data)) == false || (array_key_exists('betVal2', $data)) == false) {
                        $result['status'] = 1;
                        $result['message'] = 'Some fields are misssing!';
                    } else {

                        // check game exists and live
                        $checkGameStat = $this->api->find(array('match_id' => $data['matchId1'], 'day' => $data['day']), 'tbl_gamelist');
                        $checkGameStat2 = $this->api->find(array('match_id' => $data['matchId2'], 'day' => $data['day']), 'tbl_gamelist');
                        if ($checkGameStat && $checkGameStat2) {
                            $cTime = date("H:i");
                            $match_time = $checkGameStat->row()->match_time;
                            $lastBetTime = $this->api->get_meta('last_bet_time');
                            $lastBetTime =  $lastBetTime ? $lastBetTime : '05';
                            $lbtime = date("H:i", strtotime($match_time) - (strtotime('00:' . $lastBetTime . ':00') - strtotime("00:00:00")));
                            // checking currtime with lbtime
                            if ($cTime >= $lbtime) {

                                $placeBets = $this->placeJodiBets($data);

                                if ($placeBets['status'] == 0) {
                                    $result['status'] = 0;
                                    $result['message'] = $placeBets['val'];
                                    $result['data'] = array('amount' => $this->getBalance($data['mobile']));
                                } else if ($placeBets['status'] == 4) {
                                    $result['status'] = 1;
                                    $result['message'] = $placeBets;
                                } else {
                                    $result['status'] = 1;
                                    $result['message'] = 'Bet placement failed!';
                                }
                            } else {
                                $result['status'] = 1;
                                $result['message'] = 'Sorry, Time Over!';
                            }
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'This Game is not present!';
                        }
                    }
                    break;
                case "bet_history":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $arrKeys = array('mobile', 'sortBy', 'sortTo', 'lstart', 'lend');
                    foreach ($arrKeys as $key) {
                        if ((array_key_exists($key, $data)) !== true) {
                            $result = array();
                            $result['status'] = 1;
                            $result['message'] = 'parameter missing!' . $key;
                            echo json_encode($result, JSON_PRETTY_PRINT);
                            exit;
                        }
                    }
                    $search_arr = array();
                    if (!empty($data['searchKey']) && $data['searchKey'] != null) {
                        switch (trim($data['searchKey'])) {
                            case "SD":
                                $search_arr['bet_type'] = 'SingleDigit';
                                break;
                            case "SP":
                                $search_arr['bet_type'] = 'SinglePanna';
                                break;
                            case "DP":
                                $search_arr['bet_type'] = 'DoublePanna';
                                break;
                            case "TP":
                                $search_arr['bet_type'] = 'TripplePanna';
                                break;
                            case "CP":
                                $search_arr['bet_type'] = 'cp';
                                break;
                            case "JODI":
                                $search_arr['bet_type'] = 'jodi';
                                break;
                            default:
                                $response['status'] = 2;
                                $response['message'] = 'Filter error!';
                        }
                        $filterSearch = array_merge(array('mobile' => $data['mobile'], 'cat_id' => $data['catId']), $search_arr);
                        $getBets = $this->api->findWithFilter(
                            $filterSearch,
                            array('sortBy' => 'id', 'sortTo' => 'desc'),
                            array('lstart' => $data['lstart'] ? $data['lstart'] : '20', 'lend' => $data['lend'] ? $data['lend'] : '0'),
                            'tbl_bets'
                        );
                        /*   $getBets = $this->api->findWithFilter(
                            $filterSearch,
                            array('sortBy' => $data['sortBy'] ? $data['sortBy'] : 'id', 'sortTo' => $data['sortTo'] ? $data['sortTo'] : 'desc'),
                            array('lstart' => $data['lstart'] ? $data['lstart'] : '25', 'lend' => $data['lend'] ? $data['lend'] : '0'),
                            'tbl_bets'
                        ); */
                    } else {
                        $getBets = $this->api->findWithFilter(
                            array('mobile' => $data['mobile'], 'cat_id' => $data['catId']),
                            array('sortBy' => $data['sortBy'] ? $data['sortBy'] : 'id', 'sortTo' => $data['sortTo'] ? $data['sortTo'] : 'desc'),
                            array('lstart' => $data['lstart'] ? $data['lstart'] : '25', 'lend' => $data['lend'] ? $data['lend'] : '25'),
                            'tbl_bets'
                        );
                    }

                    $resp = array();
                    if ($getBets) {
                        foreach ($getBets->result() as $key => $value) {
                            $game = $this->api->find_field('item_name', array('item_id' => $value->game_id), 'tbl_game_items');
                            $game = !empty($game) ? $game : 'No Title';
                            $resp[] = array(
                                'date' => $value->date,
                                'game' => $game,
                                'time' => $value->time,
                                'patti' => $value->bet_type,
                                'digit' => $value->bet_val,
                                'amount' => $value->bet_amnt,
                            );
                        }
                        $result['status'] = 0;
                        $result['data'] = $resp;
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No results found!';
                    }
                    break;
                case "win_result":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $arrKeys = array('mobile', 'catId', 'sortBy', 'sortTo', 'lstart', 'lend');
                    foreach ($arrKeys as $key) {
                        if ((array_key_exists($key, $data)) !== true) {
                            $result = array();
                            $result['status'] = 1;
                            $result['message'] = 'parameter missing!' . $key;
                            echo json_encode($result, JSON_PRETTY_PRINT);
                            exit;
                        }
                    }
                    $Winings = $this->getWinings($data);
                    if ($Winings['status'] == 1) {
                        $result['status'] = 0;
                        $result['message'] = 'No Data found!';
                        $result['data'] = null;
                    } elseif ($Winings['status'] == 2) {
                        $result['status'] = 1;
                        $result['message'] = $Winings['message'];
                        $result['data'] = null;
                    } else {
                        $result['status'] = 0;
                        $result['message'] = $Winings['message'];
                        $result['data'] = $Winings['data'];
                        //add Notif
                        $this->home->addNotify(array(
                            'notif' => 'Results',
                            'notif_type' => 'Admin updated result',
                            'date' => date('d-m-Y'),
                            'time' => date('h:m'),
                        ));
                    }

                    break;
                case "forget_pass":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $get_pass = $this->api->find(array('mobile' => $data['mobile']), 'tbl_login');
                    if ($get_pass) {
                        $result['status'] = 0;
                        $result['message'] = 'User found';
                        $result['data'] = array('rtv_password' => $get_pass->row()->password);
                        //add Notif
                        $this->home->addNotify(array(
                            'notif' => 'reset pass',
                            'notif_type' => 'Password reset request placed by' . $data['mobile'],
                            'date' => date('d-m-Y'),
                            'time' => date('h:m'),
                        ));
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'User not found!';
                    }

                    break;
                case "get_offers":

                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $alloffers = $this->getoffers($data);
                    if ($alloffers) {
                        $result['status'] = 0;
                        $result['message'] = 'Fetch Successfully';
                        $result['result'] = $alloffers;
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No Valid Offer';
                        $result['result'] = null;
                    }
                    break;

                case "get_depo_offers":

                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $alloffers = $this->getPayMethod($data);
                    if ($alloffers) {
                        $result['status'] = 0;
                        $result['message'] = 'Fetch Successfully';
                        $result['result'] = $alloffers;
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No Valid Offer';
                        $result['result'] = null;
                    }
                    break;

                case "add_money":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $this->checkPermission('addmoneyoffline');
                    $minAmnt = $this->api->get_meta('min_depo_amnt');
                    $minAmnt = $minAmnt ? $minAmnt : '0';
                    if ($data['amount'] < $minAmnt) {
                        $result['status'] = 1;
                        $result['message'] = 'Minimum Amount should be Rs. ' . $minAmnt . '!';
                    } else {
                        $paramDpst = array(
                            'date' => date('d-m-Y'),
                            'mobile' => $data['mobile'],
                            'trdetails' => 'offline',
                            'amount' => $data['amount'],
                            'trtype' => 'credit',
                            'trno' => $data['trno'],
                        );
                        $Exister = $this->api->Exister(array('mobile' => $data['mobile'], 'trno' => $data['trno'], 'status' => 1), 'tbl_deposit');
                        if ($Exister) {
                            $result['status'] = 1;
                            $result['message'] = 'Try again later!';
                        } else {
                            $ExisterCount = $this->api->get_count_filter(array('mobile' => $data['mobile'], 'date' => date('d-m-Y'), 'status' => 1), 'tbl_deposit');

                            if ($ExisterCount) {
                                if ($ExisterCount >= 3) {
                                    $this->api->Update(array('mobile' => $data['mobile']), array('status' => 1), 'tbl_users');
                                    $result['status'] = 1;
                                    $result['message'] = 'Limit exeecded more than 3 times, deposite blocked!';
                                } else {
                                    $addDeposite = $this->api->insert($paramDpst, 'tbl_deposit');
                                    if ($addDeposite) {
                                        $result['status'] = 0;
                                        $result['message'] = 'Wallet update Successfully';
                                        //add Notif
                                        $this->home->addNotify(array(
                                            'notif' => 'addMoney',
                                            'notif_type' => 'OFD Money added by ' . $data['mobile'],
                                            'date' => date('d-m-Y'),
                                            'time' => date('h:m'),
                                        ));
                                    } else {
                                        $result['status'] = 1;
                                        $result['message'] = 'Try again later please!';
                                    }
                                }
                            } else {
                                $addDeposite = $this->api->insert($paramDpst, 'tbl_deposit');
                                if ($addDeposite) {
                                    $result['status'] = 0;
                                    $result['message'] = 'Wallet update Successfully';
                                    //add Notif
                                    $this->home->addNotify(array(
                                        'notif' => 'addMoney',
                                        'notif_type' => 'OFD Money added by ' . $data['mobile'],
                                        'date' => date('d-m-Y'),
                                        'time' => date('h:m'),
                                    ));
                                } else {
                                    $result['status'] = 1;
                                    $result['message'] = 'Try again later please!';
                                }
                            }
                        }
                        /*  $addMoneytoWallet = $this->addwallet($data);
                        if ($addMoneytoWallet == 3) {
                            $result['status'] = 1;
                            $result['message'] = 'Some fields value are not presents!';
                        } elseif ($addMoneytoWallet == 1) {
                            $result['status'] = 1;
                            $result['message'] = 'Amount update failed!';
                        } else {
                            $result['status'] = 0;
                            $result['message'] = 'Wallet update Successfully';
                            //add Notif
                            $this->home->addNotify(array(
                                'notif' => 'addMoney',
                                'notif_type' => 'OFD Money added by ' . $data['mobile'],
                                'date' => date('d-m-Y'),
                                'time' => date('h:m'),
                            ));
                        } */
                    }

                    break;
                case "add_money_ct":

                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $this->checkPermission('addmoneyonline');

                    $pmgateway = $data['pmgateway']; // upiapi
                    $minAmnt = $this->api->get_meta('min_depo_amnt');
                    $minAmnt = $minAmnt ? $minAmnt : '0';
                    if (!empty($pmgateway == 'upiapi') && !empty($data['mobile'])) {
                        $getUser = $this->api->find(array('mobile' => $data['mobile']), 'tbl_users');
                        if ($getUser) {
                            $User = $getUser->row();
                            $getapi = $this->getAccessClient('BMTECH243');
                            if ($getapi) {
                                if ($getapi->status == 1) {
                                    $CallBackUrl = !empty($getapi->client_cb_url) ? $getapi->client_cb_url : null;
                                    $Apitoken = !empty($getapi->api_key) ? $getapi->api_key : null;
                                    $pgData = array(
                                        'Apitoken' => $Apitoken,
                                        'url' => 'https://upiapi.in/order/create',
                                        'orderId' => 'ORDR' . $this->RandS(8),
                                        'txnAmount' => $data['amount'],
                                        'txnNote' => 'OD',
                                        'customerName' => $User->fullname,
                                        'customerEmail' => $User->mobile . '@gmail.com',
                                        'customerMobile' => $User->mobile,
                                        'callbackUrl' => $CallBackUrl,
                                    );
                                    //print_r($pgData);
                                } else {
                                    $result['status'] = 1;
                                    $result['message'] = 'Gateway Api error!';
                                }
                            } else {
                                $result['status'] = 1;
                                $result['message'] = 'Auth Gateway error!';
                            }

                            $runPgCurl = $this->runCurler($pgData);
                            $runPgCurl = json_decode($runPgCurl);
                            if ($data['amount'] < $minAmnt) {
                                $result['status'] = 1;
                                $result['message'] = 'Minimum Amount should be Rs. ' . $minAmnt . '!';
                            } else {
                                if ($runPgCurl->status == true) {

                                    $ord_data = array(
                                        'mobile' => $data['mobile'],
                                        'date' => date('d-m-Y'),
                                        'time' => date('H:i'),
                                        'amount' => $data['amount'],
                                        'ord_type' => 'online',
                                        'ord_id' => $runPgCurl->result->orderId,
                                        'ord_url' => $runPgCurl->result->payment_url,
                                        'ord_status' => 'Pending',
                                        'msg' => 'upiapi pmtgty',
                                    );

                                    $insertOrd = $this->api->Insert($ord_data, 'payment_req_tbl');

                                    if ($insertOrd) {
                                        $result['status'] = 0;
                                        $result['message'] = 'Order genereated!';
                                        $result['data'] = $runPgCurl->result;
                                    } else {
                                        $result['status'] = 0;
                                        $result['message'] = 'Order genereated!';
                                        $result['data'] = $runPgCurl->result;
                                    }
                                } else {
                                    $result['status'] = 1;
                                    $result['message'] = 'Api Gateway Error!' . $runPgCurl->message;
                                }
                            }
                        } else {
                            $result['status'] = 1;
                            $result['message'] = 'User not found!';
                        }
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No Gateway selected!';
                    }
                    break;

                case "add_withdraw":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $this->checkPermission('addwithdrawl');
                    $arrKeys = array('mobile', 'amount', 'upi');
                    foreach ($arrKeys as $key) {
                        if ((array_key_exists($key, $data)) !== true) {
                            $result = array();
                            $result['status'] = 1;
                            $result['message'] = 'parameter missing!' . $key;
                            echo json_encode($result, JSON_PRETTY_PRINT);
                            exit;
                        }
                    }
                    $minAmnt = $this->api->get_meta('min_wthdrw_amnt');

                    if ($minAmnt) {
                        if ($data['amount'] < $minAmnt) {
                            $result['status'] = 1;
                            $result['message'] = 'Minimum withdrawlable amount Rs.500';
                        } else {
                            $addWithdraw_req = $this->addWithdraw($data);
                            if ($addWithdraw_req = 3) {
                                $result['status'] = 1;
                                $result['message'] = 'Try Again Tomorrow!';
                            } elseif ($addWithdraw_req = 1) {
                                $result['status'] = 1;
                                $result['message'] = 'Request failed!';
                            } else {
                                $result['status'] = 1;
                                $result['message'] = 'Request is in Process';
                            }
                        }
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'Server Error...notset!';
                    }

                    break;

                case "balance_chk":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    //$this->checkPermission('addmoney');
                    $BalanceChecker = $this->getBalance($data['mobile']);
                    if ($BalanceChecker) {
                        $result['status'] = 0;
                        $result['message'] = 'Balance Found!';
                        $result['data'] = array('amount' => $BalanceChecker);
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No balance found!';
                    }

                    break;
                case "add_bank":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $this->checkPermission('addnewbank');
                    $addBank = $this->addBank($data);
                    if ($addBank == 3) {
                        $result['status'] = 1;
                        $result['message'] = 'Details already in the system!';
                    } elseif ($addBank == 1) {
                        $result['status'] = 1;
                        $result['message'] = 'Store data failed!';
                    } else {
                        $result['status'] = 0;
                        $result['message'] = 'Bank added successfully';
                    }
                    break;
                case "add_upi":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $this->checkPermission('addnewupi');
                    $addBank = $this->addUpi($data);
                    if ($addBank == 3) {
                        $result['status'] = 1;
                        $result['message'] = 'Details already in the system!';
                    } elseif ($addBank == 1) {
                        $result['status'] = 1;
                        $result['message'] = 'Store data failed!';
                    } else {
                        $result['status'] = 0;
                        $result['message'] = 'UPI added successfully';
                    }

                    break;
                case "trans_history":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }

                    $arrKeys = array('mobile', 'sortBy', 'sortTo', 'lstart', 'lend');

                    foreach ($arrKeys as $key) {
                        if ((array_key_exists($key, $data)) !== true) {
                            $result = array();
                            $result['status'] = 1;
                            $result['message'] = 'parameter missing!' . $key;
                            echo json_encode($result, JSON_PRETTY_PRINT);
                            exit;
                        }
                    }

                    $showData = $this->getWalletHistory($data);
                    if ($showData['status'] == 0) {
                        $result['status'] = 0;
                        $result['message'] = 'Data Fetched Successfully';
                        $result['data'] = $showData['data'];
                    } elseif ($showData['status'] == 3) {
                        $result['status'] = 1;
                        $result['message'] = 'No data found!';
                        $result['data'] = null;
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No data found!';
                        $result['data'] = null;
                    }

                    break;

                case "market_ratio":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $arrKeys = array('cat_id');
                    foreach ($arrKeys as $key) {
                        if ((array_key_exists($key, $data)) !== true) {
                            $result = array();
                            $result['status'] = 1;
                            $result['message'] = 'parameter missing!' . $key;
                            echo json_encode($result, JSON_PRETTY_PRINT);
                            exit;
                        }
                    }
                    $showData = $this->api->find(array('cat_id' => $data['cat_id']), 'tbl_market_ration');
                    if ($showData) {
                        $result['status'] = 0;
                        $result['message'] = 'Data Fetched Successfully';
                        $result['data'] = $showData->row();
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No data found!';
                        $result['data'] = null;
                    }
                    break;
                case "win_result_all":
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    if (empty($data['mobile'])) {
                        $result['status'] = 1;
                        $result['message'] = 'You are not autherized to see result chart';
                        $result['data'] = null;
                    } else {
                        $result['status'] = 0;
                        $result['message'] = ''; //'Data Fetched Successfully';
                        $result['data'] = 'https://control.fatafatguru.in/results/';
                    }
                    /*     $showData = $this->api->find(array('cat_id' => $data['cat_id']), 'tbl_market_ration');
                    if ($showData) {
                        $result['status'] = 0;
                        $result['message'] = 'Data Fetched Successfully';
                        $result['data'] = $showData->row();
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'No data found!';
                        $result['data'] = null;
                    } */
                    break;
                case "getapplink":
                    $this->checkPermission('appdownload');
                    if ((array_key_exists('action', $data)) !== false) {
                        unset($data['action']);
                    }
                    $getApp = $this->api->get_meta('app_link');

                    if ($getApp) {
                        $result['status'] = 0;
                        $result['message'] = 'Registration Successfully';
                        $result['data'] = $getApp;
                    } else {
                        $result['status'] = 1;
                        $result['message'] = 'Opps... App is not ready yet. Try Again later!';
                    }
                    break;
                default:
                    $result['status'] = 1;
                    $result['message'] = 'Invalid action!';
            }
        }
        echo json_encode($result, JSON_PRETTY_PRINT);
    }

    //add_user
    function addNewUser($params)
    {
        $signup_data = array(
            'userid' => $params['mobile'],
            'fullname' => $params['fullname'],
            'mobile' => $params['mobile'],
            'refer_id' => strtoupper('SP' . $this->RandS(4) . substr($params['mobile'], 4, 4)),
            'status' => 0,
        );

        $login_data = array(
            'fcm' => $params['fcm'] ?? Null,
            'mobile' => $params['mobile'],
            /*'password' => MD5($params['password']),*/
            'password' => $params['password'],
            'status' => 0,
        );

        $checkUser = $this->api->Exister(array('mobile' => $params['mobile']), 'tbl_login');

        if ($checkUser) {
            return 3;
        } else {
            $insertUser = $this->api->Insert($signup_data, 'tbl_users');
            if ($insertUser) {
                $insertLogin = $this->api->Insert($login_data, 'tbl_login');
                return $insertLogin ? 0 : 1;
            } else {
                return 1;
            }
        }
    }

    public function addRefferal($params)
    {
        $this->checkPermission('referral');
        if (empty($params['refer_id'])) {
            return false;
        } else {
            $searchid = $this->api->find(array('refer_id' => $params['refer_id']), 'tbl_users');
            $rf_amnt = $this->api->get_meta('rfr_join_amount');

            if (empty($searchid)) {
                return false;
            } else {
                $rf_data = array(
                    'userid' => $params['mobile'],
                    'refer_id' => $params['refer_id'],
                    'refer_no' => $searchid ? $searchid->row()->mobile : NULL,
                    'date' => date('d-m-Y'),
                    'refer_amount' => $rf_amnt ? $rf_amnt : 0,
                    'rfr_amnt_type' => 'rfr_join_amnt',
                    'refer_status' => 1,
                );
                $Insert = $this->api->insert_check(array('userid' => $params['mobile']), $rf_data, 'tbl_referal');

                //add refferel amount
                $wltdata = array(
                    'mobile' => $searchid ? $searchid->row()->mobile : NULL,
                    'amount' =>  $rf_amnt ? $rf_amnt : 0,
                    'trtype' => 'credit',
                    'balance' => 0,
                    'trdetails' => 'Reff Bonus',
                    'trno' => $this->RandS(6),
                );

                $this->addwallet($wltdata);
                //add Notif
                $this->home->addNotify(array(
                    'notif' => 'addMoney',
                    'notif_type' => 'Ref Money Added ' . $params['mobile'],
                    'date' => date('d-m-Y'),
                    'time' => date('h:m'),
                ));


                return $Insert ? true : false;
            }
        }
    }

    function checkLogin($params)
    {
        $login_credentials = array(
            'mobile' => $params['mobile'],
            'password' => $params['password'],
        );

        $checkUser = $this->api->Exister(array('mobile' => $params['mobile']), 'tbl_login');
        if ($checkUser) {
            $checkPass = $this->api->find($login_credentials, 'tbl_login');
            if ($checkPass) {
                return $checkPass->row()->status == 0 ? 0 : 3;
            } else {
                return 2;
            }
        } else {
            return 1;
        }
    }

    function getoffers($data)
    {
        $resData = array();
        if (!empty($data['mobile'])) {
            $fetchData1 = $this->api->find(array('mobile' => $data['mobile'], 'status' => 1), 'tbl_offer');
            $fetchData2 = $this->api->find(array('mobile =' => NULL, 'status' => 1), 'tbl_offer');
        } else {
            return null;
        }

        if ($fetchData1) {
            foreach ($fetchData1->result() as $key => $value) {
                $resData[] = array(
                    'offer_link' => base_url() . '/uploads/offers/' . $value->offer_url
                );
            }
        }

        if ($fetchData2) {
            foreach ($fetchData2->result() as $key => $value) {
                $resData[] = array(
                    'offer_link' => base_url() . '/uploads/offers/' . $value->offer_url
                );
            }
        }
        return $resData ? $resData : null;
    }

    function getPayMethod($data)
    {
        $resData = array();
        if (!empty($data['mobile'])) {
            $fetchData1 = $this->api->find(array('mobile' => $data['mobile'], 'status' => 1), 'tbl_pay_qr');
            $fetchData2 = $this->api->find(array('mobile =' => NULL, 'status' => 1), 'tbl_pay_qr');
        } else {
            return null;
        }

        if ($fetchData1) {
            foreach ($fetchData1->result() as $key => $value) {
                $resData[] = array(
                    'offer_link' => base_url() . '/uploads/payqr/' . $value->offer_url
                );
            }
        }

        if ($fetchData2) {
            foreach ($fetchData2->result() as $key => $value) {
                $resData[] = array(
                    'offer_link' => base_url() . '/uploads/payqr/' . $value->offer_url
                );
            }
        }
        return $resData ? $resData : null;
    }

    function getprofile($data)
    {
        // $result = array();
        $fetchUserDetails = $this->api->find(array('mobile' => $data['mobile']), 'tbl_users');
        if ($fetchUserDetails) {
            foreach ($fetchUserDetails->result() as $key => $value) {
                $userdetails = array(
                    'mobile' => $value->mobile,
                    'userid' => $value->userid,
                    'status' => $value->status,
                );
            }

            //addwallet($data)
            //$userdetails = array('wee' => 'here', 'waee' => 'hersse', 'www' => 'ssadsad');
            $bal_fetch = $this->getBalance($data['mobile']);
            $userwallet = array('data' => 'here', 'bal' => $bal_fetch, 'imgurl' => 'https://sprsgroup.in/abc.png');

            //$withdraw = array('mobile' => '1234567890', 'upi' => 'abc@upi');

            $result = array_merge($userdetails, $userwallet);
            return $result;
        } else {
            return null;
        }
    }

    public function getUserDetails($data)
    {
        $result = array();
        if ($data['mobile']) {
            $fetch = $this->api->find(array('mobile' => $data['mobile']), 'tbl_users');
            if ($fetch) {
                foreach ($fetch->result() as $value) {
                    $result['profile'] = array(
                        'mobile' => $value->mobile,
                        'userid' => $value->userid,
                        'refer_id' => $value->refer_id,
                        'imgurl' => 'https://sprsgroup.in/abc.png'
                    );
                }
                //fetch referrals
                $ref_fetch = $this->api->find(array('refer_no' => $data['mobile']), 'tbl_referal');
                if ($ref_fetch) {
                    $result['reffers'] = array(
                        'refer_id' =>  $result['profile']['refer_id'],
                        'rf_amount' => $this->api->get_filter_bal('refer_amount', array('refer_no' => $data['mobile']), 'tbl_referal'),
                        'active_rfr' => $this->api->get_count_filter(array('refer_no' => $data['mobile'], 'rfr_amnt_type' => 'rfr_dpst_amnt'), 'tbl_referal'),
                        'total_rfr' => $this->api->get_count_filter(array('refer_no' => $data['mobile']), 'tbl_referal'),
                    );
                } else {
                    $result['reffers'] = array(
                        'refer_id' =>  $result['profile']['refer_id'],
                        'rf_amount' => 0,
                        'active_rfr' => 0,
                        'total_rfr' => 0,
                    );
                }
                //fetch wallet bal
                $bal_fetch = $this->getBalance($data['mobile']);
                $fetch_upi = $this->api->find(array('mobile' => $data['mobile'], 'status' => 1), 'tbl_upi');
                if ($fetch_upi) {
                    $fetch_upi = $fetch_upi->row()->bank_upi;
                } else {
                    $fetch_upi = null;
                }

                $result['wallet'] = array('user_upi' => $fetch_upi, 'bal_amnt' => $bal_fetch);
            } else {
                $result = null;
            }
        } else {
            $result = false;
        }
        return $result;
    }

    function addwallet($data)
    {
        $result = array();

        $walletData = array(
            'mobile' => $data['mobile'],
            'amount' => $data['amount'],
            'trtype' => $data['trtype'],
            'balance' => $data['balance'],
            'trdetails' => $data['trdetails'],
            'trno' => $data['trno'],
            'date' => date('d-m-Y'),
            'time' => date('h:m')
        );

        $chkExists = $this->api->Exister(array('mobile' => $data['mobile']), 'tbl_wallet');

        if ($chkExists) {
            $addMoney = $this->api->insert($walletData, 'tbl_wallet');
            if ($addMoney) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 3;
        }
    }

    function addWithdraw($data)
    {
        $result = array();
        $tr_no = $this->RandS(19);
        $withdrawData = array(
            'userid' => $data['mobile'],
            'mobile' => $data['mobile'],
            'amount' => $data['amount'],
            'upi_id' => $data['upi'],
            'date' => $data['date'],
            'time' => $data['time'],
            'tr_no' => $tr_no,
            'status' => 0
        );

        $chkExists = $this->api->Exister(array('mobile' => $data['mobile'], 'date' => $data['date']), 'tbl_withdrawl_req');

        if ($chkExists) {
            return 3;
            //$getbal = $this->api->find(array('mobile' => $data['mobile']), 'tbl_wallet');
        } else {
            $addRequest = $this->api->insert($withdrawData, 'tbl_withdrawl_req');
            $walletData = array(
                'mobile' => $data['mobile'],
                'amount' => $data['amount'],
                'trtype' => 'debit',
                'trdetails' => 'Request Withdrawl',
                'trno' => $tr_no,
                'date' => date('d-m-Y'),
                'time' => date('hh:mm')
            );

            if ($addRequest) {
                $deductWallet = $this->api->insert($walletData, 'tbl_wallet');
                return 0;
            } else {
                return 1;
            }
        }
    }

    /* Get Game Catagory */
    function getGameCatagory($param)
    {
        $day = $param['day'] ? $param['day'] : null;
        if ($day) {
            $filter_game_cat_lists = $this->api->GameCatagories($day);
            if ($filter_game_cat_lists) {
                foreach ($filter_game_cat_lists->result() as $row) {
                    $data['results'][] = $this->getDetails($row->cat_id);
                }
                return $data;
            }
            return 1;
        } else {
            return 3;
        }
    }

    function getDetails($param)
    {
        $result = $this->db->select('*')->where('cat_id', $param)->order_by('id')->from('tbl_game_catagory')->get();

        return $result ? $result->row() : null;
    }
    /* Get Game Catagory End*/

    function getGameList($params)
    {
        $data = array();
        if (empty($params['day']) || empty($params['cat_id'])) {
            return 3;
        } else {
            $search = array('day' => $params['day'], 'cat_id' => $params['cat_id']);
            $games = $this->api->GameData($search);
            if ($games) {

                foreach ($games->result() as $match) {
                    $resp[] = array(
                        "id" => $match->id,
                        "match_id" => $match->match_id,
                        "match_time" => $match->match_time,
                        "day" => $match->day,
                        "game_title" => $match->game_title,
                        "game_id" => $match->game_id,
                        "cat_title" => $match->cat_title,
                        "cat_id" => $match->cat_id,
                        "match_icon" => 'https://control.fatafatguru.in/uploads/sub.jpg',
                        "status" => $match->status,
                        "live" => $this->chkGameLive($match->match_time),
                    );
                }
                return $data['results'] = $resp;
            } else {
                return 1;
            }
        }
    }

    function test()
    {
        $gTime = '23:50';
        echo $gTime . '<br>';
        $cTime = date("H:i");
        $lastBetTime = $gTime;
        $lastBetTime = date("H:i", strtotime($lastBetTime) - (strtotime('00:05:00') - strtotime("00:00:00")));
        $endTime = date("H:i", strtotime($cTime) + (strtotime('00:25:00') - strtotime("00:00:00")));
        if ($gTime < $cTime || $gTime < $endTime) {
            //return 'yes';
        } else {
            //return 'no';
        }
        echo $cTime . '<br>';
        echo $lastBetTime . '<br>';
        echo $endTime . '<br>';
    }

    function chkGameLive($gTime)
    {
        $cTime = date("H:i");
        $lastBetTime = $gTime;
        //$lastBetTime = date("H:i", strtotime($lastBetTime) - (strtotime('00:05:00') - strtotime("00:00:00")));
        $endTime = date("H:i", strtotime($gTime) + (strtotime('00:25:00') - strtotime("00:00:00")));
        if ($gTime > $cTime) {
            return 'yes';
        } else {
            return 'no';
        }
        /* 
        $cTime = date("h:s");
        $lastBetTime = $gTime;
        //$lastBetTime = date("H:i", strtotime($lastBetTime) - (strtotime('00:05:00') - strtotime("00:00:00")));
        $endTime = date("H:i", strtotime($gTime) + (strtotime('00:15:00') - strtotime("00:00:00")));
        if ($gTime > $endTime) {
            return 'yes';
        } else {
            return 'no';
        } */
    }

    function getBalance($mobile)
    {
        $getCr = $this->api->get_bal(array('mobile' => $mobile, 'trtype' => 'credit'));
        $getDr = $this->api->get_bal(array('mobile' => $mobile, 'trtype' => 'debit'));
        $getBal = round(((!empty($getCr) ? $getCr : 0) - (!empty($getDr) ? $getDr : 0)), 2);
        if ($getBal > -1) {
            return $getBal;
        } else {
            return false;
        }
    }

    function placeBets($params)
    {
        $response = array();
        $bet_array = array(
            'match_id' => $params['matchId'],
            'game_id' => $params['gameId'],
            'cat_id' => $params['catId'],
            'bet_type' => $params['betType'],
            'bet_val' => $params['betVal'],
            'bet_amnt' => $params['betAmnt'],
            'mobile' => $params['mobile'],
            'date' => $params['date'],
            'time' => $params['time'],
        );

        // check user bal
        $getB = $this->getBalance($params['mobile']);
        if ($getB > $params['betAmnt']) {
            $insert = $this->api->insert($bet_array, 'tbl_bets');
            if ($insert) {
                $walletData = array(
                    'mobile' => $params['mobile'],
                    'amount' => $params['betAmnt'],
                    'trtype' => 'debit',
                    'balance' => '0',
                    'trdetails' => $params['game_title'],
                    'trno' => $this->RandS(6),
                    'date' => $params['date'],
                    'time' => $params['time'],
                );
                $updateWallet =  $this->api->insert($walletData, 'tbl_wallet');
                if ($updateWallet) {
                    $response['status'] = 0;
                    $response['val'] =  'Bet placed Successfully';
                } else {
                    $response['status'] = 3;
                    $response['val'] = 'Bet placed Successfully';
                }
            }
        } else {
            $response['status'] = 4;
            $response['val'] = 'Low balance!';
        }
        return $response;
    }

    function placeJodiBets($params)
    {
        $response = array();
        $bet_array = array(
            'match_id' => $params['matchId1'],
            'match_id2' => $params['matchId2'],
            'bet_val' => $params['betVal1'],
            'bet_val2' => $params['betVal2'],
            'bet_type' => $params['betType'],
            'bet_amnt' => $params['betAmnt'],
            'mobile' => $params['mobile'],
            'date' => $params['date'],
            'time' => $params['time'],
        );

        // check user bal
        $getB = $this->getBalance($params['mobile']);
        if ($getB > $params['betAmnt']) {
            $insert = $this->api->insert($bet_array, 'tbl_jodi_bets');
            if ($insert) {
                $walletData = array(
                    'mobile' => $params['mobile'],
                    'amount' => $params['betAmnt'],
                    'trtype' => 'debit',
                    'balance' => '0',
                    'trdetails' => 'jodibetplacements',
                    'trno' => $this->RandS(6),
                    'date' => $params['date'],
                    'time' => $params['time'],
                );
                $updateWallet =  $this->api->insert($walletData, 'tbl_wallet');
                if ($updateWallet) {
                    $response['status'] = 0;
                    $response['val'] =  'Bet placed Successfully';
                } else {
                    $response['status'] = 3;
                    $response['val'] = 'Bet placed Successfully';
                }
            }
        } else {
            $response['status'] = 4;
            $response['val'] = 'Low balance!';
        }
        return $response;
    }

    public function getWinings($params)
    {
        $response = array();
        $number_validation_regex = "/^\\d+$/";
        $search_arr = array();
        if (
            preg_match($number_validation_regex, $params['mobile']) == 1 && (strlen($params['mobile']) == '10')
        ) {
            if (!empty($params['searchKey']) && $params['searchKey'] != null) {
                switch (trim($params['searchKey'])) {
                    case "SD":
                        $search_arr['win_type'] = 'SingleDigit';
                        break;
                    case "SP":
                        $search_arr['win_type'] = 'SinglePanna';
                        break;
                    case "DP":
                        $search_arr['win_type'] = 'DoublePanna';
                        break;
                    case "TP":
                        $search_arr['win_type'] = 'TripplePanna';
                        break;
                    case "CP":
                        $search_arr['win_type'] = 'cp';
                        break;
                    case "JODI":
                        $search_arr['win_type'] = 'jodi';
                        break;
                    default:
                        $response['status'] = 2;
                        $response['message'] = 'Filter error!';
                }
                $filterSearch = array_merge(array('mobile' => $params['mobile'], 'cat_id' => $params['catId']), $search_arr);
                $getWiners = $this->api->findWithFilter(
                    $filterSearch,
                    array('sortBy' => $params['sortBy'] ? $params['sortBy'] : 'id', 'sortTo' => $params['sortTo'] ? $params['sortTo'] : 'desc'),
                    array('lstart' => $params['lstart'] ? $params['lstart'] : '10', 'lend' => $params['lend'] ? $params['lend'] : ''),
                    'tbl_winnings'
                );
            } else {
                $getWiners = $this->api->findWithFilter(
                    array('mobile' => $params['mobile'], 'cat_id' => $params['catId']),
                    array('sortBy' => $params['sortBy'] ? $params['sortBy'] : 'id', 'sortTo' => $params['sortTo'] ? $params['sortTo'] : 'desc'),
                    array('lstart' => $params['lstart'] ? $params['lstart'] : '10', 'lend' => $params['lend'] ? $params['lend'] : ''),
                    'tbl_winnings'
                );
            }

            if ($getWiners) {
                foreach ($getWiners->result() as $key => $value) {
                    $game = $this->api->find_field('item_name', array('item_id' => $value->game_id), 'tbl_game_items');
                    $game = !empty($game) ? $game : 'No Title';
                    $resp[] = array(
                        'date' => $value->date,
                        'game' => $game,
                        'time' => $value->time,
                        'patti' => $value->win_type,
                        'digit' => $value->win_val,
                        'amount' => $value->win_amnt,
                    );
                }
                $response['status'] = 0;
                $response['message'] = 'Fetched Sucessfully';
                $response['data'] = $resp;
            } else {
                $response['status'] = 1;
                $response['message'] = 'No results found!';
                $response['data'] = NULL;
            }
        } else {
            $response['status'] = 2;
            $response['message'] = 'Userid missing';
        }

        return $response;
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

    public function addBank($data)
    {
        $bankData = array(
            'mobile' => $data['mobile'],
            'userid' => $data['userid'],
            'bank_name' => $data['bankName'],
            'bank_acc' => $data['bankAccNo'],
            'bank_ifsc' => $data['bankName']
        );
        $chkExists = $this->api->Exister(array('mobile' => $data['mobile'], 'bank_acc' => $data['bankAccNo']), 'tbl_bank');
        if ($chkExists) {
            return 3;
            //$getbal = $this->api->find(array('mobile' => $data['mobile']), 'tbl_wallet');
        } else {
            $addData = $this->api->insert($bankData, 'tbl_bank');
            if ($addData) {
                return 0;
            } else {
                return 1;
            }
        }
    }

    public function addUpi($data)
    {
        $bankData = array(
            'mobile' => $data['mobile'],
            'userid' => $data['userid'],
            'bank_upi' => $data['bankUpi']
        );
        $chkExists = $this->api->Exister(array('mobile' => $data['mobile'], 'bank_upi' => $data['bankUpi']), 'tbl_upi');
        if ($chkExists) {
            return 3;
            //$getbal = $this->api->find(array('mobile' => $data['mobile']), 'tbl_wallet');
        } else {
            $addData = $this->api->insert($bankData, 'tbl_upi');
            if ($addData) {
                return 0;
            } else {
                return 1;
            }
        }
    }

    public function getWalletHistory($data)
    {
        $resp = array();
        $params = array(
            'mobile' => $data['mobile']
        );

        $getResults = $this->api->findWithFilter($params, array('sortBy' => $data['sortBy'] ? $data['sortBy'] : 'id', 'sortTo' => $data['sortTo'] ? $data['sortTo'] : 'desc'), array('lstart' => $data['lstart'] ? $data['lstart'] : '10', 'lend' => $data['lend'] ? $data['lend'] : ''), 'tbl_wallet');
        if ($getResults) {
            $resp['status'] = 0;
            foreach ($getResults->result() as $key => $value) {
                $resp['data'][] = array(
                    'date' => $value->date,
                    'descp' => $value->trdetails,
                    'tr_amnt' => $value->amount,
                    'bal' => $value->amount, //$value->balance;     
                );
            }
        } else {
            $resp['status'] = 3;
        }
        return $resp;
        print_r($resp);
    }

    ////////////////// START API FUNCTION ///////////////

    /* Cautions: Do not make any changes here unless your needs. */
    public function isCurl()
    {
        return function_exists('curl_version');
    }

    public function hash_decrypt($hash, $secretkey)
    {
        return openssl_decrypt($hash, "AES-128-ECB", $secretkey);
    }

    public function callback()
    {
        if ($this->session->has_userdata('sprsacc')) {
            $apisecret = $this->session->userdata('sprsacc')->api_secret;
        } else {
            $getapi = $this->getAccessClient('BMTECH243');
            if ($getapi) {
                if ($getapi->status == 1) {
                    $apisecret = !empty($getapi->api_secret) ? $getapi->api_secret : null;
                    $this->session->set_userdata('sprsacc', $getapi);
                } else {
                    $result['status'] = 1;
                    $result['message'] = 'Auth Gateway error!';
                }
            } else {
                $result['status'] = 1;
                $result['message'] = 'Api Client missing!';
            }
        }

        $data = $this->input->get('results');
        $data = json_decode($data);

        $check1 = $this->api->Exister(array('hash' => md5($data->hash)), 'txn_response_tbl');

        if ($check1) {
            //echo 'data exst';
        } else {
            $storeStatus = $this->api->insert(array('status' => $data->status, 'message' => $data->message, 'hash' => md5($data->hash)), 'txn_response_tbl');
        }

        $statresult = $this->hash_decrypt($data->hash, $apisecret);
        $getPGStatus = json_decode($statresult);
        //update status
        $store_data = array(
            'orderId' => $getPGStatus->orderId,
            'txnStatus' => $getPGStatus->txnStatus,
            'txnDate' => $getPGStatus->txnDate,
            'resultInfo' => $getPGStatus->resultInfo,
            'txnAmount' => $getPGStatus->txnAmount,
            'utr' => $getPGStatus->utr,
            'txnId' => $getPGStatus->txnId,
            'bankTxnId' => $getPGStatus->bankTxnId,
            'customerUpi' => $getPGStatus->customerUpi,
            'cust_name' => $getPGStatus->customerName,
            'mobile' => $getPGStatus->customerMobile,
            'customerUpi' => $getPGStatus->customerUpi,
            'payee_vpa' => $getPGStatus->payee_vpa,
        );

        $update_status = $this->api->update($store_data, array('hash' => md5($data->hash)), 'txn_response_tbl');

        if ($getPGStatus->txnStatus == 'COMPLETED') {
            $wltdata = array(
                'mobile' => $getPGStatus->customerMobile,
                'amount' =>  $getPGStatus->txnAmount,
                'trtype' => 'credit',
                'balance' => 0,
                'trdetails' => 'OD',
                'trno' => $getPGStatus->orderId,
            );

            $this->addwallet($wltdata);
            //add Notif
            $this->home->addNotify(array(
                'notif' => 'addMoney',
                'notif_type' => 'OD Money added by ' . $getPGStatus->customerMobile,
                'date' => date('d-m-Y'),
                'time' => date('h:m'),
            ));
        } else {
            //
        }
        // store callback //

        $this->sess_clr_acc();

        if ($data->status == '1') {
            echo $getPGStatus->txnStatus;
        } else {
            echo $getPGStatus->txnStatus;
        }
        header("Location: https://control.fatafatguru.in/home/cbpaymnt/?prevStat=" . $getPGStatus->txnStatus . '&OD=' . $getPGStatus->orderId, true, 301);
        exit();
    }

    public function runCurler($params)
    {

        $Apitoken = $params['Apitoken'];
        $url = $params['url'];

        $orderId = $params['orderId'];
        $txnAmount = $params['txnAmount'];
        $txnNote = $params['txnNote'];
        $customerName = $params['customerName'];
        $customerEmail = $params['customerEmail'];
        $customerMobile = $params['customerMobile'];
        $callbackUrl = $params['callbackUrl'];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array("Content-Type: application/json",);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = array(
            "token" => $Apitoken,
            "orderId" => $orderId,
            "txnAmount" => $txnAmount,
            "txnNote" => $txnNote,
            "customerName" => $customerName,
            "customerEmail" => $customerEmail,
            "customerMobile" => $customerMobile,
            "callbackUrl" => $callbackUrl
        );

        $data = json_encode($data);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp1 = curl_exec($curl);
        curl_close($curl);
        return $resp1;
    }

    public function getAccessClient(string $clid = null)
    {
        $rs = $this->api->find(array('client_id' => $clid), 'client_api_secret');
        if ($rs) {
            foreach ($rs->result() as $row) {
                $res = array(
                    "status" => 1,
                    "msg" => 'Fetched Successfully!',
                    "client_id" => $row->client_id,
                    "api_key" => $row->api_secret,
                    "api_status" => $row->api_status,
                    "api_secret" => $row->api_key_secret,
                    "client_cb_url" => $row->client_cb_url
                );
            }
            return json_decode(json_encode($res), FALSE);
        } else {
            return false;
        }

        /*         $chkCurl = $this->isCurl();
        if ($chkCurl) {
            $data = http_build_query(array('client_id' => $clid));
            $url = "https://sprsinfotech.com/ApiClient/cleintaccess/";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $headers = array(
                "Content-Type: application/x-www-form-urlencoded",
            );
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $resp = curl_exec($curl);
            curl_close($curl);
            if ($resp) {
                $resp = json_decode($resp);
                $this->session->set_userdata('sprsacc', $resp);
                return $resp;
            } else {
                return false;
            }
        } else {
            echo 'no curl ';
        } */
    }
    ////////////////// END API FUNCTION ///////////////


    function getd()
    {
        $data = '';
        if ($this->session->has_userdata('sprsacc')) {
            $data = $this->session->sprsacc;
        }
        print_r($data);
    }

    function ch()
    {
        $d = $this->getAccessClient('BMTECH243');
        print_r($d);
    }

    function sess_clr_acc()
    {
        $this->session->unset_userdata('sprsacc');
    }
}