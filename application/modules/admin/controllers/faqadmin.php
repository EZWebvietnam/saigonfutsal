<?php
class Faqadmin extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('faqmodel');
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
    public function list_faq()
    {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->faqmodel->count_faq();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->faqmodel->list_faq($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_ctv'] = $array_sv;
        $this->load->view('faq/ajax_admin_get_faq', $this->data);
    }
    public function edit($id)
    {
        if($this->input->post())
        {
          $content = stripslashes($this->input->post('content'));  
          $data_save = array('answer'=>$content,'status'=>1);
          $this->faqmodel->update_faq($id,$data_save);
          $array = array('error'=>0,'msg'=>'Trả lời thành công');
          echo json_encode($array);
        }
        else
        {
            $this->data['detail']=$this->faqmodel->edit($id);
            $this->load->view('faq/ajax_admin_faq_edit',$this->data);
        }
    }
    public function delete($id) {
       
        $this->faqmodel->delete($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }

    public function deletes() {
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
           $this->faqmodel->delete($v);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
}
?>