<?php
class Donorshomemodel extends CI_Model
{
	private $_name ='donors';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_donors()
	{
		$this->db->select();
		$query = $this->db->get("{$this->_name}");
		return $query->result_array();
	}
}
?>