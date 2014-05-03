<?php
class Mailbook extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('productmodel');
        $this->load->helper(array('form','url'));
        $this->load->library('session');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->load->library('form_validation');
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
    public function list_mailbook()
    {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->productmodel->count_mail_book();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->productmodel->list_mail_book($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_mail'] = $array_sv;
        $this->load->view('mailbook/ajax_admin_mail_book', $this->data);
    }
     public function delete($id) {
       
        $this->productmodel->delete_mail($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }

    public function deletes() {
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            $this->productmodel->delete_mail($v);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function add()
    {
        if($this->input->post())
        {
            $data_save = array('content'=>stripslashes($this->input->post('content')));
            $id = $this->productmodel->insert_mail_book($data_save);
            if($id>0)
            {
                $array = array('error' => 0, 'msg' => "Thêm thành công");
            }
            else
            {
                $array = array('error' => 0, 'msg' => "Thêm thất bại");
            }
            echo json_encode($array);
        }else
        {
            $this->load->view('mailbook/ajax_admin_add_mail_book',$this->data);
        }
            
    }
    public function edit($id)
    {
        if(empty($id))
        {
            show_404();exit;
        }
        $detail = $this->productmodel->detail_mail_book($id);
        if(empty($detail))
        {
            show_404();exit;
        }
        if($this->input->post())
        {
            $data_save = array('content'=>stripslashes($this->input->post('content')));
            $this->productmodel->update_mail_book($id,$data_save);
             $array = array('error' => 0, 'msg' => "Update thành công");
            echo json_encode($array);
        }
        else
        {
            $this->data['detail'] = $detail;
            $this->load->view('mailbook/ajax_admin_edit_mail_book',$this->data);
        }
    }
}
?>