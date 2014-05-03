<?php
class Messagectv extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function list_message($id_user,$number,$offset)
    {
        $sql="SELECT *,message.id as id_message FROM message_detail INNER JOIN message ON message.id = message_detail.id_message WHERE message_detail.id_user = $id_user LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_message($id_user)
    {
        $sql="SELECT *,message.id as id_message FROM message_detail INNER JOIN message ON message.id = message_detail.id_message WHERE message_detail.id_user = $id_user";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function view($id)
    {
        $this->db->select();
        $this->db->where('id',$id);
        $query = $this->db->get('message');
        return $query->result_array();
    }
    public function update($id,$id_user,array $data)
    {
        $this->db->where('id_message',$id);
        $this->db->where('id_user',$id_user);
        $this->db->update('message_detail',$data);
    }
    public function delete($id)
    {
         $this->db->delete('message_detail',array('id_message'=>$id));
    }
    
}
?>
