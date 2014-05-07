<?php
class News extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::load_header();
		parent::list_cate();
		$this->load->model('newshomemodel');
	}
	public function detail_new($id_cate,$id_post)
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
		$id_post = explode('-',$id_post);
		$id_post = $id_post[0];
		$id_cate = explode('-',$id_cate);
		$id_cate = $id_cate[0];
		if(!is_numeric($id_cate) || empty($id_cate) || empty($id_post) || !is_numeric($id_post))
		{
			show_404();exit;
		}
		$this->data['new_detail'] = $this->newshomemodel->new_detail($id_cate,$id_post);
		if(empty($this->data['new_detail']))
		{
			show_404();exit;
		}
		$this->data['list_post_with_cate'] = $this->newshomemodel->new_detail_with_id_cate($id_cate,$id_post);
		$this->data['new_detail_top'] = $this->newshomemodel->new_detail_top($id_post);
		$this->load->view('home/layout_detail_new',$this->data);
	}
}
?>