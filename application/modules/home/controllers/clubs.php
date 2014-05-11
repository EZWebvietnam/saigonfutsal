<?php
class Clubs extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::load_header();
		parent::list_cate();
		$this->load->model('clubshomemodel');
	}	
	public function fust()
	{
		if(!$this->input->cookie('visit_web', false))
        {
		    $cookie = array(
		                    'name'   => 'visit_web',
		                    'value'  => 'visit_web',
		                    'expire' =>  5184000,
		                    'secure' => false
		                );
		    $this->input->set_cookie($cookie);
	    }
		$this->data['data_club'] = $this->clubshomemodel->load_fust();
		$this->load->view('home/layout_club',$this->data);
	}
}
?>