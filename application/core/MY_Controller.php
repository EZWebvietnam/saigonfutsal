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
        $this->load->model('catemodel');
        $this->data['list_cate']=$this->catemodel->load_cate();
    }
    public function info_company()
    {
        $this->load->model('faq');
        $this->data['info_company'] = $this->faq->info_com();
    }
    public function load_clip()
    {
        $this->load->model('productmodel');
        $this->data['list_clip'] = $this->productmodel->load_clip();
    }
    public function load_header()
    {
        $link = $_SERVER['DOCUMENT_ROOT'] . ROT_DIR . 'setting.xml';
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
                $data_setting = array('author'=>$name,'publisher'=>$pubs,'copyright'=>$cop,'robots'=>$robots,
                    'distribution'=>$distribution,'rating'=>$rating,'keywords'=>$keywords,'logo'=>$logos,'icon'=>$icons,'description'=>$description,'title'=>$title);
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
}
?>