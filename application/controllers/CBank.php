<?php 
/**
* 
*/
class CBank extends CI_Controller
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
		$hasil=$this->ModelGue->semuadata('bank');
		$data=array('datadp'=>$hasil);
		$this->load->view('Bank/Listbank',$data);
	}
	function tambahbank(){
		$hasil=$this->ModelGue->semuadata('bank');
	
		$data= array('databank'=>$hasil);
		$this->load->view('Bank/NewBank',$data);
	}
	public function editbank($idBank){
		$where = array('idBank' =>$idBank );
		$dep=$this->ModelGue->GetWhere('bank',$where);

		$hsl=array('id'=>$dep->idBank,
					'nama'=>$dep->nm_Bank);
		echo json_encode($hsl);	
		
		// $data=array('datadepart'=>$dep);
		// $this->load->view('Department/Editdepartment',$data );
	}
	function savebank(){
		// buat validasi data
		$this->form_validation->set_rules('id','kode Bank','required|trim');
		$this->form_validation->set_rules('nama','Nama Bank','required|trim');
		
		if ($this->form_validation->run()== FALSE) {
			// $hasil=$this->modelsaya->semuadata('barang');
			$data= array('pesan'=>validation_errors());
			$this->load->view('Bank/NewBank',$data);
			// pesan error
		}else{
			// jika tidak error maka data disimpan
			$kod=$this->input->post('id');
			$nama=$this->input->post('nama');

			// validasi data double
			$x = array('idBank' =>$kod  );
			$cari=$this->ModelGue->GetWhere('bank',$x);
		if(count($cari)>0){
			// $hasil=$this->modelsaya->semuadata('barang');
			// $data= array();

			$hasil=$this->ModelGue->semuadata('bank');
			$data=array('datadp'=>$hasil,'idBank'=>$kod,'pesan'=>'data Id tidak boleh Sama');
			// $this->load->view('Department/Newdepartment',$data);
			$this->load->view('Bank/Listbank',$data);
		}else{
			$data = array('idBank' =>$kod ,'nm_Bank'=>$nama);
			// simpan data ke tabel 
			$this->ModelGue->insert('bank',$data);
			$a=base_url('CBank');
			redirect($a);
			// atau memanggil ke index
			// $this->index()
				}
			}
		}	

	function get_bank($id){
	
		$data = array('idBank'=>$id);
		$hasil = $this->ModelGue->GetWhere('bank',$data); 

		echo json_encode($hasil);
	}
	function delete_bank($id_Education){
		$syarat = array('idBank' => $id_Education );
		$this->ModelGue->delete('bank',$syarat);
		redirect(base_url('CBank'));
	}
	function updet_bank(){
		$kod=$this->input->post('id');
		$nama=$this->input->post('nama');

		echo json_encode($kod);
		
		
		$data = array('nm_Bank'=>$nama);
		
		// simpan data ke tabel education
		$where=array('idBank'=>$kod);
		$this->ModelGue->update('bank',$data,$where);

		
	}
	function get_data_user()
    {
        $list = $this->ModelData->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->idBank;
            $row[] = $field->nm_Bank;
            // $row[] = $field->user_alamat;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->User_model->count_all(),
            "recordsFiltered" => $this->User_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
 ?>