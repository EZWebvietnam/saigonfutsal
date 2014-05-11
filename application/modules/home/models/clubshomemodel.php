<?php
class Clubshomemodel extends CI_Model
{
	private $_name ='teams';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function load_fust()
	{
		$this->db->select();
		$this->db->where('id_team',1);
		$query = $this->db->get("{$this->_name}");
		return $query->result_array();
	}
}
?>