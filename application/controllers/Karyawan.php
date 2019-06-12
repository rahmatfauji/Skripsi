<?php
// error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller{

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
      $data['title']='Halaman Data Karyawan Tidak Aktif';
      $data['tambah']='<br>';
      $data['tombol']='<a class="btn btn-default" href="'.base_url("data-karyawan-aktif.html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Data Aktif</a>';
      $data['judultabel']='Data Tabel  Karyawan Tidak Aktif';
    }else{
      $data['judultabel']='Data Tabel  Karyawan Aktif';
      $data['title']='Halaman Data Karyawan Aktif';
      $data['tambah']='<button class="btn btn-default" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button> 
      <br><br>';
      $data['tombol']='<a class="btn btn-default" href="'.base_url("data-karyawan-nonaktif.html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Data Tidak Aktif</a>';
    }

    $data['btn1']="active";
    $data['btn2']="";
    $data['btn3']="";
    $data['btn4']="";
    
    $data['id']=$id;
    $data['jabatan']=$this->MJabatan->ambilSemuaJabatan()->result();
    
    $data['table']='karyawan/datatables-karyawan';
    $this->load->view('template-utama',$data);
    
  }

    
  public function ajax_list($id){
    $list=$this->MKaryawan->get_datatables($id);
    $data=array();
    $no=$_POST['start'];
    
    foreach ($list as $isi){
      $no++;
      $row=array();
      
      if ($id=='n') {
      $tombol = '<a class="btn btn-sm btn-success" href="javascript:void()" title="Aktifkan Data" onclick="aktifstatus('."'".$isi->id_karyawan."'".')"><i class="glyphicon glyphicon-ok"></i> Aktifkan</a>
      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_karyawan('."'".$isi->id_karyawan."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
      }else{
      $tombol = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_karyawan('."'".$isi->id_karyawan."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
               <a class="btn btn-sm btn-danger" href="javascript:void()" title="Nonaktifkan Data" onclick="nonaktifstatus('."'".$isi->id_karyawan."'".')"><i class="glyphicon glyphicon-remove"></i> Nonaktifkan</a>';  
      }

      $row[]=$isi->id_karyawan;
      $row[]=$isi->nama_karyawan;
      $row[]=$isi->alamat;
      $row[]=$isi->jk=="L"?"Laki-laki":"Perempuan";
      $row[]=$this->MJabatan->ambilJabatan($isi->id_jabatan)->posisi_jabatan;
      $row[]=$tombol;
       $data[] = $row;
    }
    $output=array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=>$this->MKaryawan->count_all($id),
            "recordsFiltered"=>$this->MKaryawan->count_filtered($id),
            "data"=>$data
            );
        
       echo json_encode($output);
    
  }


  public function ajax_edit($id){
    $data=$this->MKaryawan->get_by_id($id);
    echo json_encode($data);

  }

  public function ajax_update(){
       $data=array(
            'id_karyawan'=>$this->input->post('id_karyawan',true),
            'nama_karyawan'=>$this->input->post('nama',true),
            'alamat'=>$this->input->post('alamat',true),
            'jk'=>$this->input->post('jk',true),
            'id_jabatan'=>$this->input->post('jabatan',true)
        );
        $this->MKaryawan->update(array('id_karyawan'=>$this->input->post('id',true)),$data);
        $this->db->query("update detail_nilai set id_karyawan='".$this->input->post('id_karyawan',true)."' where id_karyawan='".$this->input->post('id',true)."'");
        echo json_encode(array("status"=>TRUE));
  }


  public function ajax_add(){
       $data=array(
            'id_karyawan'=>$this->input->post('id_karyawan'),
            'nama_karyawan'=>$this->input->post('nama'),
            'alamat'=>$this->input->post('alamat'),
            'jk'=>$this->input->post('jk'),
            'id_jabatan'=>$this->input->post('jabatan'),
            'status_karyawan'=>'y'
        );
        if(empty($this->input->post('id_karyawan')) || empty($this->input->post('nama')) || empty($this->input->post('alamat')) || empty($this->input->post('jk')) || empty($this->input->post('jabatan'))){
          echo json_encode(array("status"=>false));
       }
       else{
        $this->MKaryawan->save($data); 
        }
        echo json_encode(array("status"=>true));    
  }

    public function ajax_delete($id){
        $this->MKaryawan->delete($id);
        echo json_encode(array("status"=>TRUE));
    }

    public function aktifstatus($id){
      $data=array(
          'status_karyawan'=>'y'
          );

      $this->MKaryawan->edit_status(array('id_karyawan'=>$id),$data);
      echo json_encode(array("status"=>TRUE));
    }

    public function nonaktifstatus($id){
      $data=array(
          'status_karyawan'=>'n'
          );

      $this->MKaryawan->edit_status(array('id_karyawan'=>$id),$data);
      echo json_encode(array("status"=>TRUE));
    }

    public function cekAvailable(){
        $cek=$this->input->post('id_karyawan',true);
        $q=$this->db->query("select * from karyawan where id_karyawan='".$cek."'");
        if($q->num_rows()>0)
        {
          echo json_encode(array("valid"=>false));
        }
        else{
          echo json_encode(array("valid"=>true));
        }
    }

    public function cekAvailable2($id){
        $cek=$this->input->post('id_karyawan',true);
        $q=$this->db->query("select * from karyawan where id_karyawan='".$cek."' and id_karyawan!='".$id."'");
        if($q->num_rows()>0)
        {
          echo json_encode(array("valid"=>false)); 
        }else{
          echo json_encode(array("valid"=>true));
        }
        
    }

   

    public function ambilKaryawan($id){
        $query=$this->db->query("select id_karyawan,nama_karyawan,id_jabatan from karyawan where id_karyawan='".$id."'");
        $data['id_karyawan']=$query->row()->id_karyawan;
        $data['nama_karyawan']=$query->row()->nama_karyawan;
        $query2=$this->db->query("select posisi_jabatan from jabatan where id_jabatan='".$query->row()->id_jabatan."'");
        $data['jabatan']=$query2->row()->posisi_jabatan;
        
        echo json_encode($data);
        
    }    

  




}