<?php 

/**
* 
*/
class CdayHoliday extends CI_Controller
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
	function dayHoliday(){
		$hasil=$this->ModelGue->semuadata('dayholiday');
		$data=array('datadp'=>$hasil);
		$this->load->view('Holi/ListHoliday',$data);
	}
	function tambahdayHoliday(){
		$hasil=$this->ModelGue->semuadata('dayholiday');
	
		$data= array('data'=>$hasil);
		$this->load->view('Holi/NewHoli',$data);
	}
	public function editdayHoliday($id_department){
		$where = array('id' =>$id_department );
		$dep=$this->ModelGue->GetWhere('dayholiday',$where);

		$hsl=array('id'=>$dep->tglHoliday,
					'nama'=>$dep->nmDay);
		echo json_encode($hsl);	
		
		// $data=array('datadepart'=>$dep);
		// $this->load->view('Department/Editdepartment',$data );
	}
	function savedayHoliday(){
		// buat validasi data
		// $this->form_validation->set_rules('tgl','Tanggal','required|trim');
		$this->form_validation->set_rules('nama','Nama Holiday','required|trim');
		
		if ($this->form_validation->run()== FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$data= array('pesan'=>validation_errors());
			$this->load->view('Holi/NewHoli',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$kod=$this->input->post('id');
			$nama=$this->input->post('nama');

			// validasi data double
			$x = array('nmDay' =>$nama  );
			$cari=$this->ModelGue->GetWhere('dayholiday',$x);
		if(count($cari)>0){
			

			$hasil=$this->ModelGue->semuadata('dayholiday');
			$data=array('datadp'=>$hasil,'nmDay'=>$nama,'pesan'=>'data tidak boleh Sama');
			
			$this->load->view('Holi/ListHoliday',$data);
		}else{
			$data = array('tglHoliday' =>$kod ,'nmDay'=>$nama);
			// simpan data ke tabel 
			$this->ModelGue->insert('dayholiday',$data);
			$a=base_url('CdayHoliday/dayHoliday');
			redirect($a);
			// atau memanggil ke index
			// $this->index()
				}
			}
		}	

	function get_dayHoliday($id){
	
		$data = array('id'=>$id);
		$hasil = $this->ModelGue->GetWhere('dayholiday',$data); 

		echo json_encode($hasil);
	}
	function deletedayHoliday($id){
		$syarat = array('id' => $id );
		$this->ModelGue->delete('dayholiday',$syarat);
		redirect(base_url('CdayHoliday/dayHoliday'));
	}
	function updetdayHoliday(){
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');

		echo json_encode($kod);
		
		$data = array('tglHoliday' =>$kod,'nmDay'=>$nama);
		// $data = array('nmDay'=>$nama);
		
		// simpan data ke tabel jurusan
		$where=array('id'=>$nama);
		$this->ModelGue->update('dayholiday',$data,$where);

		// $stat=array('state'=>'1');
		// echo json_encode($stat);

		// $a=base_url('Cashadvance/departmen');
		// redirect($a);
		// atau memanggil ke index
		// $this->barang();
	}
}
 ?>