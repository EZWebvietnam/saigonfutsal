<?php
class Member extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');	
	}	
	public function facebook()
    {
        $this->load->helper('url_helper');
        $this->load->library('oauth2/OAuth2');
		$this->load->config('oauth2', TRUE);
        $provider_name ='facebook';
        $provider = $this->oauth2->provider($provider_name, array(
            'id' => $this->config->item($provider_name.'_id', 'oauth2'),
            'secret' => $this->config->item($provider_name.'_secret', 'oauth2'),
        ));


        if ( ! $this->input->get('code'))
        {
            $provider->authorize();
        }
        else
        {
            try
            {
                $token = $provider->access($this->input->get('code'));
                $user = $provider->get_user_info($token);
                print_r($user);exit;
            }
            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
    }
}
?>