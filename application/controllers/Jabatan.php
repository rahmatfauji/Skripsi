<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller{

  public function __construct(){
    parent::__construct();

    $this->load->helper('url','kembali');
    
    back();
    if(!$this->session->userdata('username')){
      redirect(base_url('admin/login'),'refresh');
    }
  }


  public function index($id){
    if($id=='n'){
      $data['judultabel']='Data Tabel  Jabatan Tidak Aktif';
      $data['title']='Halaman Data Jabatn Tidak Aktif';
      $data['tambah']='<br>';
      $data['tombol']='<a class="btn btn-default" href="'.base_url("data-jabatan-aktif.html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Data Aktif</a>';
    }else{
      $data['judultabel']='Data Tabel  Jabatan Aktif';
      $data['title']='Halaman Data Jabatan Aktif';
      $data['tambah']='<button class="btn btn-default" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button> 
      <br><br>';
      $data['tombol']='<a class="btn btn-default" href="'.base_url("data-jabatan-nonaktif.html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Data Tidak Aktif</a>';
    }
    $data['username']=$this->session->userdata('username');
    $data['btn1']="";
    $data['btn2']="active";
    $data['btn3']="";
    $data['btn4']="";
    $data['id']=$id;
    $data['table']='jabatan/datatables-jabatan';
    $this->load->view('template-utama',$data);
    
  }

  public function ajax_list($id){
    $list=$this->MJabatan->get_datatables($id);
    $data=array();
    $no=$_POST['start'];
    
    foreach ($list as $isi){
      $no++;
      $row=array();
      
      if ($id=='n') {
      $tombol = '<a class="btn btn-sm btn-success" href="javascript:void()" title="Aktifkan Data" onclick="aktifstatus('."'".$isi->id_jabatan."'".')"><i class="glyphicon glyphicon-ok"></i> Aktifkan</a>
      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_jabatan('."'".$isi->id_jabatan."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      }else{
      $tombol = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_jabatan('."'".$isi->id_jabatan."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
               <a class="btn btn-sm btn-danger" href="javascript:void()" title="Nonaktifkan Data" onclick="nonaktifstatus('."'".$isi->id_jabatan."'".')"><i class="glyphicon glyphicon-remove"></i> Nonaktifkan</a>';  
      }

      $row[]=$isi->id_jabatan;
      $row[]=$isi->posisi_jabatan;
      //$row[]=$isi->status_jabatan=="y"?"Aktif":"Nonaktif";
      $row[]=$tombol;
      //$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_jabatan('."'".$isi->id_jabatan."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
      //$row[] =' <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_jabatan('."'".$isi->id_jabatan."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      $data[] = $row;
    }
    $output=array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=>$this->MJabatan->count_all($id),
            "recordsFiltered"=>$this->MJabatan->count_filtered($id),
            "data"=>$data
            );
        
       echo json_encode($output);
    
  }


  public function ajax_edit($id){
    $data=$this->MJabatan->get_by_id($id);
    echo json_encode($data);

  }

  public function ajax_update(){
       $data=array(
            'id_jabatan'=>$this->input->post('id_jabatan',true),
            'posisi_jabatan'=>$this->input->post('posisi',true)
            
        );
        $this->MJabatan->update(array('id_jabatan'=>$this->input->post('id',true)),$data);
        echo json_encode(array("status"=>TRUE));
  }


  public function ajax_add(){
       $data=array(
            'id_jabatan'=>$this->input->post('id_jabatan',true),
            'posisi_jabatan'=>$this->input->post('posisi',true),
            'status_jabatan'=>'y'
        );
       if(empty($this->input->post('id_jabatan')) || empty($this->input->post('posisi'))){
          echo json_encode(array("status"=>false));
       }else{
        $this->MJabatan->save($data);
        }
        echo json_encode(array("status"=>TRUE));      
  }

  public function ajax_delete($id){
      $this->MJabatan->delete($id);
      echo json_encode(array("status"=>TRUE));
  }

  public function aktifstatus($id){
    $data=array(
        'status_jabatan'=>'y'
        );

    $this->MJabatan->edit_status(array('id_jabatan'=>$id),$data);
    echo json_encode(array("status"=>TRUE));
  }

  public function nonaktifstatus($id){
    $data=array(
        'status_jabatan'=>'n'
        );

    $this->MJabatan->edit_status(array('id_jabatan'=>$id),$data);
    echo json_encode(array("status"=>TRUE));
  }

  public function autoId(){
    echo json_encode(array("id_jabatan"=>$this->MJabatan->kode()));
  }  




}