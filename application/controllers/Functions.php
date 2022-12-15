<?php
date_default_timezone_set('Asia/Kolkata');
defined('BASEPATH') or exit('No direct script access allowed');

class Functions extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Homemodel');
    }

    public function live_games()
    {
        $result = array();
        $time = $this->input->get('time');
        $day = $this->input->get('day');
        $result = array();
        $arr = array(
            'day' => $day,
            'status' => '0',
            'match_time <=' => $time,
        );

        $getGames = $this->home->findOne($arr, 'tbl_gamelist');

        if ($getGames) {
            $data = $getGames->row()->match_id;
            $result['status'] = '0';
            $result['result'] = $data;
        } else {
            $result['status'] = '1';
            $result['result'] = null;
        }

        echo json_encode($result);
    }
}
