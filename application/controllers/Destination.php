<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destination extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->load->model('m_model');
		$this->load->library(array('template','form_validation'));
	}

	public function index()
	{
		$data['title']	= "Data Distributor";
		$data['benang']	= $this->m_model->order_by('t_dest_benang', 'id_dest', 'DESC');
		$data['kain']		= $this->m_model->order_by('t_dest', 'id_dest', 'DESC');
		$this->template->admin('admin/destination/list', $data);
	}

	public function add_benang()
	{
		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('dest', 'Destination', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_dest'		=> $this->input->post('dest', TRUE),
					'alamat'			=> $this->input->post('alamat', TRUE),
					'telepon'			=> $this->input->post('telepon', TRUE)
				);

				$this->m_model->insert('t_dest_benang', $data);
				$this->session->set_flashdata('alert', 'Data berhasil disimpan!');
				redirect('destination?benang=added');

			}
		}
	}

	public function update()
	{
		$id = $this->uri->segment(3);

		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('dest', 'Destination', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_dest'		=> $this->input->post('dest', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('telepon', TRUE)
				);

				$this->m_model->update('t_dest_benang', $data, array('id_dest' => $id));
				$this->session->set_flashdata('success', 'Data berhasil di update!');
				redirect('destination?benang=updated');

			}
		}

		$data['title']		= 'Data Distributor';
		$data['subtitle']	= 'Edit Data';

		$benang = $this->m_model->get_where('t_dest_benang', array('id_dest' => $id))->row();
		$data['dist'] 		= $benang->nama_dest;
		$data['alamat'] 	= $benang->alamat;
		$data['telepon']	= $benang->telepon;


		$this->template->admin('admin/destination/form_benang', $data);

	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		$this->m_model->delete('t_dest_benang', array('id_dest' => $id));
		$this->session->set_flashdata('fail', 'Data berhasil dihapus!');
		redirect('destination?benang=deleted');
	}

	//proses destination kain
	public function add_kain()
	{
		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('dest', 'Destination', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_dest'		=> $this->input->post('dest', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('telepon', TRUE)
				);

				$this->m_model->insert('t_dest', $data);
				$this->session->set_flashdata('alert', 'Data berhasil disimpan!');
				redirect('destination?kain=added');

			}
		}
	}

	public function kain_update()
	{
		$id = $this->uri->segment(3);
		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('dest', 'Distributor', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_dest'		=> $this->input->post('dest', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('telepon', TRUE)
				);

				$this->m_model->update('t_dest', $data, array('id_dest' => $id));
				$this->session->set_flashdata('success', 'Data berhasil di update!');
				redirect('destination?kain=updated');

			}
		}

		$data['title']		= 'Data Distributor';
		$data['subtitle']	= 'Edit Data';

		$benang = $this->m_model->get_where('t_dest', array('id_dest' => $id))->row();
		$data['dist'] 		= $benang->nama_dest;
		$data['alamat'] 	= $benang->alamat;
		$data['telepon']	= $benang->telepon;


		$this->template->admin('admin/destination/form_kain', $data);
	}

	public function kain_delete()
	{
		$id = $this->uri->segment(3);
		$this->m_model->delete('t_dest', array('id_dest' => $id));
		$this->session->set_flashdata('fail', 'Data berhasil dihapus!');
		redirect('destination?kain=deleted');
	}

	public function cek_login()
	{
		if(!$this->session->userdata('id_admin')){
			redirect('login');
		}
	}

}

/* End of file Destination.php */
/* Location: ./application/controllers/Destination.php */