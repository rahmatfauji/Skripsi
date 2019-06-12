<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MBobot extends CI_Model{
    var $tabel1='Bobot';

    var $column=array('id_karyawan','bobot_c1','bobot_c2','bobot_c3','bobot_c4','bobot_c5','bobot_c6','bobot_c7');
    var $order=array('id_karyawan'=>'desc');


    public function __construct(){
        parent::__construct();
    }

    

    function get_by_id($id){
        $this->db->from($this->tabel1);
        $this->db->where('id_penilaian',$id);
        $query=$this->db->get();
        return $query->row();
    }

    function save($data){
        return $this->db->insert($this->tabel1,$data);
    }

    function update($where, $data){
        $this->db->update($this->tabel1, $data, $where);
        return $this->db->affected_rows();
    }

    

    function deleteBobot($id){
        $this->db->where('id_penilaian',$id);
        $this->db->delete($this->tabel1);
    }
    


}
