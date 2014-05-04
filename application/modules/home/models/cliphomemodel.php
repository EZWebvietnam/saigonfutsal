<?php
class Cliphomemodel extends CI_Model
{
	private $_name = 'clips';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function clip_famous()
	{
		$this->db->select();
		$this->db->order_by('create_date DESC');
		$this->db->limit(5);
		$query = $this->db->get("{$this->_name}");
		return $query->result_array();
	}
}
?>