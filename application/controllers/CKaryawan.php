<?php 
/**
* 
*/
class CKaryawan extends CI_Controller
{
	
	public function __construct()
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
		$this->load->view('Karyawan/Listkaryawan',$data);
	}

	function get_karyawan($id){
		
		$data = array('nik'=>$id);
		$hasil = $this->ModelGue->GetWhere('karyawan',$data); 

		echo json_encode($hasil);
	}
	function tambahkaryawan(){
		$hasil=$this->ModelGue->semuadata('karyawan');
		$hsl=$this->ModelData->combodepart();
		$hs=$this->ModelData->shift();
		$bk=$this->ModelData->combobank();


		$data= array('datakar'=>$hasil,'datakombo'=>$hsl,'data2'=>$hs,'databank'=>$bk);
		$this->load->view('Karyawan/Newkaryawan',$data);
	}

	function savekaryawan(){
		// buat validasi data
		$this->form_validation->set_rules('id','kode karywan','required|trim');
		$this->form_validation->set_rules('nama','Nama karyawan','required|trim');
		$this->form_validation->set_rules('gaji','gaji','numeric|trim','*hanya berupa angka');
		$this->form_validation->set_rules('depart','Department','required|trim','*Harus Pilih');
		
		$this->form_validation->set_rules('tlp','Telepon','numeric|trim','*Data hanya berupa angka');
		

		if ($this->form_validation->run() == FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$hasil=$this->ModelGue->semuadata('karyawan');
			$hsl=$this->ModelData->combodepart();
			$hs=$this->ModelData->shift();

			$data= array(
					'datakar'=>$hasil,
					'datakombo'=>$hsl,
					'data2'=>$hs,
					'pesan'=>validation_errors()
				); 
				
			$this->load->view('Karyawan/Newkaryawan',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$kod=$this->input->post('id');
			$nama=$this->input->post('nama');
			$eml=$this->input->post('alm');
			$tmpt= $this->input->post('tmptlhr');
			$tgl=$this->input->post('tgllahir');
			$dep=$this->input->post('depart');
			$jbt=$this->input->post('posisi');
			$shf=$this->input->post('shf');

			$jen=$this->input->post('jk');
			$tel=$this->input->post('tlp');
			$nmB=$this->input->post('nmBank');
			$accNo=$this->input->post('accNo');
			$stat=$this->input->post('status');
			$ank=$this->input->post('anak');
			$npwp=$this->input->post('npwp');		
			$gj=$this->input->post('gaji');
			$ft=$this->upload();
			
			// validasi data double
			$x = array('nik' =>$kod  );
			$cari=$this->ModelGue->GetWhere('karyawan',$x);

			if(count($cari)>0){
				// $hasil=$this->modelsaya->semuadata('barang');
				$data= array('nik'=>$kod,'pesan'=>'data Id tidak boleh Sama');
				$this->load->view('Karyawan/Newkaryawan',$data);
			}else{
				$data = array('nik' =>$kod ,'nama_karyawan'=>$nama,'alamat'=>$eml,'tmptlahir'=>$tmpt,'tgllahir'=>$tgl,'id_department'=>$dep,'position'=>$jbt,'idShift'=>$shf,'jenis_kelamin'=> $jen,'nomor_telpon'=>$tel,'nm_bank'=>$nmB,'accNo_bank'=>$accNo,'status'=>$stat,'anak'=>$ank,'npwp'=>$npwp,'gaji'=>$gj,'Foto'=>$ft);
				// simpan data ke tabel 
				$this->ModelGue->insert('karyawan',$data);
				$a=base_url('CKaryawan');
				redirect($a);
				// atau memanggil ke index
				// $this->index()
			}
		}
	}	

	public function editkaryawan($id_karyawan){
		$where = array('nik' =>$id_karyawan );
		$datakaryawan=$this->ModelGue->GetWhere('karyawan',$where);
		$hsl=$this->ModelData->datadepart();
		$hsl2=$this->ModelData->datastat();
		$hs=$this->ModelData->dataShift();

		
		$data=array('datakar'=>$datakaryawan,'datakombo'=>$hsl,'datast'=>$hsl2,'data2'=>$hs);
		$this->load->view('Karyawan/Editkaryawan',$data );
	}
	function upload(){
		if (isset($_FILES['ft'])) {
			if ($_FILES['ft']['name'] !="") {
				$eks=explode('.',$_FILES['ft']['name']);
				$nb=rand().'.'.$eks[1];

				$config['file_name']=$nb;
				$config['upload_path'] ='././image';
				$config['allowed_types']='gif|jpg|png|jpeg';

				$this->load->library('upload',$config);
				$this->upload->do_upload('ft');
				return $nb;

			}else{
				$namafoto=$this->input->post('ftlama');
				return($namafoto);
			}
		}
	}
	function updatekaryawan(){
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');
		$eml=$this->input->post('alm');
		$tmpt= $this->input->post('tmptlhr');
		$tgl=$this->input->post('tgllahir');
		$dep=$this->input->post('depart');
		$jbt=$this->input->post('posisi');
		$$hf=$this->input->post('shf');

		$jen=$this->input->post('jk');
		$tel=$this->input->post('tlp');
		$nmB=$this->input->post('nmBank');
		$accNo=$this->input->post('accNo');
		$stat=$this->input->post('status');
		$ank=$this->input->post('anak');
		$npwp=$this->input->post('npwp');		
		$gj=$this->input->post('gaji');
		$ft=$this->upload();
		
		$data = array('nama_karyawan'=>$nama,'alamat'=>$eml,'tmptlahir'=>$tmpt,'tgllahir'=>$tgl,'id_department'=>$dep,'position'=>$jbt,'idShift'=>$shf,'jenis_kelamin'=> $jen,'nomor_telpon'=>$tel,'nm_bank'=>$nmB,'accNo_bank'=>$accNo,'status'=>$stat,'anak'=>$ank,'npwp'=>$npwp,'gaji'=>$gj,'Foto'=>$ft);
		
		// simpan data ke tabel jurusan
		$where=array('nik'=>$kod);
		$this->ModelGue->update('karyawan',$data,$where);
		$a=base_url('CKaryawan');
		redirect($a);
		// atau memanggil ke index
		// $this->barang();
	}
		function deletkaryawan($id_karyawan){
		$syarat = array('nik' => $id_karyawan );
		$this->ModelGue->delete('karyawan',$syarat);
		redirect(base_url('CKaryawan'));
	}
}
 ?>