<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->load->model('m_model');
		$this->load->library(array('template','form_validation'));
	}

	public function index()
	{
		$data['title']	= "Data Jenis Barang";

		$data['kain']		= $this->m_model->order_by('t_kain', 'id_kain', 'DESC');
		$data['benang']	= $this->m_model->order_by('t_benang', 'id_benang', 'DESC');
		$this->template->admin('admin/jenis/list', $data);
	}

	public function add_benang()
	{
		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('jenis', 'Jenis Benang', 'required|min_length[3]');
			$this->form_validation->set_rules('status', 'status', 'required');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_benang'		=> $this->input->post('jenis', TRUE),
					'status'			  => $this->input->post('status', TRUE)
				);

				$this->m_model->insert('t_benang', $data);
				$this->session->set_flashdata('alert', 'Data berhasil disimpan!');
				redirect('jenis?benang=added');

			}
		}
	}

	public function update()
	{
		$id = $this->uri->segment(3);

		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('jenis', 'Jenis Benang', 'required|min_length[3]');
			$this->form_validation->set_rules('status', 'status', 'required');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_benang'		=> $this->input->post('jenis', TRUE),
					'status'			  => $this->input->post('status', TRUE)
				);

				$this->m_model->update('t_benang', $data, array('id_benang' => $id));
				$this->session->set_flashdata('success', 'Data berhasil di update!');
				redirect('jenis?benang=updated');

			}
		}

		$data['title']		= 'Data Jenis Benang';
		$data['subtitle']	= 'Edit Data';

		$benang = $this->m_model->get_where('t_benang', array('id_benang' => $id))->row();
		$data['jenis'] 		= $benang->nama_benang;
		$data['status'] 	= $benang->status;
		


		$this->template->admin('admin/jenis/form_benang', $data);

	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		$this->m_model->delete('t_benang', array('id_benang' => $id));
		$this->session->set_flashdata('fail', 'Data berhasil dihapus!');
		redirect('jenis?benang=deleted');
	}

	//proses destination kain
	public function add_kain()
	{
		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('jenis', 'Jenis Kain', 'required|min_length[3]');
			$this->form_validation->set_rules('status', 'status', 'required');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_kain'		=> $this->input->post('jenis', TRUE),
					'status'			=> $this->input->post('status', TRUE)
				);

				$this->m_model->insert('t_kain', $data);
				$this->session->set_flashdata('alert', 'Data berhasil disimpan!');
				redirect('jenis?kain=added');

			}
		}
	}

	public function kain_update()
	{
		
		$id = $this->uri->segment(3);

		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('jenis', 'Jenis Kain', 'required|min_length[3]');
			$this->form_validation->set_rules('status', 'status', 'required');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_kain'			=> $this->input->post('jenis', TRUE),
					'status'			  => $this->input->post('status', TRUE)
				);

				$this->m_model->update('t_kain', $data, array('id_kain' => $id));
				$this->session->set_flashdata('success', 'Data berhasil di update!');
				redirect('jenis?kain=updated');

			}
		}

		$data['title']		= 'Data Jenis Kain';
		$data['subtitle']	= 'Edit Data';

		$kain = $this->m_model->get_where('t_kain', array('id_kain' => $id))->row();
		$data['jenis'] 		= $kain->nama_kain;
		$data['status'] 	= $kain->status;
		


		$this->template->admin('admin/jenis/form_kain', $data);
	}

	public function kain_delete()
	{
		$id = $this->uri->segment(3);
		$this->m_model->delete('t_kain', array('id_kain' => $id));
		$this->session->set_flashdata('fail', 'Data berhasil dihapus!');
		redirect('jenis?kain=deleted');
	}


	public function cek_login()
	{
		if(!$this->session->userdata('id_admin')){
			redirect('login');
		}
	}

}

/* End of file Jenis.php */
/* Location: ./application/controllers/Jenis.php */