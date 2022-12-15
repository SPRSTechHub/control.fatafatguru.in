<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->library('user_agent');

        if ($this->agent->is_browser()) {
            $this->load->view('pages/login');
        } elseif ($this->agent->is_robot()) {
            redirect('login/errorscreen');
        } elseif ($this->agent->is_mobile()) {
            redirect('login/errorscreen');
        } else {
            redirect('login/errorscreen');
        }
    }

    public function errorscreen()
    {
        $this->load->view('errors/cli/error503');
    }

    public function getLogin()
    {
        $rsp = array();
        $email = $this->input->post('emailid');
        $pass = $this->input->post('pass');
        $rKey = $this->input->post('regK');

        if (!empty($email) && !empty($pass)) {
            $session_id = rand(5, 2);
            $chkLogin = $this->home->find(array('admin_email' => $email, 'password' => $pass, 'status' => 1), 'tbl_admin');

            if ($chkLogin) {
                $rt = array('admin_email' => $email, 'session_id' => md5($session_id), 'regKey' => $rKey);
                $store = $this->home->insert($rt, 'adm_sess_tbl');

                $this->session->set_userdata('ses_data', $rt);
                $rsp['status'] = 0;
            } else {
                $rsp['status'] = 1;
            }
        } else {
            $rsp['status'] = 3;
        }
        header("Content-Type: application/json");
        echo json_encode($rsp);
    }

    public function nopermission()
    {
        $this->load->view('pages/_pgnopermission');
    }
}