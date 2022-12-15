<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Entry extends CI_Controller
{
    public function index()
    {
        $this->load->library('user_agent');
        $this->load->view('pages/login');
        /*  if ($this->agent->is_browser()) {
            $this->load->view('pages/login');
        } elseif ($this->agent->is_robot()) {
            redirect('login/errorscreen');
        } elseif ($this->agent->is_mobile()) {
            $this->load->view('pages/login');
            // redirect('login/errorscreen');
        } else {
            $this->load->view('pages/login');
            //redirect('login/errorscreen');
        } */
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

        if (!empty($email) && !empty($pass)) {

            $chkLogin = $this->home->find(array('admin_email' => $email, 'password' => $pass, 'status' => 1), 'tbl_admin');

            if ($chkLogin) {
                $this->session->set_userdata('ses_data', $chkLogin->row()->admin_email);
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
}