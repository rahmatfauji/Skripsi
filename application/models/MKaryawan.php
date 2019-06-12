<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKaryawan extends CI_Model{
    var $tabel1='Karyawan';
    var $column=array('id_karyawan','nama_karyawan','alamat','jk','id_jabatan');
    var $order=array('id_karyawan'=>'desc');

    public function __construct(){
        parent::__construct();
    }

    private function _get_datatables_query($status){
        $this->db->from($this->tabel1);
        $this->db->where('status_karyawan',$status);
        $i=0;
        foreach ($this->column as $item) {
            
            if($_POST['search']['value'])
            {
               ($i===0)?$this->db->like($item, $_POST['search']['value']):$this->db->or_like($item, $_POST['search']['value']);

             }
                
                $column[$i]=$item;
                $i++;
        }

        if(isset($_POST['order'])){
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order)){
            $order=$this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($status){
        $this->_get_datatables_query($status);
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query=$this->db->get();
        return $query->result();
    }

    function count_filtered($status){
        $this->_get_datatables_query($status);
        $query=$this->db->get();
        return $query->num_rows();
    }

    public function count_all($status){
        $this->db->from($this->tabel1);
        $this->db->where('status_karyawan',$status);
        return $this->db->count_all_results();
    }

    function get_by_id($id){
        $this->db->from($this->tabel1);
        $this->db->where('id_karyawan',$id);
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

    function delete($id){
        $this->db->where('id_karyawan',$id);
        $this->db->delete($this->tabel1);
    }

    function edit_status($where, $data){
        $this->db->update($this->tabel1, $data, $where);
        return $this->db->affected_rows();
    }

    function ambilKaryawan($id){
        $this->db->select("nama_karyawan, id_jabatan");
        $this->db->where("id_karyawan",$id);
        return $this->db->get($this->tabel1)->row();
    }

    function ambilSemuaKaryawan(){
        $this->db->where('status_karyawan','y');
        return $this->db->get($this->tabel1);
    }
    


}
