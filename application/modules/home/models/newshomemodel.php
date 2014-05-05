<?php
class Newshomemodel extends CI_Model
{
	private $_name = 'news';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function news_home_famous()
	{
		$this->db->select();
		$this->db->where('is_famous',1);
		$this->db->order_by('rand()');
		$this->db->limit(1);
		$query = $this->db->get("{$this->_name}");
		return $query->result_array();
	}
	public function news_home_sub($id_new_slide)
	{
		$id_new_slide = addslashes($id_new_slide);
		$sql="SELECT * FROM {$this->_name} WHERE id_new NOT IN ($id_new_slide) ORDER BY create_date DESC LIMIT 3";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function news_home_1($id_cate,$id_new_slide)
	{
		$id_new_slide = addslashes($id_new_slide);
		$id_cate = intval($id_cate);
		$sql="SELECT * FROM {$this->_name} WHERE id_new NOT IN ($id_new_slide) AND id_cate = $id_cate ORDER BY create_date DESC LIMIT 3";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
}
?>