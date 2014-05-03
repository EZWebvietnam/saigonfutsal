<?php
class Categorymodel extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function list_category()
    {
        $sql="SELECT * FROM cate_product";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
?>