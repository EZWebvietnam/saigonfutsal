<?php
class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::load_header();
		parent::list_cate();
		parent::load_xml_tsn();
		$this->load->model('newshomemodel');
		$this->load->model('cliphomemodel');
	}
	public function index()
	{
		$this->load->model('catenewhomemodel');
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
		$this->data['cate_info'] = $this->catenewhomemodel->load_cate_new_detail($this->data['news_slide_1'][0]['id_cate']);
		$this->data['new_slide_sub']=$this->newshomemodel->news_home_sub($id_new_slide);
		// Get new by category_id not in $id_new_slide
		$this->data['news_1'] = $this->newshomemodel->news_home_1(1,$id_new_slide);
		$this->data['news_2'] = $this->newshomemodel->news_home_1(2,$id_new_slide);
		$this->data['news_3'] = $this->newshomemodel->news_home_1(3,$id_new_slide);
		//
		$this->data['list_post_fb'] = loadPostFace($this->config->item('pageid'));
		$this->data['profile_page'] = loadProfilePageFace($this->config->item('pageid'));
		$this->data['list_clip_home']=getVideosYouTube($this->config->item('youtubechanel'));
		$this->load->view('home/layout_home_index',$this->data);
	}
	public function result()
	{
		$this->load->view('home/bxh_layout');
	}
}
?>