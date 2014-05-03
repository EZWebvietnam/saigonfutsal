<?php
class Homectv extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
    }
    public function login()
    {
        if ($this->tank_auth->is_login_ctv(TRUE)) {						// logged in, not activated
			redirect('/cong-tac-vien');
		} else {
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
			$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');
			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			$data['errors'] = array();
			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->login(
						$this->form_validation->set_value('login'),
						$this->form_validation->set_value('password'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'])) {
                                    if($this->session->userdata('role')==4)
                                    {// success
                                                redirect('/cong-tac-vien');
                                    } else {
                                        redirect('/quan-tri');
                    }
                } else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);
					} 
                                        else
                                        {												// fail
                                            foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
                                        }
				}

			}
   
        $this->data['main_content']='index_ctv_view';
        $this->load->view('ctv/login_layout_ctv',$this->data);
        }        
        
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
            $this->load->view('change_pass_ctv');
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
    public function reset_pass()
    {
        if($this->input->post())
        {
            $this->load->model('home/users');
            $email = $this->input->post('email');
            $detail = $this->users->get_user_by_email($email);
            if(!empty($detail))
            {
                $u_id = $detail->id;
                $key_pass = md5(time());
                $new_password_requested = strtotime('now');
                $data_mail = array('u_id'=>$u_id,'key_pass'=>$key_pass);
                $this->_send_email('reset_password',$detail->email, $detail->email, $data_mail, 'Reset Password');
                $this->users->set_password_key($u_id,$key_pass,$new_password_requested);
                $this->data['main_content']='send_key_success';
                $this->load->view('ctv/login_layout_ctv',$this->data);
            }
            else
            {
                $this->data['main_content']='forget_pass';
                $this->load->view('ctv/login_layout_ctv',$this->data);
            }
        }
        else {
            $this->data['main_content']='forget_pass';
            $this->load->view('ctv/login_layout_ctv',$this->data);
        }
    }
    public function active_pass()
    {
        $u_id = $this->uri->segment(2);
        $key_pass = $this->uri->segment(3);
        if($this->tank_auth->can_reset_password($u_id,$key_pass))
        {
            $this->load->model('home/users');
            $detail = $this->users->get_user_by_id($u_id,1);
          
            $new_pass = rand_string(6);
            $this->tank_auth->reset_password($u_id,$key_pass,$new_pass);
            $data_mail = array('username'=>$detail->username,'password'=>$new_pass);
            $this->_send_email('reset_pass_success', $detail->email, $detail->email, $data_mail, 'Reset Password Success');
            $this->data['main_content']='send_key_success';
            $this->load->view('ctv/login_layout_ctv',$this->data);
        }
    }
   function _send_email($type, $to, $email, &$data, $title) {
        /*$this->load->library('email');
        $this->load->library('maillinux');*/
        $this->load->library('mailer');
        $from = MAIL_ADMIN;
        $subject = $title;
        $messsage = $this->load->view('home/email/' . $type . '-html', $data, TRUE);
        $this->mailer->sendmail($email, $email, $subject, $messsage);
    }
}
?>