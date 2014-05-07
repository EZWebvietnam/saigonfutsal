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
	public function list_new($id_cate = null)
	{
		
		$id_cate = explode('-',$id_cate);
		$id_cate = $id_cate[0];
		if(empty($id_cate)|| !is_numeric($id_cate))
		{
			show_404();exit;
		}
		$this->load->helper('url');
        $config['uri_segment'] = 5;
        $page = $this->uri->segment(4);
        $config['per_page'] = 10;
        $config['total_rows'] = $this->newshomemodel->count_new_cate($id_cate);
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->newshomemodel->list_new_cate($id_cate,$config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list'] = $array_sv;
		$this->load->view('home/layout_list',$this->data);
	}
}
?>