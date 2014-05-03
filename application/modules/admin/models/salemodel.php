<?php
class Salemodel extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function list_sale($number,$offset)
    {
        $sql="SELECT *,sale_off.exp_date as exp_sale,sale_off.id as id_sale FROM sale_off INNER JOIN product ON product.id_product = sale_off.id_product LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
     public function count_sale()
    {
        $sql="SELECT *,sale_off.id as id_sale FROM sale_off INNER JOIN product ON product.id_product = sale_off.id_product";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }
    public function get_product()
    {
        $sql="SELECT id_product FROM sale_off WHERE exp_date >=now()";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function get_product_($array_id)
    {
        if(!empty($array_id))
        {
            $id_string = implode(',', $array_id);
        }
        else
        {
            $id_string = 0;
        }
        $sql="SELECT * FROM product WHERE id_product NOT IN($id_string)";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function insert(array $data)
    {
        $this->db->insert('sale_off',$data);
        return $this->db->insert_id();
    }
    public function delete($id)
    {
        $this->db->delete('sale_off',array('id'=>$id));
    }
}
?>