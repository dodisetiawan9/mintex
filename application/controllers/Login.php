<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kain');
	}

	public function index()
	{
		$this->cek_login();
		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);

			$cek = $this->m_kain->get_where('t_admin', array('username' => $username));

			if($cek->num_rows() > 0){
				$data = $cek->row();

				if(password_verify($password, $data->password)){
					$datauser = array(
						'id_admin'	=> $data->id_admin,
						'user'			=> $data->fullname,
						'login'			=> TRUE
					);

					$this->session->set_userdata($datauser);
					$this->session->set_flashdata('success', 'Selamat datang'.$data->fullname.'');
					redirect('admin');
				}
				else{
					$this->session->set_flashdata('alert', 'Password yang anda masukan salah!');
				}
			}
			else{
				$this->session->set_flashdata('alert', 'Email / Username tidak terdaftar');
			}
		}

		if($this->session->userdata('login', TRUE)){
			redirect('admin');
		}

		$this->load->view('login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	public function cek_login()
	{
		if($this->session->userdata('id_admin')){
			redirect('admin');
		}
	}

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */