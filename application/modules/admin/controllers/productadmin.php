<?php

class Productadmin extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('productmodel');
        $this->load->helper(array('form','url'));
        $this->load->library('session');
        $this->load->library('tank_auth');
        $this->lang->load('tank_auth');
        $this->load->library('form_validation');
        
    }

    public function index() {
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
           redirect('/quan-tri');
        }
        $this->load->view('admin/index_layout_ctv');
    }

    public function list_product() {
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
             redirect('/quan-tri');
        }
        if($this->session->userdata('role')!=1)
        {
            show_404();
            exit;
        }
        $this->load->helper('url');
        $config['uri_segment'] = 5;
        if ($this->input->post('page_no')) {
            $page = $this->input->post('page_no');
        } else {
            $page = 1;
        }
        $config['per_page'] = 10;
        $config['total_rows'] = $this->productmodel->count_product();
        if ($page == '') {
            $page = 1;
        }
        $page1 = ($page - 1) * $config['per_page'];
        if (!is_numeric($page)) {
            show_404();
            exit;
        }
        $num_pages = ceil($config['total_rows'] / $config['per_page']);
        $array_sv = $this->productmodel->list_product($config['per_page'], $page1);
        $this->data['total_page'] = $num_pages;
        $this->data['offset'] = $page1;
        $this->data['page'] = $page;
        $this->data['total'] = $config['total_rows'];
        $this->data['list_product'] = $array_sv;
        $this->load->view('product/ajax_admin_get_product', $this->data);
    }

    public function delete($id) {
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
            redirect('/quan-tri');
        }
        if($this->session->userdata('role')!=1)
        {
            show_404();
            exit;
        }
        $this->productmodel->delete_product($id);
        $this->productmodel->delete_user_product($id);
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }

    public function deletes() {
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
            redirect('/quan-tri');
        }
        if($this->session->userdata('role')!=1)
        {
            show_404();
            exit;
        }
        $array = $this->input->post('ar_id');
        foreach ($array as $k => $v) {
            $this->productmodel->delete_product($v);
            $this->productmodel->delete_user_product($v);
        }
        $array = array('error' => 0, 'msg' => "Xóa thành công");
        echo json_encode($array);
    }

    public function view($id = null) {
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
             redirect('/quan-tri');
        }
        if($this->session->userdata('role')!=1)
        {
            show_404();
            exit;
        }
        if (empty($id)) {
            show_404();
            exit;
        }
        $detail = $this->productmodel->view_product($id);
        if (empty($detail)) {
            show_404();
            exit;
        }
        $this->data['detail_product'] = $detail;
        $this->load->view('product/ajax_admin_view_product', $this->data);
    }

    public function add() {
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
            redirect('/quan-tri');
        }
        if($this->session->userdata('role')!=1)
        {
            show_404();
            exit;
        }
        if ($this->input->post()) {
            $clip = $this->input->post('clip');
            $data_save = array(
                'title' => $this->input->post('title'),
                'cost' => intval($this->input->post('cost')),
                'description' => stripslashes($this->input->post('description')),
                'content' => stripslashes($this->input->post('content')),
                'comission' => $this->input->post('hoa_hong'),
                'img' => $this->input->post('file'),
                'position'=>1
            );
            $id = $this->productmodel->add_product($data_save);
            if($clip!='')
            {
                
                $clip_2 = array();
                $data_clip = array();
                $clip = explode(';', $clip);
                foreach($clip as $k=>$v)
                {
                    if(strpos('?v=',$v))
                    {
                        $clip_2 = explode('?v=', $v);
                    }
                    else
                    {
                        if(empty($clip_2))
                        {
                            $clip_2 = explode('watch?&v=', $v);
                        }
                    }
                    if(!empty($clip_2))
                    {
                        $this->productmodel->delete_clip($id);
                        $data_clip = array('id_product'=>$id,'code'=>$clip_2[1],'create_date'=>strtotime('now'));
                        $this->productmodel->insert_clip($data_clip);
                        $data_clip = array();
                    }
                }
            }
            $array = array('error' => 0, 'msg' => 'Thêm thành công');
            echo json_encode($array);
        } else {
            $this->load->model('categorymodel');
            $this->data['list_cate'] = $this->categorymodel->list_category();
            $this->load->view('product/ajax_admin_add_product', $this->data);
        }
    }

    public function edit($id = null) {
        if(!$this->tank_auth->is_login_admin(TRUE))
        {
             redirect('/quan-tri');
        }
        if($this->session->userdata('role')!=1)
        {
            show_404();
            exit;
        }
        if (empty($id)) {
            show_404();
            exit;
        }
        $detail = $this->productmodel->view_product($id);
        if (empty($detail)) {
            show_404();
            exit;
        }
        if ($this->input->post()) {
            $file = $this->input->post('file');
            if ($file != '') {
                $data_save = array(
                    'title' => $this->input->post('title'),
                    'cost' => $this->input->post('cost'),
                    'description' => stripslashes($this->input->post('description')),
                    'content' => $this->input->post('content'),
                    'comission' => $this->input->post('hoa_hong'),
                    'img' => $file
                );
            } else {
                $data_save = array(
                    'title' => $this->input->post('title'),
                    'cost' => $this->input->post('cost'),
                    'description' => stripslashes($this->input->post('description')),
                    'content' => $this->input->post('content'),
                    'comission' => $this->input->post('hoa_hong')
                );
            }
            $this->productmodel->update_product($id, $data_save);
            $clip = $this->input->post('clip');
           
            if($clip!='')
            {
                
                $clip_2 = array();
                $data_clip = array();
                $clip = explode(';', $clip);
                foreach($clip as $k=>$v)
                {
                    if(strlen(strstr($v,'?v='))>0)
                    {
                        $clip_2 = explode('watch?v=',$v);
                    }
                    else
                    {
                        if(empty($clip_2))
                        {
                            $clip_2 = explode('watch?&v=', $v);
                        }
                    }
                    if(!empty($clip_2))
                    {
                        $this->productmodel->delete_clip($id);
                        $data_clip = array('id_product'=>$id,'code'=>$clip_2[1],'create_date'=>strtotime('now'));
                        $this->productmodel->insert_clip($data_clip);
                        $data_clip = array();
                    }
                }
            }
            $array = array('error' => 0, 'msg' => 'Cập nhập thành công');
            echo json_encode($array);
        } else {
            $this->data['detail_product'] = $detail;
            $this->load->view('product/ajax_admin_edit_product', $this->data);
        }
    }

}
?>