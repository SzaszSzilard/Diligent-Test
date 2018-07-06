<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		$this->data['title'] 	= 'Diligent-Test';
		$this->data['username'] = $this->session->user;
	}
	 
	public function index()
	{
		$this->data['page'] 	= 'welcome';
		$this->load->view('main', $this->data);
	}
	
	public function profile()
	{
		
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		$this->data['page'] 	= 'profile';
		
		$this->load->model('Users');
		$result = $this->Users->getUserId($this->session->userid);
		$this->data['id'] 		= $this->session->userid;
		$this->data['email'] 	= $result[0]->email;
		$this->data['password'] = $result[0]->password;
		
		$this->load->view('main', $this->data);
	}	
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url("index.php/Main/login"));
	}
	
	public function login()
	{
		if ( $this->session->user != '' )
			redirect(base_url());
		
		$this->data['page'] 	= 'login';
		
		if ( $this->input->post('submit') != NULL ) {
			$this->data['usr'] = $usr = $this->input->post('usr');
			$this->data['pwd'] = $pwd = $this->input->post('pwd');
			
			$this->load->model('Users');
			$result = $this->Users->getThisUser($usr,$pwd);
			
			$this->session->userid = "";
			if (isset($result[0])) { // login is possible (user has been find) but maybe no caphcha
				$this->session->userid = $result[0]->id;
				$this->session->user = $result[0]->name; // logininformation has been set
			} else
				$this->data['error']="Wrong username or password";
			
			if ( $this->session->usr != $usr ) { // counting failed login attempt with the same user
				$this->session->usr = $usr;
				$this->session->fail = 0;
			} else
				$this->session->fail++;

			$this->data['fail'] 	= $this->session->fail;
				
			if ( $this->session->fail >= 2 ) {
				$secret = "6LcWhWIUAAAAALPZneMcT0ACqZFOIRXWbAVxMjz6";
				$response = $this->input->post('g-recaptcha-response');
				$remoteip = $SERVER['REMOTE_ADDR'];
					
				$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
				$response = file_get_contents($url);
				$response = json_decode($response);
				
				if ( $response->success == 1 && $this->session->userid!="") { // good captcha and logininfo
					redirect(base_url());
				} else {
					$this->session->user = "";
				}
			} elseif ( $this->session->userid = $result[0]->id!="" )
				redirect(base_url());
		}
		
		$this->load->view('main', $this->data);
	}
	
	public function registration()
	{
		$this->data['page'] 	= 'register';
		
		if ( $this->input->post('submit') != NULL ) {
			$this->load->model('Users');
			
			/*
			$this->load->library('form_validation');
			$this->form_validation->set_rules('usr', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('pwd', 'Password', 'required');
			if ( $this->form_validation->run() == FALSE ) {
				$data['error']="Hiba! A *-gal jelölt mezők kitöltése kötelező!";
			} else {
				if (0 != $this->Users->insertUser())
					echo "succes";
				else 
					echo "fail";
			}
		*/
		
			$this->data['usr'] = $usr = $this->input->post('usr');
			$this->data['email'] = $email = $this->input->post('email');
			$this->data['pwd'] = $pwd = $this->input->post('pwd');
			
			if ( $usr == "" || $email == "" || $pwd == "" )
				$this->data['error']="Error, you have to fill all fields!";
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$this->data['error']="Invalid email format";
			} elseif ( !$this->strong_password($pwd) ) {
				$this->data['error']="Password must contain at least 1 Uppercase letter, 1 lowecase letter, 1 digit, and should be at least 6 characters";
			} else {
				$result = $this->Users->getUserEmail($email);
				if (isset($result[0]))
					$result = $result[0];

				if ( isset($result->email) && $result->email == $email )
					$this->data['error']="Email already in use!!!";
				else {
					if ( 0 != $this->Users->insertUser($usr,$email,$pwd))
						$this->data['notice']="Succesfully Registered. Please go to the <strong><a href='".base_url()."index.php/Main/login"."'>Loginpage</a></strong> and Log in";
					else 
						$this->data['error']="Some error occured while registering data. Plesae try again";
				}
			}
			
		}
		
		$this->load->view('main', $this->data);
	}
	
	function strong_password( $pwd )
	{
		$uppercase = preg_match('@[A-Z]@', $pwd);
		$lowercase = preg_match('@[a-z]@', $pwd);
		$number    = preg_match('@[0-9]@', $pwd);

		if(!$uppercase || !$lowercase || !$number || strlen($pwd) < 6 )
			return false;
	
		return true;
	}
}
