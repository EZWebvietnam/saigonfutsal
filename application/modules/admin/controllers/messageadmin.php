<?php
class Messageadmin extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('messagemodel');
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
    public function list_message()
    {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->messagemodel->count_message();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->messagemodel->list_message($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_message'] = $array_sv;
        $this->load->view('message/ajax_admin_get_message', $this->data);
    }
    public function add_all()
    {
        if($this->input->post())
        {
           $data_save = array(
               'title'=>$this->input->post('title'),
               'content'=>$this->input->post('content'),
               'type'=>1,
               'create_date'=>strtotime('now')
            );
           $id_message = $this->messagemodel->insert_message($data_save);
           $this->load->model('home/users');
           $all_member = $this->users->get_all_user();
           $data_message_detail = array();
           foreach($all_member as $member)
           {
               $data_message_detail = array('id_message'=>$id_message,'id_user'=>$member['id'],'status'=>0);
               $this->messagemodel->insert_message_detail($data_message_detail);
               $data_message_detail = array();
           }
           $data = array('error'=>0,'msg'=>'Gửi tin nhắn thành công !');
           echo json_encode($data);
        }
        else
        {
            $this->load->view('message/ajax_admin_send_message');
        }
    }
    public function send_message_to_member($id_mem)
    {
        if($this->input->post())
        {
            $data_message = array(
                'title'=>$this->input->post('title'),
                'content'=>$this->input->post('content'),
                'type'=>0,
                'create_date'=>strtotime('now')
                );
            $id_message = $this->messagemodel->insert_message($data_message);
            $data_message_dt = array('id_message'=>$id_message,'id_user'=>$id_mem,'status'=>0);
            $this->messagemodel->insert_message_detail($data_message_dt);
            $data = array('error'=>0,'msg'=>'Gửi tin nhắn thành công');
            echo json_encode($data);
        }
        else
        {
            $this->data['id']=$id_mem;
            $this->load->view('message/ajax_admin_send_message_to_mem',$this->data);
        }
    }
    public function view($id = null)
    {
        if(empty($id) || !is_numeric($id))
        {
            show_404();
            exit;
        }
        $this->data['message'] = $this->messagemodel->message_detail_($id);
        if(empty($this->data['message']))
        {
            show_404();exit;
        }
        $this->load->view('message/ajax_admin_view_message',$this->data);
    }
    public function edit($id = null)
    {
        if(empty($id) || !is_numeric($id))
        {
            show_404();
            exit;
        }
        $this->data['message'] = $this->messagemodel->message_detail_($id);
        if(empty($this->data['message']))
        {
            show_404();exit;
        }
        if($this->input->post())
        {
            $data_message = array(
                'title'=>$this->input->post('title'),
                'content'=>$this->input->post('content')
            );
            $this->messagemodel->update($id,$data_message);
            $data_ = array('error'=>0,'msg'=>'Update thành công');
            echo json_encode($data_);
        }
        else
        {
            $this->load->view('message/ajax_admin_edit_message',$this->data);
        }
    }
    public function delete($id)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->messagemodel->message_detail_($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        $this->messagemodel->delete($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function deletes()
    {
        
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            $this->messagemodel->delete($v);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
}
?>