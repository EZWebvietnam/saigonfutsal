<?php

class Ctvmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function load_ctv($number, $offset) {
        $sql = "SELECT * FROM users WHERE role = 4 LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function count_ctv() {
        $sql = "SELECT * FROM users WHERE role = 4";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }

    public function detail_ctv($id_user) {
        $id_user = intval($id_user);
        $sql = "SELECT * FROM users WHERE role = 4 AND id = $id_user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function delete_ctv($id_user) {
        $this->db->delete('users', array('id' => $id_user));
    }

    public function update_ctv($id_user, array $data) {
        $this->db->where('id', $id_user);
        $this->db->where('role', 4);
        $this->db->update('users', $data);
    }

    ///
    public function load_account($number, $offset) {
        $sql = "SELECT * FROM users WHERE role NOT IN(4) LIMIT $offset,$number";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function count_account() {
        $sql = "SELECT * FROM users WHERE role NOT IN(4)";
        $query = $this->db->query($sql);
        return count($query->result_array());
    }

    public function detail_account($id_user) {
        $id_user = intval($id_user);
        $sql = "SELECT * FROM users WHERE  id = $id_user";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_account($id_user, array $data) {
        $this->db->where('id', $id_user);
        $this->db->update('users', $data);
    }

    public function get_province() {
        $sql = "SELECT * FROM province";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

}

?>