<?php 
class Orderadmin extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('ordermodel');
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
    public function list_order()
    {
        $order_detail = $this->ordermodel->list_order_detail();
        $total_money = 0;
        $not_pay = 0;
        $pay_ctv = 0;
        foreach($order_detail as $o_d)
        {
            $total_money += ($o_d['price']*$o_d['quantity']);
            if($o_d['status']==0)
            {
                $not_pay +=$o_d['price']*$o_d['quantity'];
            }
            else
            {
                $pay_ctv +=$o_d['commissions'];
            }
        }
        $this->data['total_money']=$total_money;
        $this->data['not_pay']=$not_pay;
        $this->data['pay_ctv']=$pay_ctv;
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->ordermodel->count_order();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->ordermodel->list_order_($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_ctv'] = $array_sv;
        $this->load->view('order/ajax_admin_get_order', $this->data);
    }
    public function delete($id)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->ordermodel->order_view($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        $this->ordermodel->delete_order($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function deletes()
    {
        $this->load->model('productmodel');
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            $this->ordermodel->delete_order($v); 
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function view_order_detail($id)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->ordermodel->order_view($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        $data_order = $this->ordermodel->order_detail_view($id);
        $this->data['list_order_detail']=$data_order;
        $this->load->view('order/ajax_admin_view_order_detail',$this->data);
    }
    public function change_status_order()
    {
        $id = $this->input->post('id');
        $data_save = array('status'=>1);
        $this->ordermodel->update_order($id,$data_save);
    }
    public function list_order_detail()
    {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->ordermodel->count_order_detail();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->ordermodel->order_detail_list($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_order'] = $array_sv;
        $this->load->view('order/ajax_admin_get_order_detail', $this->data);
    }
     public function change_status_order_detail()
    {
        $id = $this->input->post('id');
        $data_save = array('status_money'=>1);
        $this->ordermodel->update_order_detail($id,$data_save);
    }
}
?>