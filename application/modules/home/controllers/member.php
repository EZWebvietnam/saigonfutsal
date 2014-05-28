<?php
class Member extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
		$this->load->model('users');
		parent::load_header();
		parent::list_cate();
	}
	public function facebook()
	{
		if($this->input->post())
		{
			$uid = $this->input->post('uid');
			$email = $this->input->post('email');
			$full_name = $this->input->post('firstname').' '.$this->input->post('middlename').' '.$this->input->post('lastname');
			$token = $this->input->post('access_token');
			$username = explode('@',$this->input->post('email'));
			$username = $username[0];
			$email_activation = $this->config->item('email_activation', 'tank_auth');
			$password_1 = rand_string(6);
			$password = $this->tank_auth->hash_password($password_1);
			$data_create = $this->tank_auth->create_user2($username,$email,$password,$full_name,0,0,$email_activation,$uid);
			if(!is_null($data_create))
			{
				
				$data_email = array('full_name'=>$full_name,'username'=>$username,'password'=>$password_1);
				$this->_send_email('activate',$email,$email,$data_email,'Đăng ký thành viên');
			}
			redirect('../'.ROT_DIR);
		}
		else
		{
			$this->load->helper('url_helper');
			$this->load->library('oauth2/OAuth2');
			$this->load->config('oauth2', TRUE);
			$provider_name = 'facebook';
			$provider      = $this->oauth2->provider($provider_name, array(
					'id'    => $this->config->item($provider_name.'_id', 'oauth2'),
					'secret'=> $this->config->item($provider_name.'_secret', 'oauth2'),
				));


			if( ! $this->input->get('code')){
				$provider->authorize();
			}
			else
			{
				try
				{
					$token = $provider->access($this->input->get('code'));
					$this->data['token'] = $token->access_token;
					$this->load->view('login',$this->data);
					
				}
				catch(OAuth2_Exception $e){
					show_error('That didnt work: '.$e);
				}

			}
		}
	}
	public function register()
	{
		//print_r($_POST);
		$full_name = $this->input->post('fullname');
		$birth_day = $this->input->post('dob_day').'/'.$this->input->post('dob_month').'/'.$this->input->post('dob_year');
		$phone = $this->input->post('contact_no');
		$email =  $this->input->post('email_address');
		$email_confirm =  $this->input->post('confirm_email_address');
		$password =  $this->input->post('password');
		$confirm_password =  $this->input->post('confirm_password');
		if($email!=$email_confirm)
		{
			echo json_encode(array('messages'=>'Email nhập lại không chính xác'));
		}
		else
		{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
			  	echo json_encode(array('messages'=>'Email không đúng định dạng'));
			}
			else
			{
				
				if(!$this->users->is_email_available($email))
				{
					if($password!=$confirm_password)
					{
						echo json_encode(array('messages'=>'Password nhập lại không chính xác'));
					}	
					else
					{
						$username = explode('@',$email);
						$username = $username[0];
						$email_activation = $this->config->item('email_activation', 'tank_auth');
						$password_1 = $this->tank_auth->hash_password($password);
						$uid = 0;
						$data_create = $this->tank_auth->create_user($username,$email,$password_1,$full_name,$phone,0,$email_activation,$uid);
						if(!is_null($data_create))
						{
							$data_email = array('full_name'=>$full_name,'username'=>$username,'password'=>$password_1,'email_key'=>$data_create['new_email_key'],'id'=>$data_create['id']);
							$this->_send_email('activate',$email,$email,$data_email,'Đăng ký thành viên');
							echo json_encode(array('success'=>1));
						}
					}
				}
				else
				{
					echo json_encode(array('messages'=>'Email đã tồn tại'));
				}
				
			}
		}
		
		
	}
	public function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($this->tank_auth->login($username,$password,1,FALSE,TRUE))
		{
			echo json_encode(array('success'=>1));
		}
	}
	public function logout()
	{
		$this->tank_auth->logout();
		redirect($_SERVER['HTTP_REFERER']);	
	}
	public function user_seting()
	{
		$edit = $this->input->post('edit');
		switch($edit){
			case 1:
			{
				$this->data['main_content'] = 'account/edit_profile';
				break;
			}
			case 2:
			{
				
				$password = $this->input->post('password');
				$phone = $this->input->post('phone');
				$full_name = $this->input->post('full_name');
				if($password!='')
				{
					$password = $this->tank_auth->hash_password($password);	
					$data_save = array('phone'=>$phone,'full_name'=>$full_name,'password'=>$password);
				}
				else
				{
					$data_save = array('phone'=>$phone,'full_name'=>$full_name);
				}
				$this->users->update_user($this->session->userdata('user_id'),$data_save);
				$_SESSION['save_su']='save ok'; 
				$this->session->set_userdata(array(
                            'full_name' => $full_name,
							'phone'=>$phone,
                        ));
				$this->data['main_content'] = 'account/view_profile';
				break;
			}
			default:
			{
				$this->data['main_content'] = 'account/view_profile';
				break;
			}
				
		}
		$this->load->view('home/layout_profile_user',$this->data);
	}
	function _send_email($type, $to, $email, &$data, $title) {
        /*$this->load->library('email');*/
        $this->load->library('maillinux');
        /*$this->load->library('mailer');
        $from = MAIL_ADMIN;*/
        $from = MAIL_ADMIN;
        $subject = $title;
        $messsage = $this->load->view('email/' . $type . '-html', $data, TRUE);
        $this->maillinux->SendMail($from, $email, $subject, $messsage);
    }
}
?>