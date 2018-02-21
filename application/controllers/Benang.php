<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benang extends CI_Controller {

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

		$table = 't_benang_in bi JOIN t_benang b ON (bi.id_benang = b.id_benang) JOIN t_dist_benang db ON (bi.id_dist_benang = db.id_dist_benang)';
		$data['data']	= $this->m_benang->order_by($table, 'bi.id_benang_in', 'DESC');
		$this->template->admin('admin/benang/benang_in', $data);
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
					'b_karung'				=> $karung,
					'b_box'						=> $box,
					'ball'						=> $ball,
					'kg'							=> $kg,
					'harga'						=> $this->input->post('harga', TRUE),
					'keterangan'			=> $this->input->post('keterangan', TRUE),
					'tgl'							=> $this->input->post('tgl', TRUE),
					'status_bng'			=> 1
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
		$data['b_karung']			= $this->input->post('bk');
		$data['ball']					= $this->input->post('netto');
		$data['kg']						= $this->input->post('netto');
		$data['harga']				= $this->input->post('harga');
		$data['keterangan']		= $this->input->post('keterangan');
		$data['status_bng']		= $this->input->post('status');

		$data['jenis']				= $this->m_benang->get_where('t_benang', array('status' => 'on'));
		$data['distributor']	= $this->m_benang->get_all('t_dist_benang');

		$this->template->admin('admin/benang/form_in', $data);
	}

	public function update()
	{
		$data['title']		= "Master Benang";
		$data['subtitle']	= "Data Benang Masuk";
		$data['ontitle']	= "Tambah Data Benang";
		$id = $this->uri->segment(3);

		//prosess
				$benang_in  = $this->m_benang->get_where('t_benang_in', array('id_benang_in' => $id));
				$val_benang = $benang_in->row();

				$id_stok = $val_benang->id_benang;

				$stok_in = $this->m_benang->get_where('t_stok_benang', array('id_benang' => $id_stok));
				$val_stok = $stok_in->row();

				$total_box   		= $val_stok->total_box 		- $val_benang->b_box;
				$total_karung 	= $val_stok->total_karung - $val_benang->b_karung;
				$total_ball 		= $val_stok->total_ball 	- $val_benang->ball;
				$total_kg 			= $val_stok->total_kg 		- $val_benang->kg;

				$array_stok = array(
					'total_box'			=> $total_box,
					'total_karung'	=> $total_karung,
					'total_ball'		=> $total_ball,
					'total_kg'			=> $total_kg
				);


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
							'b_karung'				=> $karung,
							'b_box'						=> $box,
							'ball'						=> $ball,
							'kg'							=> $kg,
							'harga'						=> $this->input->post('harga', TRUE),
							'keterangan'			=> $this->input->post('keterangan', TRUE),
							'tgl'							=> $this->input->post('tgl', TRUE),
							'status_bng'			=> $this->input->post('status', TRUE)
						);

						//update data
						$this->m_benang->update('t_benang_in', $benang, array('id_benang_in' => $id));
						$this->m_benang->update('t_stok_benang', $array_stok, array('id_benang' => $id_stok));

						$total = $this->m_benang->get_where('t_stok_benang', array('id_benang' => $this->input->post('jenis', TRUE)));

						$key 				= $total->row();
						$id_benang	= $key->id_benang;
						$ttl_box 		= $key->total_box 		+ $box;
						$ttl_karung	= $key->total_karung 	+ $karung;
						$ttl_ball		= $key->total_ball 		+ $ball;
						$ttl_kg			= $key->total_kg 			+ $kg;

						$total_benang = array(
							'id_benang'			=> $this->input->post('jenis', TRUE),
							'total_box'			=> $ttl_box,	
							'total_karung'	=> $ttl_karung,	
							'total_ball'		=> $ttl_ball,	
							'total_kg'			=> $ttl_kg	
						);

						if($total->num_rows() <= 0){
							$this->m_benang->insert('t_stok_benang', $total_benang);
						}
						elseif($id_benang == $this->input->post('jenis', TRUE)){
							$this->m_benang->update('t_stok_benang', $total_benang, array('id_benang' => $id_benang));
						}

						$this->session->set_flashdata('success', 'Data Berhasil Diupdate!!!');
						redirect('benang');
					}
				}
		//endproses

		$table = 't_benang_in bi JOIN t_benang b ON (bi.id_benang = b.id_benang) JOIN t_dist_benang db ON (bi.id_dist_benang = db.id_dist_benang)';
		$benang	= $this->m_benang->get_where($table, array('bi.id_benang_in' => $id));
		foreach ($benang->result() as $key) {
			$data['tgl']  			= $key->tgl;
			$data['dist']				= $key->id_dist_benang;
			$data['kjenis']			= $key->id_benang;
			$data['bk']					= $key->b_box;
			$data['b_karung']		= $key->b_karung;
			$data['ball']				= $key->ball;
			$data['kg']					= $key->kg;
			$data['harga']			= $key->harga;
			$data['keterangan']	= $key->keterangan;
			$data['status_bng']	= $key->status_bng;
		}
		
		$data['distributor']	= $this->m_benang->get_all('t_dist_benang'); 
		$data['jenis']				= $this->m_benang->get_where('t_benang', array('status' => 'on')); 
		$this->template->admin('admin/benang/form_in', $data);
	}

	public function delete()
	{
		$id_benang_in = $this->uri->segment(3);

		$benang_in = $this->m_benang->get_where('t_benang_in', array('id_benang_in' => $id_benang_in));
		$val_benang= $benang_in->row();
		$id_stok = $val_benang->id_benang;

		if($val_benang->status_bng != 1){
			$this->m_benang->delete('t_benang_in', array('id_benang_in' => $id_benang_in));
		}
		else{
			$stok_in = $this->m_benang->get_where('t_stok_benang', array('id_benang' => $id_stok));
			$val_stok = $stok_in->row();

			$total_box   		= $val_stok->total_box 			- $val_benang->b_box;
			$total_karung 	= $val_stok->total_karung 	- $val_benang->b_karung;
			$total_ball 		= $val_stok->total_ball 		- $val_benang->ball;
			$total_kg 			= $val_stok->total_kg 			- $val_benang->kg;

			$array_stok = array(
				'total_box'			=> $total_box,
				'total_karung'	=> $total_karung,
				'total_ball'		=> $total_ball,
				'total_kg'			=> $total_kg
			);

			$this->m_benang->update('t_stok_benang', $array_stok, array('id_benang' => $id_stok));

			$this->m_benang->delete('t_benang_in', array('id_benang_in' => $id_benang_in));

		}

		$this->session->set_flashdata('success', 'Data berhasil di hapus!');
		redirect('benang');
	}


	function cek_login()
	{
		if(!$this->session->userdata('id_admin')){
			redirect('login');
		}
	}

}

/* End of file Benang.php */
/* Location: ./application/controllers/Benang.php */