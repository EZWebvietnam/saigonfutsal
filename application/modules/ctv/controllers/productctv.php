<?php 
class Productctv extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('productctvmodel');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        if(!$this->tank_auth->is_login_ctv(TRUE))
        {
            show_404();
            exit;
        }
    }
    public function index()
    {
        if (!$this->tank_auth->is_login_ctv(TRUE))
        {
            redirect('/cong-tac-vien/login');
        }
        else
        {
            $this->load->view('ctv/index_layout_ctv');
        }
    }
    public function ajax_get_product()
    {
        $id_user = $this->session->userdata('user_id');
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if($this->input->post('page_no'))
        {
        $page = $this->input->post('page_no');
        }
        else
        {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->productctvmodel->count_list_product($id_user);
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
       $num_pages = ceil($config['total_rows']/ $config['per_page']);
       $array_sv = $this->productctvmodel->list_product($id_user,$config['per_page'], $page1);
       $this->data['total_page'] = $num_pages;
       $this->data['offset'] = $page1;
       $this->data['page']=$page;
       $this->data['total']=$config['total_rows'];
       $this->data['list_product_ref']=$array_sv;   
        $this->load->view('ajax_get_product',$this->data);
    }
    public function delete($id)
    {
        $this->productctvmodel->delete($id);
        $array = array('error'=>0,'msg'=>"Xóa thành công");
        echo json_encode($array);
    }
    public function deletes()
    {
       
        $array = $this->input->post('ar_id');
        foreach($array as $k=>$v)
        {
            $this->productctvmodel->delete($v);
        }
       $array = array('error'=>0,'msg'=>"Xóa thành công");
        echo json_encode($array);
    }
    public function add_product()
    {
        if($this->input->post())
        {
            $data_insert = array('id_user'=>$this->session->userdata('user_id'),'id_product'=>$this->input->post('product'),'create_date'=>strtotime('now'));
            $id = $this->productctvmodel->insert($data_insert);
            if($id>0)
            {
                $array = array('error'=>0,'msg'=>'Thêm thành công');
            }
            else
            {
                $array = array('error'=>1,'msg'=>'Thêm thất bại');
            }
            echo json_encode($array);
        }
        else
        {
            $product_user = $this->productctvmodel->get_product_user($this->session->userdata('user_id'));
            $array_p = array();
            foreach($product_user as $pro)
            {
                $array_p[]=$pro['id_product'];
            }
            $array_p = implode(',',$array_p);
            $product = $this->productctvmodel->get_product($array_p);
            $this->data['product']=$product;
            $this->load->view('ajax_add_product',$this->data);
        }
    }
    public function ajax_get_customer()
    {
        $id_user = $this->session->userdata('user_id');
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if($this->input->post('page_no'))
        {
        $page = $this->input->post('page_no');
        }
        else
        {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->productctvmodel->count_list_customer($id_user);
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
       $num_pages = ceil($config['total_rows']/ $config['per_page']);
       $array_sv = $this->productctvmodel->list_customer($id_user,$config['per_page'], $page1);
       $this->data['total_page'] = $num_pages;
       $this->data['offset'] = $page1;
       $this->data['page']=$page;
       $this->data['total']=$config['total_rows'];
       $this->data['list_customer']=$array_sv;   
       $this->load->view('ajax_get_customer',$this->data);
    }
    public function ajax_thu_nhap()
    {
        $id_user = $this->session->userdata('user_id');
        $da_linh = $this->productctvmodel->da_linh($id_user);
        $tien_linh = 0;
        if(empty($da_linh))
        {
            $tien_linh = 0;
        }
        else
        {
            foreach($da_linh as $linh)
            {
                $tien_linh +=$linh['commissions'];
            }
        }
        $chua_linh = $this->productctvmodel->chua_linh($id_user);
        $tien_chua_linh = 0;
        if(empty($chua_linh))
        {
            $tien_chua_linh = 0;
        }
        else
        {
            foreach($chua_linh as $linh_)
            {
                $tien_chua_linh +=$linh_['commissions'];
            }
        }
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if($this->input->post('page_no'))
        {
        $page = $this->input->post('page_no');
        }
        else
        {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->productctvmodel->count_list_thu_nhap($id_user);
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
       $num_pages = ceil($config['total_rows']/ $config['per_page']);
       $array_sv = $this->productctvmodel->list_thu_nhap($id_user,$config['per_page'], $page1);
       $this->data['total_page'] = $num_pages;
       $this->data['offset'] = $page1;
       $this->data['page']=$page;
       $this->data['total']=$config['total_rows'];
       $this->data['list_tn']=$array_sv;   
       $this->data['tien_linh']=$tien_linh;
       $this->data['tien_chua_linh']=$tien_chua_linh;
       $this->load->view('ajax_get_tn',$this->data);
    }
}
?>