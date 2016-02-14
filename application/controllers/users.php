<?php
class Users extends CI_Controller{
	public function __construct(){
	parent::__construct();
	$this->load->database();
	$this->load->config('facebook');
	$this->load->library('facebook');

	}	
	public function auth(){
		$this->login();
		
	}
	public function login(){
		$data = $this->facebook->get_user();
		
		

		$this->load->view('login');


	}
	public function logout(){
		session_unset();
		$_SESSION['FBID'] = null;

		header("Location:".site_url());
	}
}


?>