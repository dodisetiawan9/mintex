<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kain_out extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->load->model('m_kain');
		$this->load->library(array('template', 'form_validation', 'pdfgenerator'));
	}

	public function index()
	{
		$data['title']		= "Master Kain";
		$data['subtitle']	= "Data Kain Keluar";
		$dtaa['ontitle']	= "Tambah data";

		$table = 't_kain_out ko JOIN t_dest d ON (ko.id_dest = d.id_dest)';
		$data['data']	= $this->m_kain->order_by($table, 'ko.id_kain_out', 'DESC');

		$this->template->admin('admin/kain/kain_out', $data);
	}


	function collect()
	{
		$id_kain 				= $this->input->post('jenis', TRUE);	
		if($this->input->post('submit', TRUE) == 'Submit'){
			$jenis_kain = $this->m_kain->get_where('t_kain', array('id_kain' => $id_kain))->row();
			$nama_jenis = $jenis_kain->nama_kain;
		}
			$kain[$id_kain] = array(
				'id_kain'			=> $this->input->post('jenis', TRUE),
				'nama_kain'		=> $nama_jenis,
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

	public function add_item()
	{
		$data['title']		= "Master Kain";
		$data['subtitle']	= "Data Kain Keluar";
		$data['ontitle']	= "Tambah data";


		if($this->input->post('additem') == "Add")
		{
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');
			$this->form_validation->set_rules('destination', 'Destination', 'required');

			if($this->form_validation->run() == TRUE)
			{
				$kain_out = array(
					'id_dest'			=> $this->input->post('destination', TRUE),
					'keterangan'	=> $this->input->post('keterangan', TRUE),
					'tgl'					=> $this->input->post('tgl', TRUE),
					'status_out'	=> 1
				);

				if($this->m_kain->insert('t_kain_out', $kain_out)){
					$id = $this->db->insert_id();
					foreach ($this->session->userdata('dataKain') as $value) {
						foreach ($value as $row => $key) {
							$id_kain 		= $row;
							$kain_id		= $key['id_kain'];
							$nama_kain 	= $key['nama_kain'];
							$gl 				= $key['gl'];
							$meter 			= $key['meter'];
							$kg 				= $key['kg'];
							$harga 			= $key['harga'];


					
						$detail_out = array(
							'id_kain_out'	=> $id,
							'id_kain'			=> $id_kain,
							'gl'					=> $gl,
							'meter'				=> $meter,
							'kg'					=> $kg,
							'harga'				=> $harga,
						);
							
							$this->m_kain->insert('t_detail_out', $detail_out);

							
						}
						//proses update

						$min_data = $this->m_kain->get_where('t_stok_kain', array('id_kain' => $kain_id))->row();

						$total_gl 		= $min_data->total_gl		 - $gl;
						$total_meter 	= $min_data->total_meter - $meter;
						$total_kg 		= $min_data->total_kg		 - $kg;

						$total_stok = array(
							'total_gl'		=> $total_gl,
							'total_meter'	=> $total_meter,
							'total_kg'		=> $total_kg
						);

						if($this->m_kain->update('t_stok_kain', $total_stok, array('id_kain' => $kain_id))){

							$this->session->set_flashdata('success', 'Data sukses di tambahkan!');
							
						}
						//end proses
					}

						

						$this->session->unset_userdata('dataKain');
						redirect('kain_out');
				
				}
			}
		}


		$data['tgl']					= $this->input->post('tgl');
		$data['id_dest']			= $this->input->post('destination');
		$data['id_kain']			= $this->input->post('jenis');
		$data['gl']						= $this->input->post('gl');
		$data['meter']				= $this->input->post('meter');
		$data['kg']						= $this->input->post('kg');
		$data['harga']				= $this->input->post('harga');
		$data['keterangan']		= $this->input->post('keterangan');

		$table = 't_stok_kain sk JOIN t_kain k ON (sk.id_kain = k.id_kain)';
		// $data['jenis_kain'] 	= $this->m_kain->get_all($table);

		$data['dest']					= $this->m_kain->get_all('t_dest'); 
		$data['jenis']				= $this->m_kain->get_all($table); 
		$this->template->admin('admin/kain/form_out', $data);
	}

	public function update()
	{
		$data['title'] 		= "Master Kain";
		$data['subtitle'] = "Data Kain Keluar";
		$data['ontitle']	= "Update Data";
		$id = $this->uri->segment(3);
		//proses
		if($this->input->post('submit', TRUE) == 'Submit'){
			$this->form_validation->set_rules('tgl' ,'Tanggal', 'required');
			$this->form_validation->set_rules('destination' ,'Destination', 'required');
			$this->form_validation->set_rules('status' ,'Status', 'required');

			if($this->form_validation->run() == TRUE)
			{
				$kain_out = array(
					'id_dest'			=> $this->input->post('destination', TRUE),
					'keterangan'	=> $this->input->post('keterangan', TRUE),
					'tgl'					=> $this->input->post('tgl', TRUE),
					'status_out'	=> $this->input->post('status', TRUE)
				);

				$this->m_kain->update('t_kain_out', $kain_out, array('id_kain_out' => $id));
			}
			$this->session->set_flashdata('alert', 'Data berhasil diupdate!');
			redirect('kain_out');
		}

		//endproses

		$table = 't_kain_out ko JOIN t_detail_out do ON (ko.id_kain_out = do.id_kain_out) JOIN t_dest d ON (ko.id_dest = d.id_dest) JOIN t_kain k ON (do.id_kain = k.id_kain)';
		$data['dest']	= $this->m_kain->get_all('t_dest');

		$data['edit']	= $this->m_kain->get_where($table, array('ko.id_kain_out' => $id));
		
		$this->template->admin('admin/kain/edit_out', $data);
	}

	public function detail()
	{
		$data['title']		= "Master Kain";
		$data['subtitle']	= "Data Kain Keluar";
		$data['ontitle']	= "Detail";
		$id = $this->uri->segment(3);
		$table = 't_kain_out ko JOIN t_detail_out do ON (ko.id_kain_out = do.id_kain_out) JOIN t_dest d ON (ko.id_dest = d.id_dest) JOIN t_kain k ON (do.id_kain = k.id_kain)';
		$data['detail'] = $this->m_kain->get_where($table, array('ko.id_kain_out' => $id));
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

		$this->template->admin('admin/kain/detail_out', $data);
	}

	public function print()
	{
		$id = $this->uri->segment(3);

		$table = 't_kain_out ko JOIN t_detail_out do ON (ko.id_kain_out = do.id_kain_out) JOIN t_dest d ON (ko.id_dest = d.id_dest) JOIN t_kain k ON (do.id_kain = k.id_kain)';
		$data['dataout'] = $this->m_kain->get_where($table, array('ko.id_kain_out' => $id));
		// foreach ($out->result() as $key) {
		// 	$data['dest']				= $key->nama_dest;
		// 	$data['jenis']			= $key->nama_kain;
		// 	$data['gl']					= $key->gl;
		// 	$data['meter']			= $key->meter;
		// 	$data['kg']					= $key->kg;
		// 	$data['harga']			= $key->harga;
		// 	$data['tgl']				= $key->tgl;
		// 	$data['keterangan']	= $key->keterangan;
		// 	$data['alamat']			= $key->alamat;
		// 	$data['phone']			= $key->telepon;

		//  }


		// $this->load->library('pdfgenerator');
 
	    $html = $this->load->view('admin/kain/print_out', $data, true);
	    
	    $this->pdfgenerator->generate($html,'contoh');

		// // Load all views as normal
		// $this->load->view('admin/print_out', $data);
		// // Get output html
		// $html = $this->output->get_output();
		
		// // Load library
		// $this->load->library('dompdf_gen');
		
		// // Convert to PDF
		// $this->dompdf->load_html($html);
		// $this->dompdf->render();
		// // $this->dompdf->stream("welcome.pdf");
		// $this->dompdf->stream("welcome.pdf", array('Attachment' => 0));
		// $this->load->view('admin/print_out', $data);

	}

	public function delete()
	{
		$id 			= $this->uri->segment(3);
		$table 		= 't_kain_out ko JOIN t_detail_out do ON (ko.id_kain_out = do.id_kain_out)';
		$kain 		= $this->m_kain->get_where($table, array('ko.id_kain_out' => $id));
		$val    	= $kain->row();
		$id_kain	= $val->id_kain;
		$status   = $val->status_out;

		if($status != 1){
			$this->m_kain->delete('t_kain_out', array('id_kain_out' => $id));
			$this->m_kain->delete('t_detail_out', array('id_kain_out' => $id));
		}else{

				$stok = $this->m_kain->get_where('t_stok_kain', array('id_kain' => $id_kain))->row();

				$total_gl 		= $stok->total_gl		 + $val->gl;
				$total_meter 	= $stok->total_meter + $val->meter;
				$total_kg 		= $stok->total_kg		 + $val->kg;

				$total_stok = array(
					'total_gl'		=> $total_gl,
					'total_meter'	=> $total_meter,
					'total_kg'		=> $total_kg
				);

				$this->m_kain->update('t_stok_kain', $total_stok, array('id_kain' => $id_kain));
				$this->m_kain->delete('t_kain_out', array('id_kain_out' => $id));
				$this->m_kain->delete('t_detail_out', array('id_kain_out' => $id));

		}
		
		$this->session->set_flashdata('alert', 'Data berhasil dihapus!');
		redirect('kain_out');
	}

	function cek_login()
	{
		if(!$this->session->userdata('login') == TRUE){
			redirect('login');
		}
	}


}

/* End of file Kain_out.php */
/* Location: ./application/controllers/Kain_out.php */