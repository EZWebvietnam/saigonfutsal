<?php
class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::load_header();
		$this->load->model('newshomemodel');
		$this->load->model('cliphomemodel');
	}
	public function index()
	{
		$this->load->helper('cookie'); 
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
		$this->data['news_slide_1']=$this->newshomemodel->news_home_famous();
		if(isset($this->data['news_slide_1'][0]['id_new']))
		{
			$id_new_slide = $this->data['news_slide_1'][0]['id_new'];
		}
		else{
			$id_new_slide = 0;
		}
		$this->data['new_slide_sub']=$this->newshomemodel->news_home_sub($id_new_slide);
		$this->data['list_clip_home']=$this->cliphomemodel->clip_famous();
		$this->load->view('home/layout_home_index',$this->data);
	}
}
?>