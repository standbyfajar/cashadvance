<?php 
/**
* 
*/
class CDepartment extends CI_Controller
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
		$hasil=$this->ModelGue->semuadata('department');
		$data=array('datadp'=>$hasil);
		$this->load->view('Department/Listdepartment',$data);
	}
	function tambahdepart(){
		$hasil=$this->ModelGue->semuadata('department');
	
		$data= array('datadepartmen'=>$hasil);
		$this->load->view('Department/Newdepartment',$data);
	}
	public function editdepart($id_department){
		$where = array('id_department' =>$id_department );
		$dep=$this->ModelGue->GetWhere('department',$where);

		$hsl=array('id'=>$dep->id_department,
					'nama'=>$dep->nmDepart);
		echo json_encode($hsl);	
		
		// $data=array('datadepart'=>$dep);
		// $this->load->view('Department/Editdepartment',$data );
	}

	function savedepart(){
		// buat validasi data
		$this->form_validation->set_rules('id','kode Department','required|trim');
		$this->form_validation->set_rules('nama','Nama Department','required|trim');
		
		if ($this->form_validation->run()== FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$data= array('pesan'=>validation_errors());
			$this->load->view('Department/Newdepartment',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$id=$this->input->post('id');
			$nama=$this->input->post('nama');

			// validasi data double
			$x = array('id_department' =>$id  );
			$cari=$this->ModelGue->GetWhere('department',$x);
		if(count($cari)>0){
			// $hasil=$this->modelsaya->semuadata('barang');
			// $data= array();

			$hasil=$this->ModelGue->semuadata('department');
			$data=array('datadp'=>$hasil,'id_department'=>$id,'pesan'=>'data Id tidak boleh Sama');
			// $this->load->view('Department/Newdepartment',$data);
			$this->load->view('Department/Listdepartment',$data);
		}else{
			echo json_encode($id);
			$data = array('id_department' =>$id ,'nmDepart'=>$nama);
			// echo json_encode($data);
			// simpan data ke tabel 
			$this->ModelGue->insert('department',$data);
	
			// $a=base_url('CDepartment/departmen');
			// redirect($a);
			// atau memanggil ke index
			// $this->index()
				}
			}
		}	

	function get_departmen($id){
	
		$data = array('id_department'=>$id);
		$hasil = $this->ModelGue->GetWhere('department',$data); 

		echo json_encode($hasil);
	}
	function deletedepartment($id_department){
		$syarat = array('id_department' => $id_department );
		$this->ModelGue->delete('department',$syarat);
		redirect(base_url('CDepartment/'));
	}
	function updetdepart(){
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');

		echo json_encode($kod);
		
		
		$data = array('nmDepart'=>$nama);
		
		// simpan data ke tabel jurusan
		$where=array('id_department'=>$kod);
		$this->ModelGue->update('department',$data,$where);

		// $stat=array('state'=>'1');
		// echo json_encode($stat);

		// $a=base_url('Cashadvance/departmen');
		// redirect($a);
		// atau memanggil ke index
		// $this->barang();
	}
}

 ?>