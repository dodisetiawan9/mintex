 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kain extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->load->model('m_kain');
		$this->load->library(array('template', 'form_validation'));
	}

	public function index()
	{
		$data['title'] 		= "Master Kain";
		$data['subtitle'] = "Data Kain Masuk";

		$table = 't_kain_in ki JOIN t_kain k ON (ki.id_kain = k.id_kain) JOIN t_distributor d ON (ki.id_distributor = d.id_distributor)';

		$data['kain']			= $this->m_kain->order_by($table, 'ki.id_kain_in', 'DESC');
		$this->template->admin('admin/kain/kain_in', $data);
	}

	public function add_item()
	{
		$data['title'] 		= "Master Kain";
		$data['subtitle'] = "Data Kain Masuk";
		$data['ontitle']	= "Tambah Data";

	
		if($this->input->post('submit', TRUE) == 'Submit'){
			$this->form_validation->set_rules('jenis', 'Jenis Kain', 'required|numeric');
			$this->form_validation->set_rules('gl', 'GL', 'required|numeric');
			$this->form_validation->set_rules('meter', 'Meter', 'required|numeric');
			$this->form_validation->set_rules('kg', 'Kilogram (Kg)', 'numeric');
			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
			$this->form_validation->set_rules('distributor', 'Distributor', 'required|numeric');
			

			if($this->form_validation->run() == TRUE)
			{
				$kain = array(
					'id_distributor'	=> $this->input->post('distributor', TRUE),
					'id_kain'					=> $this->input->post('jenis', TRUE),
					'gl'							=> $this->input->post('gl', TRUE),
					'meter'						=> $this->input->post('meter', TRUE),
					'kg'							=> $this->input->post('kg', TRUE),
					'harga'						=> $this->input->post('harga', TRUE),
					'keterangan' 			=> $this->input->post('keterangan', TRUE),
					'tgl'							=> $this->input->post('tgl', TRUE),
					'status_kain'			=> 1
				);

				if($this->m_kain->insert('t_kain_in', $kain)){
					$total = $this->m_kain->get_where('t_stok_kain', array('id_kain' => $this->input->post('jenis', TRUE)));

					$key 				= $total->row();
					$id 				= $key->id_kain;
					$ttl_gl 		= $key->total_gl 		+ $this->input->post('gl', TRUE);
					$ttl_meter	= $key->total_meter + $this->input->post('meter', TRUE);
					$ttl_kg			= $key->total_kg 		+ $this->input->post('kg', TRUE);

					$total_kain = array(
						'id_kain'			=> $this->input->post('jenis', TRUE),
						'total_gl'		=> $ttl_gl,	
						'total_meter'	=> $ttl_meter,	
						'total_kg'		=> $ttl_kg	
					);

					if($total->num_rows() <= 0){
						$this->m_kain->insert('t_stok_kain', $total_kain);
					}
					elseif($id == $this->input->post('jenis', TRUE)){
						$this->m_kain->update('t_stok_kain', $total_kain, array('id_kain' => $id));
					}

					$this->session->set_flashdata('success', 'Data Berhasil Disimpan!!!');
					redirect('kain');
				}
			}
		}

		$data['tgl']					= $this->input->post('tgl');
		$data['dist']					= $this->input->post('distributor');
		$data['id_kain']			= $this->input->post('jenis');
		$data['gl']						= $this->input->post('gl|numeric');
		$data['meter']				= $this->input->post('meter|numeric');
		$data['kg']						= $this->input->post('kg|numeric');
		$data['harga']				= $this->input->post('harga|numeric');
		$data['keterangan']		= $this->input->post('keterangan');
		$data['status_kain']	= $this->input->post('status');

		$data['distributor']	= $this->m_kain->get_all('t_distributor'); 
		$data['jenis']				= $this->m_kain->get_where('t_kain', array('status' => 'on')); 

		$this->template->admin('admin/kain/form_in', $data);

	}

	public function update_kain()
	{
		$data['title'] 		= "Master Kain";
		$data['subtitle'] = "Data Kain Masuk";
		$data['ontitle']	= "Update Data";

		$id_kain_in = $this->uri->segment(3);

		$kain_in = $this->m_kain->get_where('t_kain_in', array('id_kain_in' => $id_kain_in));
		$val_kain= $kain_in->row();

		$id_stok = $val_kain->id_kain;

		$stok_in = $this->m_kain->get_where('t_stok_kain', array('id_kain' => $id_stok));
		$val_stok = $stok_in->row();

		$tl_gl   	= $val_stok->total_gl 	- $val_kain->gl;
		$tl_mtr 	= $val_stok->total_meter - $val_kain->meter;
		$tl_kg 		= $val_stok->total_kg 		- $val_kain->kg;


		$array_stok = array(
			'total_gl'		=> $tl_gl,
			'total_meter'	=> $tl_mtr,
			'total_kg'		=> $tl_kg
		);

		

		if($this->input->post('submit', TRUE) == 'Submit'){
			$this->form_validation->set_rules('jenis', 'Jenis Kain', 'required|numeric');
			$this->form_validation->set_rules('gl', 'GL', 'required|numeric');
			$this->form_validation->set_rules('meter', 'Meter', 'required|numeric');
			$this->form_validation->set_rules('kg', 'Kilogram (Kg)', 'required|numeric');
			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
			$this->form_validation->set_rules('distributor', 'Distributor', 'required|numeric');
			$this->form_validation->set_rules('status', 'Status', 'required|numeric');

			if($this->form_validation->run() == TRUE)
			{
					$kain = array(
						'id_distributor'	=> $this->input->post('distributor', TRUE),
						'id_kain'					=> $this->input->post('jenis', TRUE),
						'gl'							=> $this->input->post('gl', TRUE),
						'meter'						=> $this->input->post('meter', TRUE),
						'kg'							=> $this->input->post('kg', TRUE),
						'harga'						=> $this->input->post('harga', TRUE),
						'keterangan' 			=> $this->input->post('keterangan', TRUE),
						'tgl'							=> $this->input->post('tgl', TRUE),
						'status_kain'			=> 1
					);

					$this->m_kain->update('t_kain_in', $kain, array('id_kain_in' => $id_kain_in));

					$this->m_kain->update('t_stok_kain', $array_stok, array('id_kain' => $id_stok));
					$total = $this->m_kain->get_where('t_stok_kain', array('id_kain' => $this->input->post('jenis', TRUE)));

						$key 				= $total->row();
						$id 				= $key->id_kain;
						$ttl_gl 		= $key->total_gl 		+ $this->input->post('gl', TRUE);
						$ttl_meter	= $key->total_meter + $this->input->post('meter', TRUE);
						$ttl_kg			= $key->total_kg 		+ $this->input->post('kg', TRUE);

						$total_kain = array(
							'id_kain'			=> $this->input->post('jenis', TRUE),
							'total_gl'		=> $ttl_gl,	
							'total_meter'	=> $ttl_meter,	
							'total_kg'		=> $ttl_kg	
						);

						if($total->num_rows() <= 0){
							$this->m_kain->insert('t_stok_kain', $total_kain);
						}
						elseif($id == $this->input->post('jenis', TRUE)){
							$this->m_kain->update('t_stok_kain', $total_kain, array('id_kain' => $id));
						}

						$this->session->set_flashdata('success', 'Data Berhasil Diupdate!!!');
						redirect('kain');
				
			}
				
		}

		$table = 't_kain_in ki JOIN t_distributor d ON (ki.id_distributor = d.id_distributor) JOIN t_kain k ON(ki.id_kain = k.id_kain)';

		$kain = $this->m_kain->get_where($table, array('id_kain_in' => $id_kain_in));
		foreach ($kain->result() as $key) {
			$data['dist']						= $key->id_distributor;
			$data['id_kain']				= $key->id_kain;
			$data['gl']							= $key->gl;
			$data['meter']					= $key->meter;
			$data['kg']							= $key->kg;
			$data['harga']					= $key->harga;
			$data['keterangan'] 		= $key->keterangan;
			$data['tgl']						= $key->tgl;
			$data['nama']						= $key->nama_kain;
			$data['status_kain']		= $key->status_kain;
		}

		$data['distributor']	= $this->m_kain->get_all('t_distributor'); 
		$data['jenis']				= $this->m_kain->get_all('t_kain'); 
		$this->template->admin('admin/kain/form_in', $data);
	}

	public function delete()
	{
		$id_kain_in = $this->uri->segment(3);

		$kain_in = $this->m_kain->get_where('t_kain_in', array('id_kain_in' => $id_kain_in));
		$val_kain= $kain_in->row();

		$id_stok = $val_kain->id_kain;

		if($val_kain->status_kain != 1){
			$this->m_kain->delete('t_kain_in', array('id_kain_in' => $id_kain_in));
		}
		else{
			$stok_in = $this->m_kain->get_where('t_stok_kain', array('id_kain' => $id_stok));
			$val_stok = $stok_in->row();

			$tl_gl   	= $val_stok->total_gl 	- $val_kain->gl;
			$tl_mtr 	= $val_stok->total_meter - $val_kain->meter;
			$tl_kg 		= $val_stok->total_kg 		- $val_kain->kg;


			$array_stok = array(
				'total_gl'		=> $tl_gl,
				'total_meter'	=> $tl_mtr,
				'total_kg'		=> $tl_kg
			);
			$this->m_kain->update('t_stok_kain', $array_stok, array('id_kain' => $id_stok));

			$this->m_kain->delete('t_kain_in', array('id_kain_in' => $id_kain_in));
		}

		
		$this->session->set_flashdata('success', 'Data berhasil di hapus!');
		redirect('kain');

	}

	public function detail()
	{
		$data['title']		= "Master Kain";
		$data['subtitle']	= "Data Kain Masuk";
		$data['ontitle']	= "Detail";
		$id = $this->uri->segment(3);
		$table = 't_kain_in ki JOIN t_kain k ON (ki.id_kain = k.id_kain) JOIN t_distributor d ON (ki.id_distributor = d.id_distributor)';
		$data['detail'] = $this->m_kain->get_where($table, array('ki.id_kain_in' => $id));
		// $dt = $detail->row();
		
		// $data['dest']				= $dt->nama_dest;
		// $data['alamat']			= $dt->alamat;
		// $data['telepon']		= $dt->telepon;
		// $data['tgl']				= $dt->tgl;
		// $data['nama_kain']	= $dt->nama_kain;
		// $data['gl']					= $dt->gl;
		// $data['meter']			= $dt->meter;
		// $data['kg']					= $dt->kg;
		// $data['harga']			= $dt->harga;

		$this->template->admin('admin/kain/detail_in', $data);
	}

	function cek_login()
	{
		if(!$this->session->userdata('login') == TRUE){
			redirect('login');
		}
	}




}

/* End of file Kain.php */
/* Location: ./application/controllers/Kain.php */