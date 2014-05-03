<?php
class Ordermodel extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function list_order($id)
    {
        $sql="SELECT *,order_customer.id as id_order_c FROM order_customer INNER JOIN order_detail ON order_detail.order_id = order_customer.id WHERE order_detail.id_ref = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function list_order_dt($id)
    {
        $sql="SELECT * FROM order_detail WHERE order_id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function tien_da_linh($id_user)
    {
        $sql="SELECT * FROM order_detail INNER JOIN order_customer ON order_detail.order_id = order_customer.id WHERE order_customer.status = 1 AND order_detail.status_money = 1 AND order_detail.id_ref = $id_user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function list_order_($number,$offset)
    {
        $sql="SELECT * FROM order_customer LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_order()
    {
         $sql="SELECT * FROM order_customer";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function list_order_detail()
    {
       $sql="SELECT * FROM order_detail INNER JOIN order_customer ON order_customer.id = order_detail.order_id";
       $query = $this->db->query($sql);
       return $query->result_array(); 
    }
    public function delete_order($id)
    {
        $this->db->delete('order_customer',array('id'=>$id));
        $this->db->delete('order_detail',array('order_id'=>$id));
    }
    public function order_view($id)
    {
        $this->db->select();
        $this->db->where('id',$id);
        $query = $this->db->get('order_customer');
        return $query->result_array();
    }
    public function order_detail_view($id)
    {
        $sql="SELECT * FROM order_detail INNER JOIN product ON product.id_product = order_detail.id_product WHERE order_detail.order_id = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function update_order($id,array $data)
    {
        $this->db->where('id',$id);
        $this->db->update('order_customer',$data);
    }
    public function order_detail_list($number,$offset)
    {
        $sql="SELECT *,order_detail.id as id_order_detail,order_detail.id_ref as id_ref_detail FROM order_detail  INNER JOIN order_customer ON order_customer.id = order_detail.order_id LEFT JOIN users ON order_detail.id_ref = users.id INNER JOIN product ON product.id_product = order_detail.id_product LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_order_detail()
    {
        $sql="SELECT * FROM order_detail INNER JOIN order_customer ON order_customer.id = order_detail.order_id LEFT JOIN users ON order_detail.id_ref = users.id INNER JOIN product ON product.id_product = order_detail.id_product";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function update_order_detail($id,array $data)
    {
        $this->db->where('id',$id);
        $this->db->update('order_detail',$data);
    }
}
?>