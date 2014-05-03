<?php

class Contactadmin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('contactmodel');
         $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
            redirect('/quan-tri');
        }
        if($this->session->userdata('role')!=1)
        {
            show_404();
            exit;
        }
    }

    public function list_contact() {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->contactmodel->count_contact();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->contactmodel->list_contact($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_contact'] = $array_sv;
        $this->load->view('contact/ajax_admin_get_contact', $this->data);
    }

    public function edit($id) {
        $this->data['detail'] = $this->contactmodel->edit($id);
        if ($this->input->post()) {
            $reply = $this->input->post('reply');
            $data_save = array();
            $data_save = array('reply' => $reply);
            $this->contactmodel->update($id, $data_save);
            $this->_send_email($this->data['detail'][0]['email'], $this->data['detail'][0]['email'], $reply, 'Trả lời liên hệ');
            $data = array('error' => 0, 'msg' => 'Trả lời thành công');
            echo json_encode($data);
        } else {
            $this->load->view('contact/ajax_admin_edit_contact', $this->data);
        }
    }

    function _send_email($to, $email, &$content, $title) {
        /*$this->load->library('email');
        $this->load->library('maillinux');*/
        $this->load->library('mailer');
        $from = MAIL_ADMIN;
        $subject = $title;
        $this->mailer->sendmail($email, $email, $subject, $content);
    }
    public function delete($id){
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->contactmodel->edit($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        $this->contactmodel->delete($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function deletes(){
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            $this->contactmodel->delete($v);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
}
?>