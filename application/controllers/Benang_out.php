<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benang_out extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->load->library(array('template', 'form_validation'));
		$this->load->model('m_benang');
	}

	public function index()
	{
		$data['title']		= "Master Benang";
		$data['subtitle']	= "Data Benang Masuk";

		$this->template->admin('admin/benang/benang_out', $data);
	}

	public function collect()
	{
		$id_benang 				= $this->input->post('jenis', TRUE);	
		if($this->input->post('submit', TRUE) == 'Submit'){
			$jenis_benang = $this->m_benang->get_where('t_benang', array('id_benang' => $id_benang))->row();
			$nama_jenis = $jenis_benang->nama_benang;
		}
			$benang[$id_benang] = array(
				'id_benang'			=> $this->input->post('jenis', TRUE),
				'nama_benang'		=> $nama_jenis,
				'gl'					=> $this->input->post('gl', TRUE),
				'meter'				=> $this->input->post('meter', TRUE),
				'kg'					=> $this->input->post('kg', TRUE),
				'harga'				=> $this->input->post('harga', TRUE)
			);


		if($this->session->userdata('dataKain')){
			$dataKain = $this->session->userdata('dataKain');
		}
		else{
			$dataKain = array();
		}
		
		array_push($dataKain, $kain);
		$this->session->set_userdata('dataKain', $dataKain);

		redirect('kain_out/add_item');
	}

	public function add_benang()
	{
		$data['title']		= "Master Benang";
		$data['subtitle']	= "Data Benang Masuk";
		$data['ontitle']	= "Tambah Data Benang";

		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');
			$this->form_validation->set_rules('distributor', 'Distributor', 'required');
			$this->form_validation->set_rules('jenis', 'Jenis', 'required');
			$this->form_validation->set_rules('bk', 'Box / Karung', 'required|numeric');
			$this->form_validation->set_rules('netto', 'Netto', 'required|numeric');

			if($this->form_validation->run() == TRUE)
			{
				if($this->input->post('satuan', TRUE) == 'box'){
					$karung = '';
					$box 		= $this->input->post('bk', TRUE);
				}
				elseif($this->input->post('satuan', TRUE) == 'karung'){
					$karung = $this->input->post('bk', TRUE);
					$box 		= '';
				}


				if($this->input->post('satuan_net', TRUE) == 'ball'){
					$ball = $this->input->post('netto', TRUE);
					$kg = '';
				}
				elseif($this->input->post('satuan_net', TRUE) == 'kg'){
					$ball = '';
					$kg = $this->input->post('netto', TRUE);
				}

				$benang = array(
					'id_dist_benang'	=> $this->input->post('distributor', TRUE),
					'id_benang'				=> $this->input->post('jenis', TRUE),
					'id_benang'				=> $this->input->post('jenis', TRUE),
					'b_karung'				=> $karung,
					'b_box'						=> $box,
					'ball'						=> $ball,
					'kg'							=> $kg,
					'harga'						=> $this->input->post('harga', TRUE),
					'keterangan'			=> $this->input->post('keterangan', TRUE),
					'tgl'							=> $this->input->post('tgl', TRUE),
				);

				if($this->m_benang->insert('t_benang_in', $benang)){
					$stok = $this->m_benang->get_where('t_stok_benang', array('id_benang' => $this->input->post('jenis', TRUE)));

					$key = $stok->row();
					$total_box 		= $key->total_box + $box;
					$total_karung = $key->total_karung + $karung;
					$total_ball 	= $key->total_ball + $ball;
					$total_kg 		= $key->total_ball + $kg;

					$total = array(
						'id_benang'				=> $this->input->post('jenis', TRUE),
						'total_box'				=> $total_box,
						'total_karung'		=> $total_karung,
						'total_ball'			=> $total_ball,
						'total_kg'				=> $total_kg
					);

					if($stok->num_rows() <= 0){
						$this->m_benang->insert('t_stok_benang', $total);
					}
					else{
						$this->m_benang->update('t_stok_benang', $total, array('id_benang' => $this->input->post('jenis')));
					}

					$this->session->set_flashdata('alert', 'Data Berhasil disimpan!');
					redirect('benang');
				}

			}
		}


		$data['tgl']					= $this->input->post('tgl');
		$data['dist']					= $this->input->post('distributor');
		$data['jenis']				= $this->input->post('jenis');
		$data['bk']						= $this->input->post('bk');
		$data['harga']				= $this->input->post('harga');
		$data['keterangan']		= $this->input->post('keterangan');

		$data['jenis']				= $this->m_benang->get_all('t_benang');
		$data['distributor']	= $this->m_benang->get_all('t_dist_benang');

		$this->template->admin('admin/benang/form_out', $data);
	}

	function cek_login()
	{
		if(!$this->session->userdata('id_admin')){
			redirect('login');
		}
	}

}

/* End of file Benang_out.php */
/* Location: ./application/controllers/Benang_out.php */