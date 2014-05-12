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
			$data_create = $this->tank_auth->create_user($username,$email,$password,$full_name,0,0,$email_activation,$uid);
			if(!is_null($data_create))
			{
				
				$data_email = array('full_name'=>$full_name,'username'=>$username,'password'=>$password_1);
				$this->_send_email('activate',$email,$email,$data_email,'Đăng ký thành viên');
				echo '2222';exit;
			}
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