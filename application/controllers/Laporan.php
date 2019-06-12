<?php 
// error_reporting(0);
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
    // $this->load->library('m_pdf');
    $this->load->helper('url','kembali');
    
    back();
    if(!$this->session->userdata('username')){
      redirect(base_url('admin/login'),'refresh');
    }

  }


  public function detail($id){
    $mpdf = new \Mpdf\Mpdf();
    $data['id']=$id;
    $q=$this->db->query("select status_penilaian as 'status' from penilaian where id_penilaian='".$id."'")->row();
    if($q->status=='n'){
      show_404();
    }else
    {
        $data['tampil']=$this->MLaporan->tampilDetail($id);
        $data['tampil2']=$this->MLaporan->tampilNormalisasi($id);
        $data['tampil3']=$this->MLaporan->tampilRanking($id);
        $html=$this->load->view('laporan/laporan-detail',$data,true);
        $pdfFilePath = "Laporan_Penilaian_".$id.".pdf";
        $mpdf->WriteHTML($html);
        $mpdf->Output('Laporan " .pdf','I');
    }
    
  }
  
  
}

