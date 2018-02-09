<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	function insert($table = '', $data='')
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	
	function get_where($table = null, $where = null)
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}

	function get_all($table = '')
	{
		$this->db->from($table);
		return $this->db->get();
	}

	function order_by($table, $where, $order)
	{
		$this->db->from($table);
		$this->db->order_by($where, $order);
		return $this->db->get();
	}

	function update($table = null, $data = null, $where = null)
	{
		$this->db->update($table, $data, $where);
	}

	function delete($table = null, $where= null)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

}

/* End of file M_model.php */
/* Location: ./application/models/M_model.php */