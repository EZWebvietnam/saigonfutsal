<?php
class Messagememberctv extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('messagectv');
         $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->load->library('session');
        if(!$this->tank_auth->is_login_ctv(TRUE))
        {
            show_404();
            exit;
        }
    }
    public function list_message()
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
        $config['total_rows'] = $this->messagectv->count_message($id_user);
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
       $num_pages = ceil($config['total_rows']/ $config['per_page']);
       $array_sv = $this->messagectv->list_message($id_user,$config['per_page'], $page1);
       $this->data['total_page'] = $num_pages;
       $this->data['offset'] = $page1;
       $this->data['page']=$page;
       $this->data['total']=$config['total_rows'];
       $this->data['list_message']=$array_sv;   
       $this->load->view('ajax_get_message',$this->data);
    }
    public function view($id = null)
    {
        $this->data['detail']=$this->messagectv->view($id);
        $this->load->view('ajax_view_message',$this->data);
    }
    public function update_status()
    {
        $id = $this->input->post('id');
        $id_user = $this->session->userdata('user_id');
        $data = array('status'=>1);
        $this->messagectv->update($id,$id_user,$data);
    }
    public function delete($id)
    {
        $this->messagectv->delete($id);
         $data = array('error'=>0,'msg'=>'Xóa thành công');
         echo json_encode($data);
    }
}
?>