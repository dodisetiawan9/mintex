<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends CI_Controller {
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

		$data['benang']	= $this->m_model->order_by('t_dist_benang', 'id_dist_benang', 'DESC');
		$data['kain']		= $this->m_model->order_by('t_distributor', 'id_distributor', 'DESC');
		$this->template->admin('admin/distributor/list', $data);
	}

	public function add_benang()
	{
		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('dist', 'Distributor', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_dist'		=> $this->input->post('dist', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('telepon', TRUE)
				);

				$this->m_model->insert('t_dist_benang', $data);
				$this->session->set_flashdata('alert', 'Data berhasil disimpan!');
				redirect('distributor?benang=added');

			}
		}
	}

	public function update()
	{
		$id = $this->uri->segment(3);

		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('dist', 'Distributor', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_dist'		=> $this->input->post('dist', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('telepon', TRUE)
				);

				$this->m_model->update('t_dist_benang', $data, array('id_dist_benang' => $id));
				$this->session->set_flashdata('success', 'Data berhasil di update!');
				redirect('distributor?benang=updated');

			}
		}

		$data['title']		= 'Data Distributor';
		$data['subtitle']	= 'Edit Data';

		$benang = $this->m_model->get_where('t_dist_benang', array('id_dist_benang' => $id))->row();
		$data['dist'] 		= $benang->nama_dist;
		$data['alamat'] 	= $benang->alamat;
		$data['telepon']	= $benang->telepon;


		$this->template->admin('admin/distributor/form_benang', $data);

	}


	public function delete()
	{
		$id = $this->uri->segment(3);
		$this->m_model->delete('t_dist_benang', array('id_dist_benang' => $id));
		$this->session->set_flashdata('fail', 'Data berhasil dihapus!');
		redirect('distributor?benang=deleted');
	}

	public function add_kain()
	{
		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('dist', 'Distributor', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_dist'		=> $this->input->post('dist', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('telepon', TRUE)
				);

				$this->m_model->insert('t_distributor', $data);
				$this->session->set_flashdata('alert', 'Data berhasil disimpan!');
				redirect('distributor?kain=added');

			}
		}
	}

	public function kain_update()
	{
		$id = $this->uri->segment(3);
		if($this->input->post('submit', TRUE) == "Submit"){
			$this->form_validation->set_rules('dist', 'Distributor', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[5]');
			$this->form_validation->set_rules('telepon', 'Telepon', 'required|numeric');

			if($this->form_validation->run() == TRUE){
				$data = array(
					'nama_dist'		=> $this->input->post('dist', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('telepon', TRUE)
				);

				$this->m_model->update('t_distributor', $data, array('id_distributor' => $id));
				$this->session->set_flashdata('success', 'Data berhasil di update!');
				redirect('distributor?kain=updated');

			}
		}

		$data['title']		= 'Data Distributor';
		$data['subtitle']	= 'Edit Data';

		$benang = $this->m_model->get_where('t_distributor', array('id_distributor' => $id))->row();
		$data['dist'] 		= $benang->nama_dist;
		$data['alamat'] 	= $benang->alamat;
		$data['telepon']	= $benang->telepon;


		$this->template->admin('admin/distributor/form_kain', $data);
	}

	public function kain_delete()
	{
		$id = $this->uri->segment(3);
		$this->m_model->delete('t_distributor', array('id_distributor' => $id));
		$this->session->set_flashdata('fail', 'Data berhasil dihapus!');
		redirect('distributor?kain=deleted');
	}


	public function cek_login()
	{
		if(!$this->session->userdata('id_admin')){
			redirect('login');
		}
	}

}

/* End of file Distributor.php */
/* Location: ./application/controllers/Distributor.php */