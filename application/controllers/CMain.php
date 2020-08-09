<?php 
/**
* 
*/
class CMain extends CI_Controller
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
	function index_karyawan(){
		$hasil=$this->ModelGue->semuadata('karyawan');
		$data=array('datakr'=>$hasil);
		$this->load->view('Karyawan/Listkaryawan',$data);
	}
	function index_admin(){
		$hasil=$this->ModelGue->semuadata('admin_login');
		$hsl=$this->ModelData->combodepart();
		$dt=array('dtadmin'=>$hasil,'datakombo'=>$hsl);
		$this->load->view('Admin/Listadmin',$dt);
	}
	function index_bank(){
		$hasil=$this->ModelGue->semuadata('bank');
		$data=array('datadp'=>$hasil);
		$this->load->view('Bank/Listbank',$data);
	}
	function index_dayHoliday(){
		$hasil=$this->ModelGue->semuadata('dayholiday');
		$data=array('datadp'=>$hasil);
		$this->load->view('Holi/ListHoliday',$data);
	}
	function index_department(){
		$hasil=$this->ModelGue->semuadata('department');
		$data=array('datadp'=>$hasil);
		$this->load->view('Department/Listdepartment',$data);
	}
	function index_education(){
		$hasil=$this->ModelGue->semuadata('education');
		$data=array('datadp'=>$hasil);
		$this->load->view('Education/Listeducation',$data);
	}
	function index_shift(){
		$hasil=$this->ModelGue->semuadata('workshift');
		$data=array('datadp'=>$hasil);
		$this->load->view('Workshift/ListShift',$data);
	}
	function index_grup(){
		$hsl=$this->ModelGue->semuadata('groupshift');
		
		$data=array('datakar'=>$hsl);
		$this->load->view('Grupshift/ListGrup',$data);
	}
	function index_login(){
		$this->load->view('Index');
	}
	function index_permintaan(){
		if (!isset($this->session->hd)) 
				{
					$no= $this->ModelData->get_ppUrut();
					// $notransbaru= "TR".date('Y-m-d').sprintf("%03s",$no->transaksi+1);
					$n=$no->Ppurut+1;
					// echo $n;
					$notransbaru="PP".date('y-m-d').substr('000'.$n,-3,3);

					$datasesi=array('noPP'=>$notransbaru,'tanggal'=>date('y-m-d'),'nik'=>'');
					$this->session->set_userdata($datasesi);

					$this->session->set_userdata('hd',0);
					// buat session alamat dan no tel
					$sesi_pelanggan=array('department'=>'','position'=>'');
					$this->session->set_userdata($sesi_pelanggan);
				}
			$nota=$this->session->noPP;
			$combokar=$this->ModelData->combokaryawan();
			// $nama=$this->input->get('nama_karyawan');
			// $combokar=$this->ModelData->tampil_nama($nama);
			// $datadetil=$this->ModelData->tampildata($this->session->id_pinjam);
			$detiltrans=$this->ModelData->tpl($nota);
			// $dtPP=$this->ModelData->jumlah_pinjam($nik); 	

			// echo print_r($_SESSION);
			$data = array('comkar' =>$combokar,'datadetil'=>$detiltrans);
			
			$this->load->view('PP/FormPermintaan',$data);
	}
	function index_pinjam(){

	
				if (!isset($this->session->hd)) 
				{
					$no= $this->ModelData->get_notrans();
					// $notransbaru= "TR".date('Y-m-d').sprintf("%03s",$no->transaksi+1);
					$n=$no->nota+1;
					// echo $n;
					$notransbaru="TR".date('y-m-d').substr('000'.$n,-3,3);

					$datasesi=array('permintaan'=>'','notrans'=>$notransbaru,'tanggal'=>date('y-m-d'),'id_karyawan'=>'');
					$this->session->set_userdata($datasesi);

					$this->session->set_userdata('hd',0);
					// buat session alamat dan no tel
					$sesi_pelanggan=array('department'=>'','jabatan'=>'','gaji'=>'');
					$this->session->set_userdata($sesi_pelanggan);
				}
			$nota=$this->session->notrans;
			$combokar=$this->ModelData->combokaryawan();
			
			$detiltrans=$this->ModelData->tampildata($nota);
			$PP=$this->ModelData->data_PP();
			
			// echo print_r($_SESSION);
			$data = array('comkar' =>$combokar,'datadetil'=>$detiltrans,'datapp'=>$PP);
			$this->load->view('Cash/SistemCashAdvance',$data);
		}
}
 ?>