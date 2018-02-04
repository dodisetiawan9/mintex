<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
	}
	public function index()
	{
		$this->cek_login();
		$this->template->admin('admin/home');		
	}

	public function cek_login()
	{
		if(!$this->session->userdata('id_admin')){
			redirect('login');
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */