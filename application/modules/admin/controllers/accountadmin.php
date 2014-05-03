<?php
class Accountadmin extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('ctvmodel');
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
    public function list_account()
    {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->ctvmodel->count_account();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->ctvmodel->load_account($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_ctv'] = $array_sv;
        $this->load->view('account/ajax_admin_account', $this->data);
    }
    public function add()
    {
        if($this->input->post())
        {
            $this->form_validation->set_rules('username', 'username', 'trim|xss_clean');
            $this->form_validation->set_rules('sPassWord1', 'Password', 'trim|xss_clean');
            $this->form_validation->set_rules('sEmail', 'Email', 'trim|xss_clean');
            $email_activation = $this->config->item('email_activation', 'tank_auth');
            $use_username = $this->config->item('use_username', 'tank_auth');
            if ($this->form_validation->run()) {
                $full_name = $this->input->post('full_name');
                $add = $this->input->post('address');
                $phone = $this->input->post('phone');
                $role = $this->input->post('role');
                if (!is_null($data = $this->tank_auth->create_user(
                                $use_username ? $this->form_validation->set_value('username') : '', $this->form_validation->set_value('sEmail'), $this->form_validation->set_value('sPassWord1'),$full_name,$phone,$role,$email_activation, $add))) {                                    // success
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                    if ($email_activation) {                                    // send "activate" email
                        $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;
                        unset($data['password']); // Clear password (just for any case)
                    } else {
                        if ($this->config->item('email_account_details', 'tank_auth')) {    // send "welcome" email
                        }
                        unset($this->data['password']); // Clear password (just for any case)
                    }
                    $data = array('error' => '0', 'msg' => 'Thêm thành công');
                    echo json_encode($data);
                } else {
                    $this->data['error_form_mess'] = 1;
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v) {
                        $this->data['errors'][$k] = $this->lang->line($v);
                    }
                    $data = array('error' => '1', 'msg' => 'Thêm không thành công');
                    echo json_encode($data);
                }
            } else {
                $data = array('error' => '1', 'msg' => 'Thêm không thành công');
                echo json_encode($data);
            }
        }
        else
        {
            $this->load->model('users');
            $this->data['list_role']=$this->users->get_user_role_full();
            $this->load->view('account/account_admin_add_account',$this->data);
        }
        
    }
    public function edit($id)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->ctvmodel->detail_account($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        if($this->input->post())
        {
            $full_name = $this->input->post('full_name');
            $phone = $this->input->post('phone');
            $add = $this->input->post('address');
            $password = $this->input->post('password');
            $role = $this->input->post('role');
            if($password!='')
            {
                $password = $this->tank_auth->hash_password($password);
                $data_save = array(
                    'full_name'=>$full_name,
                    'phone'=>$phone,
                    'address'=>$add,
                    'password'=>$password,
                    'role'=>$role
                );
            }
            else
            {
                $data_save = array(
                    'full_name'=>$full_name,
                    'phone'=>$phone,
                    'address'=>$add,
                    'role'=>$role
                );
            }
            $this->ctvmodel->update_account($id,$data_save);
            $array = array('error'=>0,'msg'=>'Update thành công');
            echo json_encode($array);
        }
        else
        {
            $this->load->model('users');
            $this->data['list_role']=$this->users->get_user_role_full();
            $this->data['detail_ctv']=$detail;
            $this->load->view('account/admin_edit_account',$this->data);
        }
    }
    public function delete($id)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->ctvmodel->detail_account($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        if($id!=1)
        {
            $this->ctvmodel->delete_ctv($id);
            $this->load->model('productmodel');
            $this->productmodel->delete_user_product_2($id);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function deletes()
    {
        $this->load->model('productmodel');
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            if($v!=1)
            {
                $this->ctvmodel->delete_ctv($v);
                $this->productmodel->delete_user_product_2($v);
            }
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
}
?>