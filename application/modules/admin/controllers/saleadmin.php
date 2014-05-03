<?php
class Saleadmin extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('salemodel');
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
    public function list_sale()
    {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->salemodel->count_sale();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->salemodel->list_sale($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_sale'] = $array_sv;
        $this->load->view('sale/ajax_admin_get_sale', $this->data);
    }
    public function add()
    {
        if($this->input->post())
        {
           
            $data_save = array();
            $data_save = array('id_product'=>$this->input->post('id_product'),
                'percent'=>$this->input->post('percent'),
                'exp_date'=>$this->input->post('exp_date'));
            $id = $this->salemodel->insert($data_save);
            if($id>0)
            {
                $data = array('error'=>0,'msg'=>'Thêm thành công');
            }
            else
            {
                $data = array('error'=>1,'msg'=>'Thêm thất bại');
            }
            echo json_encode($data);
        }
        else
        {
            $id_sale_current = $this->salemodel->get_product();
            $data_id_sale = array();
            foreach($id_sale_current as $v)
            {
                $data_id_sale[] = $v['id_product'];
            }
            $this->data['list_product']=$this->salemodel->get_product_($data_id_sale);
            $this->load->view('sale/ajax_admin_add_sale',$this->data);
        }
    }
     public function delete($id)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $this->salemodel->delete($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function deletes()
    {
        
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            $this->salemodel->delete($v);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
}
?>