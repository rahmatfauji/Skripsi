<?php
// error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_nilai extends CI_Controller{

  public function __construct(){
    parent::__construct();

    $this->load->helper('url','kembali');
    back();
    if(!$this->session->userdata('username')){
      redirect(base_url('admin/login'),'refresh');
    }
  }



  public function index($id){
    $data['btn1']="";
    $data['btn2']="";
    $data['btn3']="active";
    $data['title']='Halaman Detail Penilaian '.$id;
    
    $data['tambah']='<button class="btn btn-default" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button> 
    <button class="btn btn-default" onclick="lihatBobot('."'".$id."'".')"><i class="glyphicon glyphicon-pencil"></i> Lihat Bobot</button> 
    <br><br>';
    $data['tombol']='<a class="btn btn-default" href="'.base_url("data-normalisasi-penilaian-".$id.".html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Hasil Normalisasi</a>
    <a class="btn btn-default" href="'.base_url("data-ranking-penilaian-".$id.".html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Hasil Ranking</a>
    <a class="btn btn-default" href="laporan-penilaian-'.$id.'.html" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak Laporan</a>';
    $data['id']=$id;
    $data['karyawan']=$this->MKaryawan->ambilSemuaKaryawan()->result();
    $data['judultabel']='Data Tabel Detail Penilaian';
    $data['table']='detail_nilai/datatables-detail_nilai';
    $q=$this->db->query("select status_penilaian as 'status' from penilaian where id_penilaian='".$id."'")->row();
    $q->status;
    if($q->status=='y'){
    $this->load->view('template-utama',$data);
    }else{
      show_404();
    }
  }

  public function normalisasi($id){
    $data['btn1']="";
    $data['btn2']="";
    $data['btn3']="active";
    $data['title']='Halaman Normalisasi Penilaian '.$id;
    
    $data['tombol']='<a class="btn btn-default" href="'.base_url("data-detail-penilaian-".$id.".html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Detail Penilaian</a>
    <a class="btn btn-default" href="'.base_url("data-ranking-penilaian-".$id.".html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Hasil Ranking</a>
    <a class="btn btn-default" href="laporan-penilaian-'.$id.'.html" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak Laporan</a>';
    $data['id']=$id;
    $data['karyawan']=$this->MKaryawan->ambilSemuaKaryawan()->result();
    $data['judultabel']='Tabel Normalisasi';
    $data['table']='detail_nilai/datatables-normalisasi';
    $q=$this->db->query("select status_penilaian as 'status' from penilaian where id_penilaian='".$id."'")->row();
    $q->status;
    if($q->status=='y'){
    $this->load->view('template-utama',$data);
    }else{
      show_404();
    }
    
  }

  public function ranking($id){
    $data['btn1']="";
    $data['btn2']="";
    $data['btn3']="active";
    $data['title']='Halaman Ranking Penilaian '.$id;
    
    $data['tombol']='<a class="btn btn-default" href="'.base_url("data-detail-penilaian-".$id.".html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Detail Penilaian</a>
    <a class="btn btn-default" href="'.base_url("data-normalisasi-penilaian-".$id.".html").'"><b class="glyphicon glyphicon-list-alt"></b> Lihat Hasil Normalisasi</a>
    <a class="btn btn-default" href="laporan-penilaian-'.$id.'.html" target="_blank"><i class="glyphicon glyphicon-print"></i> Cetak Laporan</a>';
    $data['id']=$id;
    $data['karyawan']=$this->MKaryawan->ambilSemuaKaryawan()->result();
    $data['judultabel']='Tabel Ranking';
    $data['table']='detail_nilai/datatables-ranking';
    $q=$this->db->query("select status_penilaian as 'status' from penilaian where id_penilaian='".$id."'")->row();
    $q->status;
    if($q->status=='y'){
    $this->load->view('template-utama',$data);
    }else{
      show_404();
    }
    
  }
    
  
  public function ajax_list($id){
    $list=$this->MDetail_nilai->get_datatables($id);
    $data=array();
    $no=$_POST['start'];
    
    foreach ($list as $isi){
      $no++;
      $row=array();
      
      
      
      
      $tombol = '<div class=tengah><a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="pilih_karyawan('."'".$isi->id_karyawan."'".')+edit_detail_nilai('."'".$isi->id_detail."'".')" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>
      <a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_detail_nilai('."'".$isi->id_detail."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>
      </div>';         
      

      $row[]=$isi->id_karyawan;
      $row[]=$this->MKaryawan->ambilKaryawan($isi->id_karyawan)->nama_karyawan;
      $row[]=$this->MJabatan->ambilJabatan($this->MKaryawan->ambilKaryawan($isi->id_karyawan)->id_jabatan)->posisi_jabatan;
      $row[]=$isi->c1;
      $row[]=$isi->c2;
      $row[]=$isi->c3;
      $row[]=$isi->c4;
      $row[]=$isi->c5;
      $row[]=$isi->c6;
      
      $row[]=$tombol;
      $data[] = $row;
    }
    $output=array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=>$this->MDetail_nilai->count_all($id),
            "recordsFiltered"=>$this->MDetail_nilai->count_filtered($id),
            "data"=>$data
            );
        
       echo json_encode($output);
    
  }

  //ajax untuk normalisasi
   public function ajax_list2($id){
    $list=$this->MDetail_nilai->get_datatables2($id);
    $data=array();
    $no=$_POST['start'];
    
    foreach ($list as $isi){
      $no++;
      $row=array();
      
      
      $row[]=$isi->id_karyawan;
      $row[]=$this->MKaryawan->ambilKaryawan($isi->id_karyawan)->nama_karyawan;
      $row[]=$this->MJabatan->ambilJabatan($this->MKaryawan->ambilKaryawan($isi->id_karyawan)->id_jabatan)->posisi_jabatan;
      $row[]=$isi->C1==1?"1":$isi->C1;
      $row[]=$isi->C2==1?"1":$isi->C2;
      $row[]=$isi->C3==1?"1":$isi->C3;
      $row[]=$isi->C4==1?"1":$isi->C4;
      $row[]=$isi->C5==1?"1":$isi->C5;
      $row[]=$isi->C6==1?"1":$isi->C6;      
      $data[] = $row;
    }
    $output=array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=>$this->MDetail_nilai->count_all2($id),
            "recordsFiltered"=>$this->MDetail_nilai->count_filtered2($id),
            "data"=>$data
            );
        
       echo json_encode($output);
    
  }

  // ajak untuk ranking
  public function ajax_list3($id){
    $list=$this->MDetail_nilai->get_datatables3($id);
    $data=array();
    $no=$_POST['start'];
    
    foreach ($list as $isi){
      $no++;
      $row=array();
      
      
      $row[]=$isi->id_karyawan;
      $row[]=$this->MKaryawan->ambilKaryawan($isi->id_karyawan)->nama_karyawan;
      $row[]=$this->MJabatan->ambilJabatan($this->MKaryawan->ambilKaryawan($isi->id_karyawan)->id_jabatan)->posisi_jabatan;
      $row[]=$isi->Total;
      $row[]=$isi->ranking;

      $data[] = $row;
    }
    $output=array(
            "draw"=>$_POST['draw'],
            "recordsTotal"=>$this->MDetail_nilai->count_all3($id),
            "recordsFiltered"=>$this->MDetail_nilai->count_filtered3($id),
            "data"=>$data
            );
        
       echo json_encode($output);
    
  }







  public function ajax_edit($id){
    $data=$this->MDetail_nilai->get_by_id($id);
    echo json_encode($data);

  }

  public function ajax_update(){
       $data=array(
            'id_penilaian'=>$this->input->post('id_penilaian',true),
            'id_karyawan'=>$this->input->post('id_karyawan',true),
            'c1'=>$this->input->post('c1',true),
            'c2'=>$this->input->post('c2',true),
            'c3'=>$this->input->post('c3',true),
            'c4'=>$this->input->post('c4',true),
            'c5'=>$this->input->post('c5',true),
            'c6'=>$this->input->post('c6',true)
        );
        $this->MDetail_nilai->update(array('id_detail'=>$this->input->post('id')),$data);
        echo json_encode(array("status"=>TRUE));
  }


  public function ajax_add(){

       $data=array(
            'id_detail'=>$this->input->post('id_penilaian',true).$this->input->post('id_karyawan',true),
            'id_penilaian'=>$this->input->post('id_penilaian',true),
            'id_karyawan'=>$this->input->post('id_karyawan',true),
            'c1'=>$this->input->post('c1',true),
            'c2'=>$this->input->post('c2',true),
            'c3'=>$this->input->post('c3',true),
            'c4'=>$this->input->post('c4',true),
            'c5'=>$this->input->post('c5',true),
            'c6'=>$this->input->post('c6',true)
        );
        $q=$this->db->query("select * from detail_nilai where id_penilaian='".$this->input->post('id_penilaian',true)."' and id_karyawan='".$this->input->post('id_karyawan',true)."'");
        if($q->num_rows()>0)
        {
          echo json_encode(array("status"=>FALSE));
        }
        elseif($this->input->post('id_karyawan')==0){
          echo json_encode(array("status"=>FALSE));
        }elseif($this->input->post('c1')==0 || $this->input->post('c2')==0 || $this->input->post('c3')==0 || $this->input->post('c4')==0 || $this->input->post('c5')==0 || $this->input->post('c6')==0){
          echo json_encode(array("status"=>FALSE));
        }

        else{
        $this->MDetail_nilai->save($data);
        }
        echo json_encode(array("status"=>TRUE));      
  }

    public function ajax_delete($id){
        $this->MDetail_nilai->delete($id);
        echo json_encode(array("status"=>TRUE));
    }


    public function lihatBobot($id){
        $data=$this->MBobot->get_by_id($id);
        echo json_encode($data);
    }

    public function updateBobot(){
    $data=array(
            'bobot_c1'=>$this->input->post('bobotc1',true),
            'bobot_c2'=>$this->input->post('bobotc2',true),
            'bobot_c3'=>$this->input->post('bobotc3',true),
            'bobot_c4'=>$this->input->post('bobotc4',true),
            'bobot_c5'=>$this->input->post('bobotc5',true),
            'bobot_c6'=>$this->input->post('bobotc6',true)
        );
    $this->MBobot->update(array('id_penilaian'=>$this->input->post('id_penilaian')),$data);
    echo json_encode(array("status"=>TRUE));

    }

    public function cek($id){
      $id_karyawan=$this->input->post('id_karyawan',true);

      $q=$this->db->query("Select * from detail_nilai where id_karyawan='".$id_karyawan."' and id_penilaian='".$id."'");
      if($q->num_rows()>0){
       echo json_encode(array("valid"=>false));
      }else{
        echo json_encode(array("valid"=>true));
      }
    }

  




}