<?php 
/**
* 
*/
class CabsenTarik extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelGue');
		$this->load->model('ModelData');
	}
	function tarik(){
		// $hasil=$this->ModelGue->semuadata('karyawan');
		$hasil=$this->ModelData->combokaryawan();
		$hsl=$this->ModelData->combodepart();
		$data=array('datakar'=>$hasil,'datadep'=>$hsl);
		$this->load->view('Absensi/ProsesTarikAbsen',$data);
	}
}

 ?>