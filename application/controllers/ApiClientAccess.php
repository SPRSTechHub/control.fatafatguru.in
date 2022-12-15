<?php
date_default_timezone_set('Asia/Kolkata');
defined('BASEPATH') or exit('No direct script access allowed');

class ApiClientAccess extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        //$this->load->model("ACAModel", "capi");
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        //header('Access-Control-Allow-Origin: *', 'Content-Type: application/json; charset=utf-8');
    }

    public function cleintaccess()
    {
        $res = array();
        $client_id = $this->input->post('client_id');
        if (empty($client_id)) {
            $res = array(
                "status" => 3,
                "msg" => 'Client id missing!',
            );
            echo json_encode($res, JSON_PRETTY_PRINT);
            exit();
        }
        $ga_data = $this->api->find(array('client_id' => $client_id));
        if ($ga_data) {
            foreach ($ga_data->result() as $row) {
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
            echo json_encode($res, JSON_PRETTY_PRINT);
        } else {
            $res = array(
                "status" => 3,
                "msg" => 'No data fetched from Auth Server!',
            );
            echo json_encode($res, JSON_PRETTY_PRINT);
        }
    }

    function hash_decrypt($hash, $secretkey)
    {
        return openssl_decrypt($hash, "AES-128-ECB", $secretkey);
    }

    public function callback()
    {
        $client_id = 'BMTECH243';
        $apisecret = $this->api->getApiSecret(array('client_id' => $client_id));
        $data = $this->input->post();
        $mydata = $this->hash_decrypt($data['hash'], $apisecret);
        $getPGStatus = json_decode($mydata);

        $store_data = array(
            'client_id' => $client_id,
            'pg_gateway' => 'upiapi',
            'txnStatus' => $getPGStatus->txnStatus,
            'txnDate' => $getPGStatus->txnDate,
            'resultInfo' => $getPGStatus->resultInfo,
            'txnAmount' => $getPGStatus->txnAmount,
            'paymentMode' => $getPGStatus->paymentMode,
            'utr_no' => $getPGStatus->utr,
            'payerName' => $getPGStatus->customerName,
            'payerMobile' => $getPGStatus->customerMobile,
            'payerupi' => $getPGStatus->customerUpi,
            'rcvr_vpa' => $getPGStatus->payee_vpa,
        );
        $gogo = $this->home->insert($store_data, 'client_api_transaction_rprt');
        $data = urlencode(json_encode($data));

        redirect(base_url() . '/api/callback/?results=' . $data);
    }
}