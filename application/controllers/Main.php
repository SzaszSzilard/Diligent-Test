<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->data['title'] 	= 'Diligent-Test';
		$this->data['username'] = 'anonymus';
	}
	 
	public function index()
	{
		$this->data['page'] 	= 'welcome';
		$this->load->view('main', $this->data);
	}
	
	public function login()
	{
		$this->data['page'] 	= 'login';	
		$this->load->view('main', $this->data);
	}
	
	public function registration()
	{
		$this->data['page'] 	= 'register';
		$this->load->view('main', $this->data);
	}
}
