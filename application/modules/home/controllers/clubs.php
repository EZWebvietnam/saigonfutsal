<?php
class Clubs extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::load_header();
		parent::list_cate();
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
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
	public function list_club()
	{
		$this->load->helper('url');
		$link_cate = base_url().'doi-bong';
        $config['uri_segment'] = 5;
        $page = $this->uri->segment(3);
        $config['per_page'] = 10;
        $config['total_rows'] = $this->clubshomemodel->count_load_team();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->clubshomemodel->load_team($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list'] = $array_sv;
		$this->data['link_page'] = $link_cate;
		$this->data['title']='Đội bóng | SaigonFutsal.com';
		$this->data['main_content']='clubs/list_club_view';
		$this->load->view('home/layout_list_club',$this->data);
	}
	public function register_club()
	{
		$this->data['title']='Đội bóng | SaigonFutsal.com';
		$this->data['main_content']='clubs/register_club_view';
		$this->load->view('home/layout_list_club',$this->data);
	}
}
?>