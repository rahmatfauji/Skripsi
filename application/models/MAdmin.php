<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MAdmin extends CI_Model{


function verifyUser($u,$pw){
		$this->db->select('id_user,username');
		$this->db->where('username',$u);
		$this->db->where('password', $pw);
		
		$this->db->limit(1);
		$query = $this->db->get('users');
		return $query->first_row('array');
	}

}	