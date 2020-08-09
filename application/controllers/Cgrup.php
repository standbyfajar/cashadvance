<?php 
/**
* 
*/
class Cgrup extends CI_Controller
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
		$hsl=$this->ModelGue->semuadata('groupshift');
		
		$data=array('datakar'=>$hsl);
		$this->load->view('Grupshift/ListGrup',$data);
	}
	function newgrup(){
		$hsl=$this->ModelGue->semuadata('groupshift');
		$hasil=$this->ModelData->combokaryawan();
		$hs=$this->ModelData->shift();

		$data=array('datakar'=>$hsl,'cmbkar'=>$hasil,'shf'=>$hs);
		$this->load->view('Grupshift/NewGrup',$data);
	}
	function edit($id){
		$where = array('nik' =>$id );
		$dep=$this->ModelGue->GetWhere('groupshift',$where);

		$hsl=array('nik'=>$dep->nik,
					'nama'=>$dep->groupName,
					'shift'=>$dep->idShift);
		echo json_encode($hsl);	
		
		// $data=array('datadepart'=>$dep);
		// $this->load->view('Department/Editdepartment',$data );
	}
	function edit2($id){
		$where = array('nik' =>$id );
		$dep=$this->ModelGue->GetWhere('groupshift',$where);
		$hasil=$this->ModelData->combokaryawan();
		$hs=$this->ModelData->shift();
		$data=array('data'=>$dep,'cmbkar'=>$hasil,'shf'=>$hs);
		$this->load->view('Grupshift/EditGrup',$data);
		
		// $data=array('datadepart'=>$dep);
		// $this->load->view('Department/Editdepartment',$data );
	}
	function save(){
		// buat validasi data
		$this->form_validation->set_rules('nik','kode Nik','required|trim');
		$this->form_validation->set_rules('nama','Nama Group','required|trim');
		$this->form_validation->set_rules('Shift','Id Shift','required|trim');

		
		if ($this->form_validation->run()== FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$data= array('pesan'=>validation_errors());
			$this->load->view('Grupshift/NewGrup',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$kod=$this->input->post('nik');
			$nama=$this->input->post('grup');
			$shif=$this->input->post('shf');
			// validasi data double
			$x = array('nik' =>$kod  );
			$cari=$this->ModelGue->GetWhere('groupshift',$x);
		if(count($cari)>0){
			// $hasil=$this->modelsaya->semuadata('barang');
			// $data= array();

			$hasil=$this->ModelGue->semuadata('groupshift');
			$data=array('datadp'=>$hasil,'nik'=>$kod,'pesan'=>'data Id tidak boleh Sama');
			// $this->load->view('Department/Newdepartment',$data);
			$this->load->view('Grupshift/ListGrup',$data);
		}else{
			$data = array('nik' =>$kod ,'groupName'=>$nama,'idShift'=>$shif);
			// simpan data ke tabel 
			$this->ModelGue->insert('groupshift',$data);
			$a=base_url('Cgrup');
			redirect($a);
			// atau memanggil ke index
			// $this->index()
				}
			}
		}	

	function get($id){
	
		$data = array('nik'=>$id);
		$hasil = $this->ModelGue->GetWhere('groupshift',$data); 

		echo json_encode($hasil);
	}
	function delete($id){
		$syarat = array('nik' => $id );
		$this->ModelGue->delete('groupshift',$syarat);
		redirect(base_url('Cgrup'));
	}
	function update(){
		$kod=$this->input->post('nik');
		$nama=$this->input->post('nama');
		$shift=$this->input->post('shf');

		echo json_encode($kod);
		
		
		$data = array('groupName'=>$nama,'idShift'=>$shift);
		
		// simpan data ke tabel 
		$where=array('nik'=>$kod);
		$this->ModelGue->update('groupshift',$data,$where);
	
	}
	// function update2(){
	// 	$kod=$this->input->post('nik');
	// 	$nama=$this->input->post('grup');
	// 	$shif=$this->input->post('shf');
		
	// 		$data = array('groupName'=>$nama,'idShift'=>$shif);
		
	// 	// simpan data ke tabel jurusan
	// 	$where=array('nik'=>$kod);
	// 	$this->ModelGue->update('groupshift',$data,$where);
	// 	$a=base_url('Cgrup/grup');
	// 	redirect($a);
	// }
}
 ?>