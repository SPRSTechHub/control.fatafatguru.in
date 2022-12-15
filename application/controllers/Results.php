<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Results extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('res_page1');
    }
    public function result()
    {
        $this->load->view('res_page');
    }
}