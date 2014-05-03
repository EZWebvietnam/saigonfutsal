<?php
class Productmodel extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function list_product($number,$offset)
    {
        //$sql ="SELECT * FROM product LIMIT $offset,$number";
        $sql ="SELECT * FROM product LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_product()
    {
        //$sql ="SELECT * FROM product";
        $sql ="SELECT * FROM product";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function delete_product($id)
    {
        $this->db->delete('product',array('id_product'=>$id));
    }
    public function view_product($id)
    {
        $id = intval($id);
        $sql ="SELECT * FROM product WHERE id_product = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function add_product(array $data)
    {
        $this->db->insert('product',$data);
        return $this->db->insert_id();
    }
    public function update_product($id,array $data)
    {
        $id = intval($id);
        $this->db->where('id_product',$id);
        $this->db->update('product',$data);
    }
    public function delete_user_product($id_product)
    {
        $this->db->delete('user_product',array('id_product'=>$id_product));
    }
     public function delete_user_product_2($id_user)
    {
        $this->db->delete('user_product',array('id_user'=>$id_user));
    }
    public function insert_clip(array $data)
    {
        $this->db->insert('clip_marketing',$data);
        return $this->db->insert_id();
    }
    public function delete_clip($id)
    {
        $this->db->delete('clip_marketing',array('id_product'=>$id));
    }
    public function list_mail_book($number,$offset)
    {
        $sql ="SELECT * FROM mail_book LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_mail_book()
    {
        $sql ="SELECT * FROM mail_book";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function delete_mail($id)
    {
        $this->db->delete('mail_book',array('id'=>$id));
    }
     public function insert_mail_book(array $data)
    {
        $this->db->insert('mail_book',$data);
        return $this->db->insert_id();
    }
    public function detail_mail_book($id)
    {
        $sql ="SELECT * FROM mail_book WHERE id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function update_mail_book($id,array $data)
    {
        $id = intval($id);
        $this->db->where('id',$id);
        $this->db->update('mail_book',$data);
    }
    public function list_customer($number,$offset)
    {
        $sql ="SELECT * FROM mail_book_customer LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_customer()
    {
        $sql ="SELECT * FROM mail_book_customer";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function delete_mail_customer($id)
    {
        $this->db->delete('mail_book_customer',array('id'=>$id));
    }
}
?>