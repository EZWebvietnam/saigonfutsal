<?php
class Messagemodel extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function list_message($number,$offset)
    {
        $sql="SELECT * FROM message LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_message()
    {
        $sql="SELECT * FROM message";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function message_detail($id_message)
    {
        $sql="SELECT * FROM message_detail INNER JOIN users ON users.id = message_detail.id_user WHERE message_detail.id_message = $id_message";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function insert_message(array $data)
    {
        $this->db->insert('message',$data);
        return $this->db->insert_id();
    }
    public function insert_message_detail(array $data)
    {
        $this->db->insert('message_detail',$data);
        return $this->db->insert_id();
    }
    public function message_detail_($id)
    {
        $this->db->select();
        $this->db->where('id',$id);
        $query = $this->db->get('message');
        return $query->result_array();
    }
    public function update($id,array $data)
    {
        $this->db->where('id',$id);
        $this->db->update('message',$data);
    }
    public function delete($id)
    {
        $this->db->delete('message',array('id'=>$id));
        $this->db->delete('message_detail',array('id_message'=>$id));
    }
}
?>