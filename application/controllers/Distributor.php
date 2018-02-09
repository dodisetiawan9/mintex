<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distributor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cek_login();
		$this->load->library(array('template', 'form_validation'));
		$this->load->model('m_model');
	}

	public function index()
	{
		$data['title'] 		= 'Data Distributor';
		$data['subtitle'] = '';

		$data['data']	= $this->m_model->order_by('t_dist_benang', 'id_dist_benang', 'DESC');

		$this->template->admin('admin/distributor/dist', $data);
	}

	public function add_dist()
	{
		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->form_validation->set_rules('dist', 'Distributor', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]|max_length[15]');
			$this->form_validation->set_rules('phone', 'Telepon', 'required|numeric[3]|max_length[12]');

			if($this->form_validation->run() == TRUE)
			{
				$dist = array(
					'nama_dist'	=> $this->input->post('dist', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('phone', TRUE)
				);

				$this->m_model->insert('t_dist_benang', $dist);
				$this->session->set_flashdata('alert_benang', 'Data berhasil di simpan');
				redirect('distributor');
			}
		}
	}

	public function update()
	{
		$id = $this->uri->segment(3);
		$benang = $this->m_model->get_where('t_dist_benang', array('id_dist_benang' => $id))->row();

		$data['title'] = 'Distributor';
		$data['subtitle'] = 'Edit Data';
		$data['nama_dist'] = $benang->nama_dist;
		$data['alamat']		 = $benang->alamat;
		$data['telepon']	 = $benang->telepon;

		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->form_validation->set_rules('dist', 'Distributor', 'required|min_length[3]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[3]|max_length[15]');
			$this->form_validation->set_rules('phone', 'Telepon', 'required|numeric[3]|max_length[12]');

			if($this->form_validation->run() == TRUE)
			{
				$dist = array(
					'nama_dist'	=> $this->input->post('dist', TRUE),
					'alamat'		=> $this->input->post('alamat', TRUE),
					'telepon'		=> $this->input->post('phone', TRUE)
				);

				$this->m_model->update('t_dist_benang', $dist, array('id_dist_benang' => $id));
				$this->session->set_flashdata('success', 'Data berhasil di Update');
				redirect('distributor');
			}
		}

		$this->template->admin('admin/distributor/form', $data);
	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		$this->m_model->delete('t_dist_benang', array('id_dist_benang' => $id));
		$this->session->set_flashdata('deleted', 'Data berhasil dihapus!');
		redirect('distributor');
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