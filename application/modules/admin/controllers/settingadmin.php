<?php

class Settingadmin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->load->library('form_validation');
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
             redirect('/quan-tri');
        }
        if($this->session->userdata('role')!=1)
        {
            show_404();
            exit;
        }
    }

    public function list_setting() {
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
            $data_setting = array('author' => $name, 'publisher' => $pubs, 'copyright' => $cop, 'robots' => $robots,
                'distribution' => $distribution, 'rating' => $rating, 'keywords' => $keywords, 'logo' => $logos, 'icon' => $icons, 'description' => $description, 'title' => $title);
        }
        $this->data['setting'] = $data_setting;
        $this->load->view('setting/ajax_admin_get_setting', $this->data);
    }

    public function edit() {
        if ($this->input->post()) {
            $doc = new DOMDocument();
            $link = $_SERVER['DOCUMENT_ROOT'] . ROT_DIR . 'setting.xml';
            $doc->load($link);
            $doc->encoding = 'utf-8';
            $featuredde1 = $doc->getElementsByTagName('root');
            foreach ($featuredde1 as $node) {
                $node->parentNode->removeChild($node);
            }
            $last = $doc->saveXML();
            file_put_contents($link, $last);
            $root = $doc->createElement('root');
            $doc->appendChild($root);
            $root->appendChild($doc->createTextNode("\n  "));
            $root->appendChild($doc->createElement('Author', $this->input->post('author')));
            $root->appendChild($doc->createTextNode("\n  "));
            $root->appendChild($doc->createElement('Publisher', $this->input->post('publisher')));
            $root->appendChild($doc->createTextNode("\n  "));
            $root->appendChild($doc->createElement('Copyright', $this->input->post('coppyright')));
            $root->appendChild($doc->createTextNode("\n"));
            $root->appendChild($doc->createElement('robots', $this->input->post('robots')));
            $root->appendChild($doc->createTextNode("\n"));
            $root->appendChild($doc->createElement('distribution', $this->input->post('distribution')));
            $root->appendChild($doc->createTextNode("\n"));
            $root->appendChild($doc->createElement('rating', $this->input->post('rating')));
            $root->appendChild($doc->createTextNode("\n"));
            $root->appendChild($doc->createElement('keywords', $this->input->post('keyword')));
            $root->appendChild($doc->createTextNode("\n"));
            $file = $this->input->post('file');
            if($file!='')
            {
                $root->appendChild($doc->createElement('logo', $file));
            }
            else
            {
                 $root->appendChild($doc->createElement('logo', $this->input->post('logo')));
            }
            $root->appendChild($doc->createTextNode("\n"));
            $root->appendChild($doc->createElement('icon', $this->input->post('icon')));
            $root->appendChild($doc->createTextNode("\n"));
            $root->appendChild($doc->createElement('description', $this->input->post('descriptions')));
            $root->appendChild($doc->createTextNode("\n"));
            $root->appendChild($doc->createElement('title', $this->input->post('title')));
            $root->appendChild($doc->createTextNode("\n"));
            $doc->save($link);
            $data_msg = array('error' => 0, 'msg' => 'Update Setting thanh cong');
            echo json_encode($data_msg);
        } else {
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
                $data_setting = array('author' => $name, 'publisher' => $pubs, 'copyright' => $cop, 'robots' => $robots,
                    'distribution' => $distribution, 'rating' => $rating, 'keywords' => $keywords, 'logo' => $logos, 'icon' => $icons, 'description' => $description, 'title' => $title);
            }
            $this->data['setting'] = $data_setting;
            $this->load->view('setting/ajax_admin_edit_setting', $this->data);
        }
    }

    public function create_xml() {
        $doc = new DOMDocument();
        $link = $_SERVER['DOCUMENT_ROOT'] . ROT_DIR . 'setting.xml';
        $doc->load($link);
        $doc->encoding = 'utf-8';
        $featuredde1 = $doc->getElementsByTagName('root');
        foreach ($featuredde1 as $node) {
            $node->parentNode->removeChild($node);
        }
        $last = $doc->saveXML();
        file_put_contents($link, $last);
        $root = $doc->createElement('root');
        $doc->appendChild($root);
        $root->appendChild($doc->createTextNode("\n  "));
        $root->appendChild($doc->createElement('Author', 'world'));
        $root->appendChild($doc->createTextNode("\n  "));
        $root->appendChild($doc->createElement('Publisher', '42'));
        $root->appendChild($doc->createTextNode("\n  "));
        $root->appendChild($doc->createElement('Copyright', 'danger'));
        $root->appendChild($doc->createTextNode("\n"));
        $root->appendChild($doc->createElement('robots', 'danger'));
        $root->appendChild($doc->createTextNode("\n"));
        $root->appendChild($doc->createElement('distribution', 'danger'));
        $root->appendChild($doc->createTextNode("\n"));
        $root->appendChild($doc->createElement('rating', 'danger'));
        $root->appendChild($doc->createTextNode("\n"));
        $root->appendChild($doc->createElement('keywords', 'danger'));
        $root->appendChild($doc->createTextNode("\n"));
        $root->appendChild($doc->createElement('logo', 'danger'));
        $root->appendChild($doc->createTextNode("\n"));
        $root->appendChild($doc->createElement('icon', 'danger'));
        $root->appendChild($doc->createTextNode("\n"));
        $root->appendChild($doc->createElement('description', 'danger'));
        $root->appendChild($doc->createTextNode("\n"));
        $doc->save($link);
    }
    public function edit_address()
    {
        $this->load->model('contactmodel');
        if($this->input->post())
        {
            $data_save = array();
            $data_save = array('address'=>stripslashes($this->input->post('address')),'footer'=>$this->input->post('footer'));
            $this->contactmodel->update_info(1,$data_save);
            $data_msg = array('error' => 0, 'msg' => 'Update Setting thanh cong');
            echo json_encode($data_msg);
        }
        else
        {
            $this->data['detail']=$this->contactmodel->get_info();
            $this->load->view('setting/ajax_admin_edit_info',$this->data);
        }
    }
    public function about()
    {
        $this->load->model('contactmodel');
        if($this->input->post())
        {
            $data_save = array('content'=>$this->input->post('content'));
            $this->contactmodel->update_about($data_save);
            $array = array('error'=>0,'msg'=>'Update thành công');
            echo json_encode($array);
        }
        else
        {
            
            $this->data['about'] = $this->contactmodel->get_about();
            $this->load->view('setting/ajax_admin_edit_about',$this->data);
        }
    }
}
?>
