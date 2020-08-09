<?php 
class Cashadvance extends CI_Controller{

public function __construct(){
	parent::__construct();
	$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelGue');
		$this->load->model('ModelData');	

	}

	function index(){ 
		$this->load->view('Home');
	}
	// function view_hrd(){
	// 	$this->load->view('Home_hrd');
	// }
	function admin(){
		$hasil=$this->ModelGue->semuadata('admin_login');
		$hsl=$this->ModelData->combodepart();
		$dt=array('dtadmin'=>$hasil,'datakombo'=>$hsl);
		$this->load->view('Admin/Listadmin',$dt);
	}
	function tambah_admin(){
		$hasil=$this->ModelGue->semuadata('admin_login');
		$hsl=$this->ModelData->combodepart();
		$dt=array('dtadmin'=>$hasil,'datakombo'=>$hsl);
		$this->load->view('Admin/Newadmin',$dt);
	}
	function save_admin(){
		// buat validasi data
		$this->form_validation->set_rules('id','kode admin','required|trim');
		$this->form_validation->set_rules('nama','Nama karyawan','required|trim');
		$this->form_validation->set_rules('user','username','required|trim');
		$this->form_validation->set_rules('pass','password','required|trim');
		$this->form_validation->set_rules('akses','Hak akses','required|trim');
		
		
		

		if ($this->form_validation->run()== FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$data= array('pesan'=>validation_errors());
			$this->load->view('Admin/Newadmin',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$id=$this->input->post('id');
			$nama=$this->input->post('nama');
			$us=$this->input->post('user');
			$ps=$this->input->post('pass');
			$jbt=$this->input->post('jbt');
			$dep=$this->input->post('depart');
			$aks=$this->input->post('akses');


			// validasi data double
			$x = array('id_admin' =>$kod  );
			$cari=$this->ModelGue->GetWhere('admin_login',$x);
		if(count($cari)>0){
			// $hasil=$this->modelsaya->semuadata('barang');
			// $data= array();

			$hasil=$this->ModelGue->semuadata('admin_login');
			$data=array('dtadmin'=>$hasil,'id_admin'=>$id,'pesan'=>'data Id tidak boleh Sama');
			// $this->load->view('Department/Newdepartment',$data);
			$this->load->view('Department/Listdepartment',$data);
		}else{
			$data = array('id_admin' =>$id ,'nama_karyawan'=>$nama,'username'=>$us,'password'=>md5($ps),'jabatan'=>$jbt,'id_department'=>$dep,'hak_akses'=>$aks);
			// simpan data ke tabel 
			$this->ModelGue->insert('admin_login',$data);
			$a=base_url('Cashadvance/admin');
			redirect($a);
			// atau memanggil ke index
			// $this->index()
				}
			}
		}	
			public function edit_admin($id_admin){
		$where = array('id_admin' =>$id_admin );
		$data=$this->ModelGue->GetWhere('admin_login',$where);
		$hsl=$this->ModelData->datadepart();
		
		$data=array('dtadmin'=>$data,'datakombo'=>$hsl);
		$this->load->view('Admin/Editadmin',$data );
	}
	function update_admin(){

		$id=$this->input->post('idold');
		$nama=$this->input->post('nama');
		$us=$this->input->post('user');
		$ps=$this->input->post('pass');
		$jbt=$this->input->post('jbt');
		$dep=$this->input->post('depart');
		$aks=$this->input->post('akses');
		
		$data = array('nama_karyawan'=>$nama,'username'=>$us,'password'=>md5($ps),'jabatan'=>$jbt,'id_department'=> $dep,'hak_akses'=>$aks);
		
		// simpan data ke tabel jurusan
		$where=array('id_admin'=>$id);
		$this->ModelGue->update('admin_login',$data,$where);
		$a=base_url('Cashadvance/admin');
		redirect($a);
		// atau memanggil ke index
		// $this->barang();
	}
		function delete_admin($id_admin){
		$syarat = array('id_admin' => $id_admin );
		$this->ModelGue->delete('admin_login',$syarat);
		redirect(base_url('Cashadvance/admin'));
	}


	function karyawan(){
		$hasil=$this->ModelGue->semuadata('karyawan');
		$data=array('datakr'=>$hasil);
		$this->load->view('Karyawan/Listkaryawan',$data);
	}

	function get_karyawan($id){
		
		$data = array('id_karyawan'=>$id);
		$hasil = $this->ModelGue->GetWhere('karyawan',$data); 

		echo json_encode($hasil);
	}
	function tambahkaryawan(){
		$hasil=$this->ModelGue->semuadata('karyawan');
		$hsl=$this->ModelData->combodepart();
		$data= array('datakar'=>$hasil,'datakombo'=>$hsl);
		$this->load->view('Karyawan/Newkaryawan',$data);
	}

	function savekaryawan(){
		// buat validasi data
		$this->form_validation->set_rules('id','kode pelanggan','required|trim');
		$this->form_validation->set_rules('nama','Nama pelanggan','required|trim');
		$this->form_validation->set_rules('gaji','gaji','numeric|trim','*hanya berupa angka');
		$this->form_validation->set_rules('depart','Department','required|trim','*Harus Pilih');
		
		$this->form_validation->set_rules('tlp','Telepon','numeric|trim','*Data hanya berupa angka');
		

		if ($this->form_validation->run()== FALSE) {
		// $hasil=$this->modelsaya->semuadata('barang');
		$data= array('pesan'=>validation_errors());
		$this->load->view('Karyawan/Newkaryawan',$data);
		// pesan error
		}	else{
		// jika tidak error maka data disimpan
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');
		$eml=$this->input->post('email');
		$jbt=$this->input->post('jabatan');
		$dep=$this->input->post('depart');
		$jen=$this->input->post('jk');
		$tel=$this->input->post('tlp');
		$gj=$this->input->post('gaji');
		$ft=$this->upload();
		
		// validasi data double
		$x = array('id_karyawan' =>$kod  );
		$cari=$this->ModelGue->GetWhere('karyawan',$x);
		if(count($cari)>0){
		// $hasil=$this->modelsaya->semuadata('barang');
		$data= array('id_karyawan'=>$kod,'pesan'=>'data Id tidak boleh Sama');
		$this->load->view('Karyawan/Newkaryawan',$data);
		}else{
		$data = array('id_karyawan' =>$kod ,'nama_karyawan'=>$nama,'email'=>$eml,'jabatan'=>$jbt,'id_department'=>$dep,'jenis_kelamin'=> $jen,'nomor_telpon'=>$tel,'gaji'=>$gj,'Foto'=>$ft);
		// simpan data ke tabel 
		$this->ModelGue->insert('karyawan',$data);
		$a=base_url('Cashadvance/karyawan');
		redirect($a);
		// atau memanggil ke index
		// $this->index()
				}
			}
		}	

		public function editkaryawan($id_karyawan){
		$where = array('id_karyawan' =>$id_karyawan );
		$datakaryawan=$this->ModelGue->GetWhere('karyawan',$where);
		$hsl=$this->ModelData->datadepart();
		
		$data=array('datakar'=>$datakaryawan,'datakombo'=>$hsl);
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
		$kod=$this->input->post('idold');
		$nama=$this->input->post('nama');
		$eml=$this->input->post('eml');
		$jbt=$this->input->post('jbt');
		$dep=$this->input->post('depart');
		$jen=$this->input->post('jk');
		$tel=$this->input->post('tel');
		$gj=$this->input->post('gaji');
		$ft=$this->upload();
		
		$data = array('nama_karyawan'=>$nama,'email'=>$eml,'jabatan'=>$jbt,'id_department'=>$dep,'jenis_kelamin'=> $jen,'nomor_telpon'=>$tel,'gaji'=>$gj,'Foto'=>$ft);
		
		// simpan data ke tabel jurusan
		$where=array('id_karyawan'=>$kod);
		$this->ModelGue->update('karyawan',$data,$where);
		$a=base_url('Cashadvance/karyawan');
		redirect($a);
		// atau memanggil ke index
		// $this->barang();
	}
		function deletkaryawan($id_karyawan){
		$syarat = array('id_karyawan' => $id_karyawan );
		$this->ModelGue->delete('karyawan',$syarat);
		redirect(base_url('Cashadvance/karyawan'));
	}


	function departmen(){
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
					'nama'=>$dep->nama_department);
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
			$kod=$this->input->post('id');
			$nama=$this->input->post('nama');

			// validasi data double
			$x = array('id_department' =>$kod  );
			$cari=$this->ModelGue->GetWhere('department',$x);
		if(count($cari)>0){
			// $hasil=$this->modelsaya->semuadata('barang');
			// $data= array();

			$hasil=$this->ModelGue->semuadata('department');
			$data=array('datadp'=>$hasil,'id_department'=>$kod,'pesan'=>'data Id tidak boleh Sama');
			// $this->load->view('Department/Newdepartment',$data);
			$this->load->view('Department/Listdepartment',$data);
		}else{
			$data = array('id_department' =>$kod ,'nama_department'=>$nama);
			// simpan data ke tabel 
			$this->ModelGue->insert('department',$data);
			$a=base_url('Cashadvance/departmen');
			redirect($a);
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
		$this->ModelGue->delete('karyawan',$syarat);
		redirect(base_url('Cashadvance/departmen'));
	}
	function updetdepart(){
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');

		echo json_encode($kod);
		
		
		$data = array('nama_department'=>$nama);
		
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
	function admindata(){
		$this->load->view();
	}
	function tambahadmin(){
		$hasil=$this->ModelGue->semuadata('admin_login');
		$hsl=$this->ModelData->comboadmin();
		$data= array('dataAdmin'=>$hasil,'datakombo'=>$hsl);
		$this->load->view('Admin/Newadmin',$data);
	}
}

 ?>