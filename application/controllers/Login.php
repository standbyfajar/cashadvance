<?php 
class Login extends CI_Controller{
public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelGue');	
	}
	function index(){
		$this->load->view('Index');
	}
	
	function login(){
		$this->form_validation->set_rules('user_nama','User name','required|trim');
		$this->form_validation->set_rules('kata_kunci','password','required|trim');
		
		// $login = false;
		if ($this->form_validation->run()==FALSE) {
		 $dt = array('pesan' => validation_errors());
			//$dt['pesan']= validation_error();
		 	$login = 'kosong';
		$this->load->view('index',$dt);
		}else
		{
			$login = 'gagal';
			$userid=$this->input->post('user_nama');
			$pass=$this->input->post('kata_kunci');
			$where=array('username'=>$userid);
			$dataadmn=$this->ModelGue->GetWhere('admin_login',$where); 
			
			$data_account=array('username'=>$userid,'password'=>md5($pass));
			$dt_result_ceklogin = $this->ModelGue->cek_login('admin_login',$data_account);

			// echo $dt_result_ceklogin; exit();
			// ```````````````````````````````````````````````````````````````````
			
			if($dt_result_ceklogin==1 && $dataadmn->hak_akses==1){
				// echo "ada 1";
				// exit();
				$nama=$dataadmn->nama_karyawan;
				$this->session->set_userdata('userlogin',array(
					'nama'=>$nama,
					"level"=>$dataadmn->hak_akses,
				));
				$data=array('dt_hrd'=>$dt_result_ceklogin);
				$login = 'berhasil';
				
			}
			if($dt_result_ceklogin==1 && $dataadmn->hak_akses==2){
				// echo "ada 2";
				// exit();
				// periksa apakah login admin atau dosen
				// $wh=array('user_name'=>$userid,'pass'=>md5($pass));
				// $tipe=$this->mymodel->GetWhere('cuserid',$wh);
				// $this->load->view('admin/listdosen');
				// $sesi=array('user_name'=>$userid,'useraktif'=>'Administrator');
				$cek=array('pesan'=>'Selamat Datang'.$dt_result_ceklogin);
				$nama=$dataadmn->nama_karyawan;
				$this->session->set_userdata('userlogin',array(
					'nama'=>$nama,
					"level"=>$dataadmn->hak_akses,
				));
				$data=array('dt_uang'=>$dt_result_ceklogin);
				$login = 'berhasil';
			}
			if($dt_result_ceklogin==1 && $dataadmn->hak_akses==3){
				
				$cek=array('pesan'=>'Selamat Datang'.$dt_result_ceklogin);
				$nama=$dataadmn->nama_karyawan;
				$this->session->set_userdata('userlogin',array(
					'nama'=>$nama,
					"level"=>$dataadmn->hak_akses,
				));
				$data=array('owner'=>$dt_result_ceklogin);
				$login = 'berhasil';
			}

			$cek=array('pesan'=>'username dan password salah','login'=>$login);

			echo json_encode($cek);
			
			// $this->load->view('Index',$cek);
		}
	}
	function logout(){
		$this->session->sess_destroy();
		// redirect(base_url('Signin'));
			// $sesi=array('user_name'=>'','useraktif'=>'');
			$this->session->unset_userdata('userlogin');
			$x=base_url('Login');
			redirect($x);
	}
	

}
 ?>
