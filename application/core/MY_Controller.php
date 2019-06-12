<?php if(!defined('BASEPATH')) exit ('No direct access allowed');

class Member_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->access->is_login()){
			redirect('member/login');
		}
	}

	function is_login(){
		return $this->access->is_login();
	}
}

class MY_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();

	}
}