<?php
class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::load_header();
	}
	public function index()
	{
		$this->load->view('home/layout_home_index',$this->data);
	}
}
?>