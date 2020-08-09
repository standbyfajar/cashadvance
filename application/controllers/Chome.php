<?php 
/**
* 
*/
class Chome extends CI_Controller
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
	function index(){
		$hasil=$this->ModelGue->semuadata('karyawan');
		$data=array('datakr'=>$hasil);
		$this->load->view('Home',$data);
	}
}

 ?>