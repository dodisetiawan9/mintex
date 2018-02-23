<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benang_out extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->load->library(array('template', 'form_validation', 'pdfgenerator'));
		$this->load->model('m_benang');
	}

	public function index()
	{
		$data['title']		= "Master Benang";
		$data['subtitle']	= "Data Benang Masuk";

		$table = 't_benang_out ko JOIN t_dest_benang d ON (ko.id_dest = d.id_dest)';
		$data['data']	= $this->m_benang->order_by($table, 'ko.id_benang_out', 'DESC');
		$this->template->admin('admin/benang/benang_out', $data);
	}

	public function collect()
	{
		$id_benang 				= $this->input->post('jenis', TRUE);	
		if($this->input->post('submit', TRUE) == 'Submit'){
			$jenis_benang = $this->m_benang->get_where('t_benang', array('id_benang' => $id_benang))->row();
			$nama_jenis = $jenis_benang->nama_benang;

			//sortir data
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
			//end
			$benang[$id_benang] = array(
					'id_benang'				=> $this->input->post('jenis', TRUE),
					'nama_benang'			=> $nama_jenis,
					'b_karung'				=> $karung,
					'b_box'						=> $box,
					'ball'						=> $ball,
					'kg'							=> $kg,
					'harga'						=> $this->input->post('harga', TRUE),
				);


		if($this->session->userdata('dataBenang')){
			$dataBenang = $this->session->userdata('dataBenang');
		}
		else{
			$dataBenang = array();
		}
		
		array_push($dataBenang, $benang);
		$this->session->set_userdata('dataBenang', $dataBenang);

		redirect('benang_out/add_benang');
		
		}
	}

	public function add_benang()
	{
		$data['title']		= "Master Benang";
		$data['subtitle']	= "Data Benang Masuk";
		$data['ontitle']	= "Tambah Data Benang";
		// $this->session->unset_userdata('dataBenang');

		if($this->input->post('additem') == "Add")
		{
			$this->form_validation->set_rules('tgl', 'Tanggal', 'required');
			$this->form_validation->set_rules('destination', 'Destination', 'required');

			if($this->form_validation->run() == TRUE)
			{
				$benang_out = array(
					'id_dest'			=> $this->input->post('destination', TRUE),
					'keterangan'	=> $this->input->post('keterangan', TRUE),
					'tgl'					=> $this->input->post('tgl', TRUE),
					'status_bout'	=> 1
				);

				if($this->m_benang->insert('t_benang_out', $benang_out)){
					$id = $this->db->insert_id();
					foreach ($this->session->userdata('dataBenang') as $value) {
						foreach ($value as $row => $key) {
							$id_benang 		= $row;
							$benang_id		= $key['id_benang'];
							$nama_benang 	= $key['nama_benang'];
							$b_box 				= $key['b_box'];
							$b_karung 		= $key['b_karung'];
							$ball 				= $key['ball'];
							$kg 					= $key['kg'];
							$harga 				= $key['harga'];



							$detail_out = array(
							'id_benang_out'	=> $id,
							'id_benang'			=> $id_benang,
							'box'						=> $b_box,
							'karung'				=> $b_karung,
							'ball'					=> $ball,
							'kg'						=> $kg,
							'harga'					=> $harga
						);

							$this->m_benang->insert('t_detail_benang', $detail_out);
						}

						//prosess update
						$min_data = $this->m_benang->get_where('t_stok_benang', array('id_benang' => $benang_id))->row();

						$total_box 		= $min_data->total_box		 	- $b_box;
						$total_karung = $min_data->total_karung		- $b_karung;
						$total_ball 	= $min_data->total_ball 		- $ball;
						$total_kg 		= $min_data->total_kg		 		- $kg;

						$total_stok = array(
							'total_box'				=> $total_box,
							'total_karung'		=> $total_karung,
							'total_ball'			=> $total_ball,
							'total_kg'				=> $total_kg
						);

						if($this->m_benang->update('t_stok_benang', $total_stok, array('id_benang' => $benang_id))){

							$this->session->set_flashdata('success', 'Data sukses di tambahkan!');
							
						}
						//endprosess
					}		

						$this->session->unset_userdata('dataBenang');
						redirect('benang_out');
				}
			}
		}


		$data['tgl']					= $this->input->post('tgl');
		$data['id_dest']			= $this->input->post('destination');
		$data['bk']						= $this->input->post('bk');
		$data['keterangan']		= $this->input->post('keterangan');


		$table = 't_stok_benang sb JOIN t_benang b ON (sb.id_benang = b.id_benang)';

		$data['jenis']				= $this->m_benang->get_all($table); 
		$data['dest']					= $this->m_benang->get_all('t_dest_benang');

		$this->template->admin('admin/benang/form_out', $data);
	}

	public function update()
	{
		$data['title'] 		= "Master Kain";
		$data['subtitle'] = "Data Benang Keluar";
		$data['ontitle']	= "Update Data";
		$id = $this->uri->segment(3);

			//proses
		if($this->input->post('submit', TRUE) == 'Submit'){
			$this->form_validation->set_rules('tgl' ,'Tanggal', 'required');
			$this->form_validation->set_rules('destination' ,'Destination', 'required');
			$this->form_validation->set_rules('status' ,'Status', 'required');

			if($this->form_validation->run() == TRUE)
			{
				$benang_out = array(
					'id_dest'			=> $this->input->post('destination', TRUE),
					'keterangan'	=> $this->input->post('keterangan', TRUE),
					'tgl'					=> $this->input->post('tgl', TRUE),
					'status_bout'	=> $this->input->post('status', TRUE)
				);

				$this->m_benang->update('t_benang_out', $benang_out, array('id_benang_out' => $id));
			}
			$this->session->set_flashdata('alert', 'Data berhasil diupdate!');
			redirect('benang_out');
		}

		//endproses

		$table = 't_benang_out ko JOIN t_detail_benang do ON (ko.id_benang_out = do.id_benang_out) JOIN t_dest_benang d ON (ko.id_dest = d.id_dest) JOIN t_benang k ON (do.id_benang = k.id_benang)';
		$data['dest']	= $this->m_benang->get_all('t_dest_benang');

		$data['edit']	= $this->m_benang->get_where($table, array('ko.id_benang_out' => $id));
		
		$this->template->admin('admin/benang/edit_out', $data);
	}

	public function detail()
	{
		$data['title']		= "Master Benang";
		$data['subtitle']	= "Data Benang Keluar";
		$data['ontitle']	= "Detail";
		$id = $this->uri->segment(3);

		$table = 't_benang_out ko JOIN t_detail_benang do ON (ko.id_benang_out = do.id_benang_out) JOIN t_dest_benang d ON (ko.id_dest = d.id_dest) JOIN t_benang k ON (do.id_benang = k.id_benang)';
		$data['detail'] = $this->m_benang->get_where($table, array('ko.id_benang_out' => $id));

		$this->template->admin('admin/benang/detail_out', $data);
	}

	public function print()
	{
		$id = $this->uri->segment(3);

		$table = 't_benang_out ko JOIN t_detail_benang do ON (ko.id_benang_out = do.id_benang_out) JOIN t_dest_benang d ON (ko.id_dest = d.id_dest) JOIN t_benang k ON (do.id_benang = k.id_benang)';
		$data['dataout'] = $this->m_benang->get_where($table, array('ko.id_benang_out' => $id));
		$html = $this->load->view('admin/benang/print_out', $data, true);
	    
	  $this->pdfgenerator->generate($html,'surat jalan');
	}

	public function delete()
	{
		$id 			= $this->uri->segment(3);
		$table 		= 't_benang_out ko JOIN t_detail_benang do ON (ko.id_benang_out = do.id_benang_out)';
		$benang		= $this->m_benang->get_where($table, array('ko.id_benang_out' => $id));
		$val    	= $benang->row();
		$id_benang= $val->id_benang;
		$status   = $val->status_bout;

		if($status != 1){
			$this->m_benang->delete('t_benang_out', array('id_benang_out' => $id));
			$this->m_benang->delete('t_detail_benang', array('id_benang_out' => $id));
		}
		else{

				$stok = $this->m_benang->get_where('t_stok_benang', array('id_benang' => $id_benang))->row();

				$total_box 		= $stok->total_box 		+ $val->box;
				$total_karung = $stok->total_karung + $val->karung;
				$total_ball 	= $stok->total_ball 	+ $val->ball;
				$total_kg 		= $stok->total_kg 		+ $val->kg;

				$total_benang = array(
					'total_box'			=> $total_box,	
					'total_karung'	=> $total_karung,	
					'total_ball'		=> $total_ball,	
					'total_kg'			=> $total_kg	
				);

				$this->m_benang->update('t_stok_benang', $total_benang, array('id_benang' => $id_benang));
				$this->m_benang->delete('t_benang_out', array('id_benang_out' => $id));
				$this->m_benang->delete('t_detail_benang', array('id_benang_out' => $id));

		}

		$this->session->set_flashdata('alert', 'Data berhasil dihapus!');
		redirect('benang_out');
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