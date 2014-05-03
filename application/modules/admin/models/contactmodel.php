<?php
class Contactmodel extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function list_contact($number,$offset)
    {
        $sql="SELECT * FROM contact LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_contact()
    {
        $sql="SELECT * FROM contact";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function edit($id)
    {
        $sql="SELECT * FROM contact WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function update($id,array $data)
    {
        $this->db->where('id',$id);
        $this->db->update('contact',$data);
    }
    public function delete($id)
    {
        $this->db->delete('contact',array('id'=>$id));
    }
    public function get_info()
    {
        $this->db->select();
        $this->db->where('id',1);
        $query = $this->db->get('info_company');
        return $query->result_array();
    }
    public function update_info($id,array $data)
    {
        $this->db->where('id',$id);
        $this->db->update('info_company',$data);
    }
    public function get_about()
    {
        $sql="SELECT * FROM about WHERE id = 1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function update_about(array $data)
    {
        $this->db->where('id',1);
        $this->db->update('about',$data);
    }
}
?>