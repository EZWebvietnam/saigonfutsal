<?php
class Login extends MY_Controller {
    public function __construct() {
        
        parent::__construct();
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        
    }
    public function index() {
        if ($this->tank_auth->is_login_admin(TRUE)) {      // logged in, not activated
            redirect('/quan-tri-vien');
        } else {
            $data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
                    $this->config->item('use_username', 'tank_auth'));
            $data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');
            $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');
            $data['errors'] = array();
            if ($this->form_validation->run()) {        // validation ok
                if ($this->tank_auth->login(
                                $this->form_validation->set_value('login'), $this->form_validation->set_value('password'), $this->form_validation->set_value('remember'), $data['login_by_username'], $data['login_by_email'])) {        // success
                    redirect('/quan-tri-vien');
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    if (isset($errors['banned'])) {        // banned user
                        $this->_show_message($this->lang->line('auth_message_banned') . ' ' . $errors['banned']);
                    } else {            // fail
                        foreach ($errors as $k => $v)
                            $data['errors'][$k] = $this->lang->line($v);
                    }
                }
            }
            $this->data['main_content'] = 'login_view';
            $this->load->view('admin/login_layout_ctv', $this->data);
        }
    }
    public function change_pass()
    {
        if($this->input->post())
        {
            $pass = $this->input->post('new_pass');
            $this->tank_auth->change_pass($this->session->userdata('user_id'), $pass);
            $data = array('error'=>0,'msg'=>'Thay đổi thành công');
            echo json_encode($data);
        }else
        {
            $this->load->view('user_view/change_pass');
        }
    }
    public function check_pass()
    {
       
        $password = $this->input->post('password');
        $result = $this->tank_auth->check_pass($this->session->userdata('user_id'),$password);
        if($result == TRUE)
        {
            $data = array('error'=>0);
        }
        else
        {
             $data = array('error'=>1);
        }
        echo json_encode($data);
    }
    function logout()
	{
		$this->tank_auth->logout();
        $this->session->sess_create();
		$this->_show_message($this->lang->line('auth_message_logged_out'));
	}

    function _show_message($message)
	{
        $this->session->set_flashdata('message', $message);
	   redirect('../'.ROT_DIR);
	}  
}
?>