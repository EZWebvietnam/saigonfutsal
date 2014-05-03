<?php
class Ctvadmin extends MY_Controller
{
    public function __construct() {
        parent::__construct();
          parent::list_province_admin();
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
    public function list_ctv()
    {
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->ctvmodel->count_ctv();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->ctvmodel->load_ctv($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_ctv'] = $array_sv;
        $this->load->view('ctv/ajax_admin_get_ctv', $this->data);
    }
    public function view($id)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->ctvmodel->detail_ctv($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        $this->data['detail_ctv']=$detail;
        $this->load->view('ctv/ajax_admin_view_ctv',$this->data);
    }
    public function delete($id)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->ctvmodel->detail_ctv($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        $this->ctvmodel->delete_ctv($id);
        $this->load->model('productmodel');
        $this->productmodel->delete_user_product_2($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function deletes()
    {
        $this->load->model('productmodel');
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            $this->ctvmodel->delete_ctv($v);
            $this->productmodel->delete_user_product_2($v);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }
    public function edit($id = nul)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->ctvmodel->detail_ctv($id);
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
            $yahoo = $this->input->post('yahoo');
            $skype = $this->input->post('skype');
            $bank = $this->input->post('bank');
            $stk = $this->input->post('stk');
            $birth_day = $this->input->post('birth_day');
            $province = $this->input->post('province');
            $sex = $this->input->post('radio');
            if($password!='')
            {
                $password = $this->tank_auth->hash_password($password);
                $data_save = array(
                    'full_name'=>$full_name,
                    'phone'=>$phone,
                    'address'=>$add,
                    'password'=>$password,
                    'yahoo'=>$yahoo,
                    'skype'=>$skype,
                    'bank'=>$bank,
                    'stk'=>$stk,
                    'birthday'=>$birth_day,
                    'sex'=>$sex,
                    'province'=>$province
                );
            }
            else
            {
                $data_save = array(
                    'full_name'=>$full_name,
                    'phone'=>$phone,
                    'address'=>$add,
                    'yahoo'=>$yahoo,
                    'skype'=>$skype,
                    'bank'=>$bank,
                    'stk'=>$stk,
                    'birthday'=>$birth_day,
                    'sex'=>$sex,
                    'province'=>$province
                );
            }
            $this->ctvmodel->update_ctv($id,$data_save);
            $array = array('error'=>0,'msg'=>'Update thành công');
            echo json_encode($array);
        }
        else
        {
            $this->data['detail_ctv']=$detail;
            $this->load->view('ctv/ajax_admin_edit_ctv',$this->data);
        }
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
                $yahoo = $this->input->post('yahoo');
                $skype = $this->input->post('skype');
                $bank = $this->input->post('bank');
                $stk = $this->input->post('stk');
                $birth_day = $this->input->post('birth_day');
                $sex = $this->input->post('radio');
                $province = $this->input->post('province');
                if (!is_null($data = $this->tank_auth->create_user2(
                                $use_username ? $this->form_validation->set_value('username') : '', $this->form_validation->set_value('sEmail'), $this->form_validation->set_value('sPassWord1'),$full_name,$phone,$sex,$birth_day,$add,$yahoo,$skype,$bank,$stk,'4',$email_activation,1,$province))) {                                    // success
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
            $this->load->view('ctv/ajax_admin_add_ctv',$this->data);
        }
    }
    public function check_account($username) {
        $this->load->model('home/users');
        $user = $this->users->get_user_by_username($username);
        if (empty($user)) {
            RETURN $username;
        } else {
            $this->form_validation->set_message('check_account', 'Account Exists');
            RETURN FALSE;
        }
    }
    public function check_account_ajax() {
        $username = $this->input->post('username');

        $this->load->model('users');
        $user = $this->users->get_user_by_username($username);
        if (empty($user)) {
            echo json_encode(array('error' => '0', 'msg' => '<font color="green">Chưa tồn tại</font>'));
        } else {
            echo json_encode(array('error' => '1', 'msg' => '<font color="red">Username đã tồn tại trong hệ thống</font>'));
        }
    }
    public function check_email_ajax() {
        $email = $this->input->post('email');

        $this->load->model('users');
        $user = $this->users->get_user_by_email($email);
        if (empty($user)) {
            echo json_encode(array('error' => '0', 'msg' => '<font color="green">Chưa tồn tại</font>'));
        } else {
            echo json_encode(array('error' => '1', 'msg' => '<font color="red">Email đã tồn tại trong hệ thống</font>'));
        }
    }

    public function check_email($email) {
        $this->load->model('users');
        $user = $this->users->get_user_by_email($email);
        if (empty($user)) {
            RETURN $username;
        } else {
            $this->form_validation->set_message('check_email', 'Email Exists');
            RETURN FALSE;
        }
    }
    public function order_view($id = null)
    {
        if(empty($id))
        {
            show_404();
            exit;
        }
        $detail = $this->ctvmodel->detail_ctv($id);
        if(empty($detail))
        {
            show_404();
            exit;
        }
        $this->load->model('ordermodel');
        $list_order = $this->ordermodel->list_order($id);
        $tien_da_linh = $this->ordermodel->tien_da_linh($id);
        $tien_linh = 0;
        foreach($tien_da_linh as $tien)
        {
            $tien_linh +=$tien['commissions'];
        }
        $this->data['tien_da_linh'] = $tien_linh;
        $this->data['list_order']= $list_order;
        $this->load->view('ctv/ajax_admin_view_order_ctv',$this->data);
    }
}
?>