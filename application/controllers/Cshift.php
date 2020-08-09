<?php
/**
* 
*/
class Cshift extends CI_Controller
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
		$hasil=$this->ModelGue->semuadata('workshift');
		$data=array('datadp'=>$hasil);
		$this->load->view('Workshift/ListShift',$data);
	}
	function tambah(){
		$hasil=$this->ModelGue->semuadata('workshift');
	
		$data= array('datadepartmen'=>$hasil);
		$this->load->view('Workshift/NewShift',$data);
	}
	public function edit($id){
		$where = array('idShift' =>$id );
		$dep=$this->ModelGue->GetWhere('workshift',$where);

		$hsl=array('id'=>$dep->idShift,
					'nama'=>$dep->ShiftName,
					'hour'=>$dep->WorkHours,
					'in'=>$dep->Sch_in,
					'out'=>$dep->Sch_Out);
		echo json_encode($hsl);	
		
		// $data=array('datadepart'=>$dep);
		// $this->load->view('Department/Editdepartment',$data );
	}
	function save(){
		// buat validasi data
		$this->form_validation->set_rules('id','kode ','required|trim');
		$this->form_validation->set_rules('nama','Nama ','required|trim');
		$this->form_validation->set_rules('WorkHours','berapa jam','required|trim');
		$this->form_validation->set_rules('schin','jam masuk','required|trim');
		$this->form_validation->set_rules('schout','jam keluar','required|trim');
		
		if ($this->form_validation->run()== FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$data= array('pesan'=>validation_errors());
			$this->load->view('Workshift/NewShift',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$kod=$this->input->post('id');
			$nama=$this->input->post('nama');
			$wh=$this->input->post('hour');
			$SI=$this->input->post('schin');
			$SO=$this->input->post('schout');
			// validasi data double
			$x = array('idShift' =>$kod  );
			$cari=$this->ModelGue->GetWhere('workshift',$x);
		if(count($cari)>0){
			// $hasil=$this->modelsaya->semuadata('barang');
			// $data= array();

			$hasil=$this->ModelGue->semuadata('workshift');
			$data=array('datadp'=>$hasil,'idShift'=>$kod,'pesan'=>'data tidak boleh sama');
			// $this->load->view('Department/Newdepartment',$data);
			$this->load->view('Workshift/Listdepartment',$data);
		}else{
			$data = array('idShift' =>$kod ,'ShiftName'=>$nama,'WorkHours'=>$wh,'Sch_in'=>$SI,'Sch_Out'=>$SO);
			// simpan data ke tabel 
			$this->ModelGue->insert('workshift',$data);
			$a=base_url('Cshift');
			redirect($a);
			// atau memanggil ke index
			// $this->index()
				}
			}
		}	

	function get($id){
	
		$data = array('idShift'=>$id);
		$hasil = $this->ModelGue->GetWhere('workshift',$data); 
		$dt = array('id' =>$hasil->idShift ,
		'shift'=>$hasil->ShiftName,
		'wh'=>$hasil->WorkHours,
		'si'=>$hasil->Sch_in,
		'so'=>$hasil->Sch_Out,
		 );
		echo json_encode($dt);
	}
	function delete($id){
		$syarat = array('idShift' => $id );
		$this->ModelGue->delete('workshift',$syarat);
		redirect(base_url('Cshift'));
	}
	function updet(){
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');
		$wh=$this->input->post('hour');
		$SI=$this->input->post('schin');
		$SO=$this->input->post('schout');

		echo json_encode($kod);
		
		
		$data = array('ShiftName'=>$nama,'WorkHours'=>$wh,'Sch_in'=>$SI,'Sch_Out'=>$SO);
		
		// simpan data ke tabel 
		$where=array('idShift'=>$kod);
		$this->ModelGue->update('workshift',$data,$where);

	}
}
 ?>