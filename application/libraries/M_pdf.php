<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

 include_once APPPATH.'/third_party/mpdf/mpdf.php';

class M_pdf {

    public $param;
    public $pdf;
    //$param = '"en-GB-x","A4","","",10,10,10,10,6,3';
    public function __construct()
    {
        //$this->param =$param;
        $this->pdf = new mPDF();
    }
}
