<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MDetail_nilai extends CI_Model{
    var $tabel1='Detail_nilai';
    var $tabel2='Hasilhitung';
    var $tabel3='Ranking';

    var $column1=array('id_karyawan','id_karyawan','id_karyawan','c1','c2','c3','c4','c5','c6');
    var $order1=array('id_karyawan'=>'desc');

    var $column2=array('id_karyawan','id_karyawan','id_karyawan','C1','C2','C3','C4','C5','C6');
    var $order2=array('id_karyawan'=>'desc');

    var $column3=array('id_karyawan','id_karyawan','id_karyawan','Total','ranking');
    var $order3=array('id_karyawan'=>'desc');

    public function __construct(){
        parent::__construct();
    }

    private function _get_datatables_query($id){
        $this->db->from($this->tabel1);
        $this->db->where('id_penilaian',$id);
        $i=0;
        foreach ($this->column1 as $item) {
            
            if($_POST['search']['value'])
            {
               ($i===0)?$this->db->like($item, $_POST['search']['value']):$this->db->or_like($item, $_POST['search']['value']);

             }
                
                $column[$i]=$item;
                $i++;
        }

        if(isset($_POST['order'])){
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order1)){
            $order=$this->order1;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($id){
        $this->_get_datatables_query($id);
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query=$this->db->get();
        return $query->result();
    }

    function count_filtered($id){
        $this->_get_datatables_query($id);
        $query=$this->db->get();
        return $query->num_rows();
    }

    public function count_all($id){
        $this->db->from($this->tabel1);
        $this->db->where('id_penilaian',$id);
        return $this->db->count_all_results();
    }


    private function _get_datatables_query2($id){
        $this->db->from($this->tabel2);
        $this->db->where('id_penilaian',$id);        

        $i=0;
        foreach ($this->column2 as $item) {
            
            if($_POST['search']['value'])
            {
               ($i===0)?$this->db->like($item, $_POST['search']['value']):$this->db->or_like($item, $_POST['search']['value']);

             }
                
                $column[$i]=$item;
                $i++;
        }

        if(isset($_POST['order'])){
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order3)){
            $order=$this->order2;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables2($id){
        $this->_get_datatables_query2($id);
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query=$this->db->get();
        return $query->result();
    }

    function count_filtered2($id){
        $this->_get_datatables_query2($id);
        $query=$this->db->get();
        return $query->num_rows();
    }

    public function count_all2($id){
        $this->db->from($this->tabel2);
        $this->db->where('id_penilaian',$id);
        return $this->db->count_all_results();
    }


    private function _get_datatables_query3($id){
        $this->db->from($this->tabel3);
        $this->db->where('id_penilaian',$id);
        

        $i=0;
        foreach ($this->column3 as $item) {
            
            if($_POST['search']['value'])
            {
               ($i===0)?$this->db->like($item, $_POST['search']['value']):$this->db->or_like($item, $_POST['search']['value']);

             }
                
                $column[$i]=$item;
                $i++;
        }

        if(isset($_POST['order'])){
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }else if(isset($this->order3)){
            $order=$this->order3;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables3($id){
        $this->_get_datatables_query3($id);
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'],$_POST['start']);
        }
        $query=$this->db->get();
        return $query->result();
    }

    function count_filtered3($id){
        $this->_get_datatables_query3($id);
        $query=$this->db->get();
        return $query->num_rows();
    }

    public function count_all3($id){
        $this->db->from($this->tabel3);
        $this->db->where('id_penilaian',$id);
        return $this->db->count_all_results();
    }




    function get_by_id($id){
        $this->db->from($this->tabel1);
        $this->db->where('id_detail',$id);
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
        $this->db->where('id_detail',$id);
        $this->db->delete($this->tabel1);
    }

    function deleteDetail_nilai($id){
        $this->db->where('id_penilaian',$id);
        $this->db->delete($this->tabel1);
    }
    


}
