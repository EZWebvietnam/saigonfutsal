<?php
class Customeradmin extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('productmodel');
    }
    public function list_mail_customer()
    {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->productmodel->count_customer();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->productmodel->list_customer($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_mail'] = $array_sv;
        $this->load->view('mailbookcs/ajax_admin_mailbook_customer', $this->data);
    }
    public function delete($id) {
       
        $this->productmodel->delete_mail_customer($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }

    public function deletes() {
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            $this->productmodel->delete_mail_customer($v);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
}
?>
