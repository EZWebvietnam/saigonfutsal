<?php
class Faqmodel extends CI_Model
{
    public  function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function list_faq($number,$offset)
    {
        $sql="SELECT * FROM faq LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_faq()
    {
        $sql="SELECT * FROM faq";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function edit($id)
    {
        $this->db->select();
        $this->db->where('id',$id);
        $query = $this->db->get('faq');
        return $query->result_array();
    }
    public function update_faq($id,array $data)
    {
        $this->db->where('id',$id);
        $this->db->update('faq',$data);
    }
    public function delete($id)
    {
        $this->db->delete('faq',array('id'=>$id));
    }
}
?>