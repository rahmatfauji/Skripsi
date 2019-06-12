<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class MLaporan extends CI_Model {
      
    function tampilNormalisasi($id)
    {
    	$this->db->where('id_penilaian',$id);
        return $this->db->get('Hasilhitung')->result();       
    }

    function tampilRanking($id)
    {
    	$this->db->where('id_penilaian',$id);
        $this->db->order_by('Ranking','Asc');
        return $this->db->get('Ranking')->result();       
    }

    function tampilDetail($id)
    {
    	$this->db->where('id_penilaian',$id);
        return $this->db->get('Detail_nilai')->result();       
    }             
}

