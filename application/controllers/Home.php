<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->database();
		$this->load->model("Api_model", "api");
		$this->load->model('Homemodel');
	}

	public function test1()
	{
		$this->load->view('test1');
	}

	public function index()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/dashboard');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function users()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgusers');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function allreferral()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgallreferral');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function userwallet()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pguserwallet');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function userdeposites()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pguserdeposites');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function settingpayment()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgsetting');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function gamelists()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pggamelist');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function winlists()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgwinlists');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function betlists()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgbetlists');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function live1()
	{
		$this->load->view('landing');
	}
	public function live()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$game_id = $this->input->get('gid');
			if (empty($game_id)) {
				redirect('/home');
			} else {
				$this->load->view('temp/header');
				$this->load->view('temp/navbar');
				$this->load->view('temp/sidebar');
				$this->load->view('pages/_pglivegame');
				$this->load->view('temp/footer');
			}
		} else {
			redirect('Login');
		}
	}

	public function allPayment()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgpayments');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function withdrawlist()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgwithdrawls');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function banklist()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgbanklist');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function search()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_ms_search');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function setting_all()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');
			$this->load->view('pages/_pgsetting_all');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function offers()
	{
		if ($this->session->has_userdata('ses_data')) {
			$data['admin_data'] = $this->session->ses_data;
			$this->load->view('temp/header');
			$this->load->view('temp/navbar');
			$this->load->view('temp/sidebar');

			$this->load->view('pages/_pgofferlist');
			$this->load->view('temp/footer');
		} else {
			redirect('Login');
		}
	}

	public function submitOffer()
	{
		$result = array();
		$user = $this->input->post('user');
		$status = $this->input->post('status');
		$fileStore = $this->upload_image('file');
		if ($fileStore) {
			$data = array(
				'offer_url' => $fileStore,
				'mobile' => !empty($user) ? $user : null,
				'status' => $status,
				'upload_on' => date('Y-m-d')
			);
			$addData = $this->Homemodel->insert($data, 'tbl_offer');
			if ($addData) {
				$result['status'] = 1;
			} else {
				$result['status'] = 0;
			}
		}
		echo json_encode($result);
	}

	function upload_image($param)
	{
		if (isset($_FILES[$param])) {
			$extension = explode('.', $_FILES[$param]['name']);
			$new_name = rand() . '.' . $extension[1];
			$destination = 'uploads/offers/' . $new_name;
			move_uploaded_file($_FILES[$param]['tmp_name'], $destination);
			return $new_name;
		} else {
			return false;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('ses_data');
		$this->session->sess_destroy();
		redirect('Login');
	}

	public function cbpaymnt()
	{
		$this->load->view('pages/_pg_cbpymnt');
	}
}