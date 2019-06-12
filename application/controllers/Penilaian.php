<?php
// error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller{

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
      $data['judultabel']='Data Tabel Penilaian Tidak Aktif';
      $data['title']='Halaman Data Penilaian Tidak Aktif';
      $data['tambah']='<br>';
      $data['tombol']='<a class="btn btn-default" href="'.base_url("data-penilaian-aktif.html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Data Aktif</a>';
    }else{
      $data['judultabel']='Data Tabel Penilaian Aktif';
      $data['title']='Halaman Data Penilaian Aktif';
      $data['tambah']='<button class="btn btn-default" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button> 
      <br><br>';
      $data['tombol']='<a class="btn btn-default" href="'.base_url("data-penilaian-nonaktif.html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Data Tidak Aktif</a>';
    }
    $data['btn1']="";
    $data['btn2']="";
    $data['btn3']="active";
    $data['btn4']="";    
    $data['id']=$id;    
    $data['table']='penilaian/datatables-penilaian';
    $this->load->view('template-utama',$data);
    
  }

   
  public function ajax_list($id){
    $list=$this->MPenilaian->get_datatables($id);
    $data=array();
    $no=$_POST['start'];
    
    foreach ($list as $isi){
      $no++;
      $row=array();
      
      if ($id=='n') {
      $tombol = '<a class="btn btn-sm btn-success" href="javascript:void()" title="Aktifkan Data" onclick="aktifstatus('."'".$isi->id_penilaian."'".')"><i class="glyphicon glyphicon-ok"></i> Aktifkan</a>
      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_penilaian('."'".$isi->id_penilaian."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      }else{
      $tombol = '<div class="tengah"><a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_penilaian('."'".$isi->id_penilaian."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
               <a class="btn btn-sm btn-danger" href="javascript:void()" title="Nonaktifkan Data" onclick="nonaktifstatus('."'".$isi->id_penilaian."'".')"><i class="glyphicon glyphicon-remove"></i> Nonaktifkan</a>
               <a class="btn btn-sm btn-info" href="'.base_url("data-detail-penilaian-").''.$isi->id_penilaian.'.html" title="Detail Penilaian" ><i class="glyphicon glyphicon-check"></i> Detail</a></div>';  
      }

      $date=date_create($isi->waktu);
      $row[]=$isi->id_penilaian;
      //$row[]=date_format($date,"d F Y");
      $row[]=$isi->waktu;
      $row[]=$isi->keterangan;
      $row[]=$tombol;
      $data[] = $row;
    }
    $output=array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=>$this->MPenilaian->count_all($id),
            "recordsFiltered"=>$this->MPenilaian->count_filtered($id),
            "data"=>$data
            );
        
       echo json_encode($output);
    
  }


  public function ajax_edit($id){
    $data=$this->MPenilaian->get_by_id($id);
    echo json_encode($data);

  }

  public function ajax_update(){
       $data=array(
            'id_penilaian'=>$this->input->post('id_penilaian'),
            'waktu'=>$this->input->post('waktu'),
            'keterangan'=>$this->input->post('keterangan')
        );
       $data2=array(
            'id_penilaian'=>$this->input->post('id_penilaian')
        );

        $this->MPenilaian->update(array('id_penilaian'=>$this->input->post('id')),$data);
        $this->MDetail_nilai->update(array('id_penilaian'=>$this->input->post('id')),$data2);
        $this->MBobot->update(array('id_penilaian'=>$this->input->post('id')),$data2);
        echo json_encode(array("status"=>TRUE));
  }


  public function ajax_add(){
       $data=array(
            'id_penilaian'=>$this->input->post('id_penilaian'),
            'waktu'=>$this->input->post('waktu'),
            'keterangan'=>$this->input->post('keterangan'),
            'status_penilaian'=>'y'
        );
       $data2=array(
            'id_bobot'=>'BOBOT'.$this->input->post('id_penilaian'),
            'id_penilaian'=>$this->input->post('id_penilaian'),
            'bobot_c1'=>2,
            'bobot_c2'=>2,
            'bobot_c3'=>1,
            'bobot_c4'=>2,
            'bobot_c5'=>1,
            'bobot_c6'=>2
        );
       $q=$this->db->query("select * from penilaian where id_penilaian='".$this->input->post('id_penilaian')."'");
        if($q->num_rows()>0)
        {
          echo json_encode(array("status"=>FALSE));
        }
        elseif(empty($this->input->post('id_penilaian')) || empty($this->input->post('waktu')) || empty($this->input->post('keterangan')) ){
          echo json_encode(array("status"=>false));
        }else{
        $this->MPenilaian->save($data);
        $this->MBobot->save($data2);
        }
        echo json_encode(array("status"=>TRUE));      
  }

    public function ajax_delete($id){
        $this->MPenilaian->delete($id);
        $this->MDetail_nilai->deleteDetail_nilai($id);
        $this->MBobot->deleteBobot($id);
        echo json_encode(array("status"=>TRUE));
    }

    public function aktifstatus($id){
      $data=array(
          'status_penilaian'=>'y'
          );

      $this->MPenilaian->edit_status(array('id_penilaian'=>$id),$data);
      echo json_encode(array("status"=>TRUE));
    }

    public function nonaktifstatus($id){
      $data=array(
          'status_penilaian'=>'n'
          );

      $this->MPenilaian->edit_status(array('id_penilaian'=>$id),$data);
      echo json_encode(array("status"=>TRUE));
    }

  public function autoId(){
    echo json_encode(array("id_penilaian"=>$this->MPenilaian->kode()));
  }  





}