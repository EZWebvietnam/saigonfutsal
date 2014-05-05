<?php
class Catenewhomemodel extends CI_Model
{
	private $_name = 'cate_new';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function load_cate_new()
	{
		$this->db->select();
		$query = $this->db->get("{$this->_name}");
		return $query->result_array();
	}
}
?>