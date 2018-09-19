<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kain');
		$this->load->library('template');

	}
	
	public function index()
	{
		$this->cek_login();
		$table = 't_stok_kain sk JOIN t_kain k ON (sk.id_kain=k.id_kain)';
		$table_benang = 't_stok_benang sb JOIN t_benang b ON (sb.id_benang=b.id_benang)';

		$data['kain'] 	= $this->m_kain->order_by($table, 'sk.id_kain', 'DESC');
		$data['benang']	= $this->m_kain->order_by($table_benang, 'sb.id_benang', 'DESC');


		//kain
		if($this->input->post('submit_kain') == 'Submit'){
			$id_kain = $this->input->post('jenis_kain', TRUE);
			$data_kain = $this->m_kain->get_where('t_stok_kain', array('id_kain' => $id_kain))->row();

			$data['total_gl'] 		= $data_kain->total_gl; 
			$data['total_meter'] 	= $data_kain->total_meter; 
			$data['total_kg'] 		= $data_kain->total_kg; 
		//end kain
		}
		elseif($this->input->post('submit') == 'Cari'){
			$id_benang = $this->input->post('jenis_benang', TRUE);
			$data_benang = $this->m_kain->get_where('t_stok_benang', array('id_benang' => $id_benang))->row();

			$data['total_box']    = $data_benang->total_box;
			$data['total_karung'] = $data_benang->total_karung;
			$data['total_ball']   = $data_benang->total_ball;
			$data['total_kg']     = $data_benang->total_kg;
		}

		$this->template->admin('admin/home', $data);		
		
		
		
				

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