<?php 
/**
* 
*/
class Ceducation extends CI_Controller
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
		$hasil=$this->ModelGue->semuadata('education');
		$data=array('datadp'=>$hasil);
		$this->load->view('Education/Listeducation',$data);
	}
	function tambahedu(){
		$hasil=$this->ModelGue->semuadata('education');
	
		$data= array('dataedu'=>$hasil);
		$this->load->view('Education/NewEdu',$data);
	}
	public function editedu($id_Education){
		$where = array('idEducation' =>$id_Education );
		$dep=$this->ModelGue->GetWhere('education',$where);

		$hsl=array('id'=>$dep->idEducation,
					'nama'=>$dep->nmEducation);
		echo json_encode($hsl);	
		
		// $data=array('datadepart'=>$dep);
		// $this->load->view('Department/Editdepartment',$data );
	}
	function saveedu(){
		// buat validasi data
		$this->form_validation->set_rules('id','kode Education','required|trim');
		$this->form_validation->set_rules('nama','Nama Education','required|trim');
		
		if ($this->form_validation->run()== FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$data= array('pesan'=>validation_errors());
			$this->load->view('Education/NewEdu',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$kod=$this->input->post('id');
			$nama=$this->input->post('nama');

			// validasi data double
			$x = array('idEducation' =>$kod  );
			$cari=$this->ModelGue->GetWhere('education',$x);
		if(count($cari)>0){
			// $hasil=$this->modelsaya->semuadata('barang');
			// $data= array();

			$hasil=$this->ModelGue->semuadata('education');
			$data=array('datadp'=>$hasil,'idEducation'=>$kod,'pesan'=>'data Id tidak boleh Sama');
			// $this->load->view('Department/Newdepartment',$data);
			$this->load->view('Education/Listeducation',$data);
		}else{
			$data = array('idEducation' =>$kod ,'nmEducation'=>$nama);
			// simpan data ke tabel 
			$this->ModelGue->insert('education',$data);
			$a=base_url('Ceducation');
			redirect($a);
			// atau memanggil ke index
			// $this->index()
				}
			}
		}	

	function get_edu($id){
	
		$data = array('idEducation'=>$id);
		$hasil = $this->ModelGue->GetWhere('education',$data); 

		echo json_encode($hasil);
	}
	function delete_edu($id_Education){
		$syarat = array('idEducation' => $id_Education );
		$this->ModelGue->delete('education',$syarat);
		redirect(base_url('Ceducation/education'));
	}
	function updet_edu(){
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');

		echo json_encode($kod);
		
		
		$data = array('nmEducation'=>$nama);
		
		// simpan data ke tabel education
		$where=array('idEducation'=>$kod);
		$this->ModelGue->update('education',$data,$where);

		
	}
}

 ?>