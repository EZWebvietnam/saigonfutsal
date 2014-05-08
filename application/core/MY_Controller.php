<?php

class MY_Controller extends CI_Controller
{
    protected $data;
    public function __construct()
    {
        parent::__construct();
        $this->data = array();

    }
    public function list_cate()
    {
        $this->load->model('catenewhomemodel');
        $this->data['list_cate']=$this->catenewhomemodel->load_cate_new();
    }
    public function load_clip()
    {
        $this->load->model('productmodel');
        $this->data['list_clip'] = $this->productmodel->load_clip();
    }
    public function load_header()
    {
        $link = PATH_FOLDER . ROT_DIR . 'setting.xml';
        $doc = new DOMDocument();
        $doc->load($link);

        $employees = $doc->getElementsByTagName("root");
        $data_setting = array();
        foreach ($employees as $employee) {
            $names = $employee->getElementsByTagName("Author");
            $name = $names->item(0)->nodeValue;
            $pub = $employee->getElementsByTagName("Publisher");
            $pubs = $pub->item(0)->nodeValue;
            $copy = $employee->getElementsByTagName("Copyright");
            $cop = $copy->item(0)->nodeValue;
            $robot = $employee->getElementsByTagName("robots");
            $robots = $robot->item(0)->nodeValue;
            $dis = $employee->getElementsByTagName("distribution");
            $distribution = $dis->item(0)->nodeValue;
            $rate = $employee->getElementsByTagName("rating");
            $rating = $rate->item(0)->nodeValue;
            $key = $employee->getElementsByTagName("keywords");
            $keywords = $key->item(0)->nodeValue;
            $logo = $employee->getElementsByTagName("logo");
            $logos = $logo->item(0)->nodeValue;
            $icon = $employee->getElementsByTagName("icon");
            $icons = $icon->item(0)->nodeValue;
            $desc = $employee->getElementsByTagName("description");
            $description = $desc->item(0)->nodeValue;
            $tit = $employee->getElementsByTagName("title");
            $title = $tit->item(0)->nodeValue;
            $view = $employee->getElementsByTagName("viewport");
            $viewport = $view->item(0)->nodeValue;
            $msval = $employee->getElementsByTagName("msvalidate");
            $msvalidate = $msval->item(0)->nodeValue;
            $goo =  $employee->getElementsByTagName("google");
            $google = $goo->item(0)->nodeValue;
            $fb =  $employee->getElementsByTagName("fbapp");
            $fbapp = $fb->item(0)->nodeValue;
            $data_setting = array('author'=>$name,'publisher'=>$pubs,'copyright'=>$cop,'robots'=>$robots,
                    'distribution'=>$distribution,'rating'=>$rating,'keywords'=>$keywords,'logo'=>$logos,'icon'=>$icons,'description'=>$description,'title'=>$title,'viewport'=>$viewport,'msvalidate'=>$msvalidate,'google'=>$google,'fbapp'=>$fbapp,'icon'=>$icons);
        }
        $this->data['header']=$data_setting;
    }
    public function list_province()
    {
        $this->load->model('users');
        $list_district = $this->users->get_province();
        $this->data['list_province'] = $list_district;
    }
    public function list_province_admin()
    {
        $this->load->model('ctvmodel');
        $list_district = $this->ctvmodel->get_province();
        $a = array();
        foreach($list_district as $k)
        {
            $a[$k['provinceid']]=$k['name'];
        }
        $this->data['list_province_admin'] = $a;
    }
    public function captcha_random()
    {
        $this->load->model('productmodel');
        $this->data['captcha_question'] = $this->productmodel->random_captcha();
    }
	public function load_xml_tsn()
	{
		$this->load->library('xmlparse');
		$array = $this->xmlparse->xmlToArray('http://www.thaisonnamfc.vn/category/tin-tuc/tin-cau-lac-bo/feed/');
		$array_to_parse = $array['channel'][0]['item'];
		shuffle($array_to_parse); 
		$array_new_tsn = array_slice($array_to_parse, 0, 3);
		$this->data['tsn_list_new'] = $array_new_tsn;
	}
	public function list_most_read()
	{
		$this->load->model('newshomemodel');
		$this->data['list_most_read'] = $this->newshomemodel->new_detail_top(0);
	}
}
?>