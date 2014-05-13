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
	public function load_team($number,$offset)
	{
		$sql="SELECT * FROM {$this->_name} WHERE status = 1 LIMIT ?,?";	
		$query=$this->db->query($sql,array($offset,$number));
		return $query->result_array();
	}
	public function count_load_team()
	{
		$sql="SELECT * FROM {$this->_name} WHERE status = 1";	
		$query=$this->db->query($sql);
		return count($query->result_array());
	}
}
?>