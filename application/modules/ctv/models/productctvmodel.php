<?php 
class Productctvmodel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function load_product_ref($id)
    {
        $id = intval($id);
        $sql="SELECT *,user_product.id as user_product_id FROM user_product INNER JOIN product ON user_product.id_product = product.id_product INNER JOIN users ON users.id = user_product.id_user WHERE user_product.id_user = $id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function list_product($id_user,$number,$offset)
    {
        $id_user = intval($id_user);
        $number = intval($number);
        $offset = intval($offset);
        $sql ="SELECT *,user_product.id as user_product_id FROM user_product INNER JOIN product ON user_product.id_product = product.id_product WHERE user_product.id_user = $id_user LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_list_product($id_user)
    {
        $id_user = intval($id_user);
        $sql ="SELECT *,user_product.id as user_product_id FROM user_product INNER JOIN product ON user_product.id_product = product.id_product WHERE user_product.id_user = $id_user";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function list_customer($id_user,$number,$offset)
    {
        $id_user = intval($id_user);
        $number = intval($number);
        $offset = intval($offset);
        $sql ="SELECT * FROM order_customer INNER JOIN order_detail ON order_customer.id = order_detail.order_id WHERE order_detail.id_ref = $id_user LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_list_customer($id_user)
    {
        $id_user = intval($id_user);
        $sql ="SELECT * FROM order_customer INNER JOIN order_detail ON order_customer.id = order_detail.order_id WHERE order_detail.id_ref = $id_user";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function list_thu_nhap($id_user,$number,$offset)
    {
        $id_user = intval($id_user);
        $number = intval($number);
        $offset = intval($offset);
        $sql ="SELECT *,order_detail.id as id_order_d,order_customer.status as stt_o FROM order_detail LEFT JOIN product ON product.id_product = order_detail.id_product INNER JOIN order_customer ON order_customer.id = order_detail.order_id WHERE order_detail.id_ref = $id_user AND order_customer.status = 1 LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function count_list_thu_nhap($id_user)
    {
        $id_user = intval($id_user);
        $sql ="SELECT * FROM order_detail LEFT JOIN product ON product.id_product = order_detail.id_product INNER JOIN order_customer ON order_customer.id = order_detail.order_id WHERE order_detail.id_ref = $id_user AND order_customer.status = 1";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function delete($id)
    {
        $this->db->delete('user_product',array('id'=>$id));
    }
    public function get_product_user($id_user)
    {
        $id_user = intval($id_user);
        $sql ="SELECT * FROM user_product WHERE id_user = $id_user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function get_product($string)
    {
        $string = addslashes($string);
        if($string!='')
        {
            $sql ="SELECT * FROM product WHERE id_product NOT IN ($string)";
        }
        else
        {
            $sql ="SELECT * FROM product";
        }
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function insert(array $data)
    {
        $this->db->insert('user_product',$data);
        return $this->db->insert_id();
    }
    public function da_linh($id_user)
    {
        $sql="SELECT * FROM order_detail INNER JOIN order_customer ON order_customer.id = order_detail.order_id WHERE order_detail.id_ref = $id_user AND order_detail.status_money = 1 AND order_customer.status = 1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function chua_linh($id_user)
    {
        $sql="SELECT * FROM order_detail INNER JOIN order_customer ON order_customer.id = order_detail.order_id WHERE order_detail.id_ref = $id_user AND order_detail.status_money = 0 AND order_customer.status = 1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
?>