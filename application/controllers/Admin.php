<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct(){
    parent::__construct();
    // $this->load->helper('kembali');
    back();
    
  }

  


  function login(){

    if($this->session->userdata('username')){
      redirect(base_url('home.html'),'refresh');
    }else{
    $data['title']='Halaman Login';
    $this->load->view('login',$data);
  }
  }

  function index(){
    $ket="";
    if($this->session->userdata('username')){
      redirect(base_url('home.html'),'refresh');
    }else{
  if ($this->input->post('login')){
    if(empty($this->input->post('username'))){
      if($this->session->userdata('username')){
            redirect(base_url('home.html'),'refresh');
          }      
    $ket="<div class='alert alert-danger' role='alert'>Username & Password tidak boleh kosong</div>";
    }elseif(empty($this->input->post('password'))){
        if($this->session->userdata('username')){
            redirect(base_url('home.html'),'refresh');
          }      
      $ket="<div class='alert alert-danger' role='alert'>Username & Password tidak boleh kosong</div>";
    }elseif(empty($this->input->post('password')) and empty($this->input->post('username')) ){
      if($this->session->userdata('username')){
            redirect(base_url('home.html'),'refresh');
        }
      $ket="<div class='alert alert-danger' role='alert'>Username & Password tidak boleh kosong</div>";
    }

    else{
    $u = $this->input->post('username');
    $pw = md5($this->input->post('password'));
    $row = $this->MAdmin->verifyUser($u,$pw);
  

          if (count($row)){
            $sess=array(
              'username'=>$row['username'],
              'userid'=>$row['id_user']
              );
            $ket="";
            $this->session->set_userdata( $sess );
            redirect(base_url('home.html'),'refresh');
          }else{
            $ket="<div class='alert alert-danger' role='alert'>Username & Password Salah</div>";
          }
  }
  

  }
  

  
  
  $data['keterangan']=$ket;
  $data['title']='Halaman Login';
  $this->load->view('login',$data);
   
   
}

  }


  public function logout(){
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('userid');
    redirect(base_url('admin'),'refresh');
  }

  function home(){
    if(!$this->session->userdata('username')){
      redirect(base_url('admin/login'),'refresh');
    }
    $data['title']='Welcome Admin';
    $data['table']='home';
    $this->load->view('template-utama',$data);
  }

  function gantisandi(){
    $id_user=$this->input->post('id_user');
    $username=$this->input->post('username');
    $lama=$this->input->post('passlama');
    $baru=$this->input->post('passbaru');
    $ulang=$this->input->post('repass');
    
    if(empty($username)||empty($lama)||empty($baru)||empty($ulang)){
      echo json_encode(array("status"=>false));
    }
    else{
        $q=$this->db->query("select * from users where password='".md5($lama)."'");
        if($q->num_rows()>0)
          {
            $ch=$this->db->query("update users set username='".$username."', password='".md5($baru)."' where id_user='".$id_user."'");
            
          }
        }
    echo json_encode(array("status"=>true));
  }

public function ceksandi(){
    $cek=md5($this->input->post('passlama',true));
    $q=$this->db->query("select * from users where password='".$cek."'");
    if($q->num_rows()>0)
    {
      echo json_encode(array("valid"=>true));
    }
    else{
      echo json_encode(array("valid"=>false));
    }


}

public function cekusername($id){
    $q=$this->db->query("select id_user, username from users where id_user='".$id."'");
    $q=$q->row();
    echo json_encode($q);

  }

}