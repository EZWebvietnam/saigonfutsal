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
		$sql="SELECT * FROM {$this->_name} WHERE is_famous = 1 ORDER BY rand() LIMIT 1";
		$query = $this->db->query($sql);
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
	public function new_detail($id_cate,$id_post)
	{
		$id_cate = intval($id_cate);
		$id_post = intval($id_post);
		$sql ="SELECT * FROM {$this->_name} WHERE id_new = $id_post AND id_cate = $id_cate";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function new_detail_with_id_cate($id_cate,$id_post)
	{
		$id_post = intval($id_post);
		$id_cate = intval($id_cate);
		$sql ="SELECT *,{$this->_name}.title as title_new,cate_new.title as title_cate FROM {$this->_name} INNER JOIN cate_new ON cate_new.id_catenew = {$this->_name}.id_cate WHERE  id_cate = $id_cate AND {$this->_name}.id_new NOT IN($id_post) ORDER BY rand()";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function new_detail_top($id_post)
	{
		$id_post = intval($id_post);
		$sql ="SELECT *,{$this->_name}.title as title_new,cate_new.title as title_cate FROM {$this->_name} INNER JOIN cate_new ON cate_new.id_catenew = {$this->_name}.id_cate WHERE  {$this->_name}.id_new NOT IN($id_post) AND {$this->_name}.view >= 100 ORDER BY rand()  LIMIT 2";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function list_new_cate($id_cate,$number,$offset)
	{
		$id_cate = intval($id_cate);
		$sql ="SELECT *,{$this->_name}.title as title_new,cate_new.title as title_cate FROM {$this->_name} INNER JOIN cate_new ON cate_new.id_catenew = {$this->_name}.id_cate WHERE  id_cate = $id_cate  ORDER BY {$this->_name}.id_new LIMIT ?,?";
		$query=$this->db->query($sql,array($offset,$number));
		return $query->result_array();	
	}
	public function count_new_cate($id_cate)
	{
		$id_cate = intval($id_cate);
		$sql ="SELECT *,{$this->_name}.title as title_new,cate_new.title as title_cate FROM {$this->_name} INNER JOIN cate_new ON cate_new.id_catenew = {$this->_name}.id_cate WHERE  id_cate = $id_cate  ORDER BY {$this->_name}.id_new";
		$query=$this->db->query($sql);
		return count($query->result_array());	
	}
}
?>