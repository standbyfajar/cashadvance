<?php 
/**
* 
*/
class Cpermintaan extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->helper('form');
		$this->load->helper('url');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('ModelGue');
		$this->load->model('ModelData');
		$this->load->library('Mylibrary');
	}

	function index(){
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

	function cekjumlahdata($nik){
		$jumlahpinjam = $this->ModelData->jumlahpinjam($nik);
		$jp=$jumlahpinjam->jumlahpinjam;
		$data=array('jumlahpinjam'=>$jp);
		echo json_encode($data);
	}
	function ckaryawan(){
		$id=$this->input->post('idp');
		// tabel karyawan
		$data=$this->ModelData->tampil_nama($id);
		// $id=$data->id_karyawan;
		$jar['id_department']=$data->id_department;
		$jar['position']=$data->position;
		$jar['jumlah_transaksi']=$data->jumlah_transaksi;

		echo json_encode($jar);
	}
	public function transaksibaru()
{
	$idp=$this->session->noPP;
	$ses=array('hd'=>0,
				'noPP'=>'',
				'tanggal'=>'',
				'nik'=>'',
				'department'=>'',
				'position'=>'');
	$this->session->unset_userdata($ses);
	$this->ModelData->updatePP($idp);
	$this->session->unset_userdata('hd',0);

	$this->session->set_userdata('pesan','Transakasi Baru sudah dapat digunakan');
	redirect(base_url().'Cpermintaan');
	//$this->index();
	
}

public function transaksibatal()
{
	$nota=$this->session->noPP;
	$kar=$this->session->id_karyawan;
	$hasil=$this->ModelData->data_detil($nota);
	$ses=array('hd'=>0,
				'noPP'=>'',
				'tanggal'=>'',
				'nik'=>'',
				'department'=>'',
				'tanggal'=>'',
				'position'=>'');
	$this->session->set_userdata($ses);
	// foreach ($hasil as $row ) {
	// 		// trigger menambah stock jika cancel
	// 		$this->ModelData->update_gaji($row->id_karyawan,$row->pinjaman,"+");	
	// 	}

	$this->session->unset_userdata('hd');
	// ini udah bisa
	$where=array('No_PP'=>$nota);
	// $wr=array('id_karyawan'=>$kar);
	$this->ModelGue->delete('cashadvancepermit',$where);
	// $this->ModelGue->delete('pinjaman',$wr);

	// $gj=$this->session->gaji;
	// $dat=$this->ModelGue->GetWhere('d_cashadvance',$where);
	$this->session->set_userdata('pesan','Data Transakasi Telah dibatalkan');
	redirect(base_url().'Cpermintaan');
	
}
	function save(){
			$notr=$this->input->post('pp');
			$kar=$this->input->post('karyawan');
			$dep=$this->input->post('dephid');
			$jbt=$this->input->post('jbthid');
			$tgl=$this->input->post('tanggal');
			
			$ad=$this->input->post('admin');
			
			$ket=$this->input->post('kete');
			
			$this->form_validation->set_rules('karyawan','<b><i>karyawan </i></b>','required');
			$this->form_validation->set_rules('tanggal','<b><i>tanggal</i></b>','required');
			//--cek validasi data--
			if ($this->form_validation->run() == FALSE ) { 
				$this->session->set_userdata('pesan','Data belum lengkap, '.validation_errors());
				redirect(base_url().'Cpermintaan');
				exit;
			}
			// $bl=$this->input->post('bln');
		if ($this->session->hd==0) {


			$data = array('No_PP' =>$notr ,
				'nik'=>$kar,'id_department'=>$dep,'position'=>$jbt,
				'tanggal'=>$tgl,
				'admin'=>$ad,'deskripsi'=>$ket);
			$this->ModelGue->insert('cashadvancepermit',$data);
			// $dt2=array('id_karyawan'=>$kar,'gaji'=>$gaj,'pinjaman'=>$pj,'gaji_blndpn'=>$bln,'datetime'=>date("Y-m-d")." ".(date('H')+6).":".date("i:s"));
			// simpan data ke tabel tr
			// $this->ModelGue->insert('pinjaman',$dt2);
			
			$sesi=array('hd'=>1,'noPP'=>$notr,'tanggal'=>$tgl,'admin'=>$ad,'nik'=>$kar);
			$this->session->set_userdata($sesi);

			$kar=$this->ModelData->data_karyawan($sesi['nik']);
			$sesi=array('department'=>$kar->id_department,'position'=>$kar->position);
			$this->session->set_userdata($sesi);

		}
		// $dat=array('gaji'=>$this->input->post('bln'));
		// $this->session->set_userdata($dat);
		// //update header
		$data=array(
			 'No_PP' =>$notr ,
			'tanggal'=>$tgl,
			'nik'=>$this->session->nik,
			'admin'=>$ad
			);

		$where=array('No_PP'=>$notr);
		$this->ModelGue->update('cashadvancepermit',$data,$where);
		
		// update no trans
		$idp=$this->session->noPP;

		$ses=array('hd'=>0,
					'noPP'=>'',
					'tanggal'=>'',
					'nik'=>'',
					'department'=>'',
					'position'=>'');
		$this->session->unset_userdata($ses);
		$this->ModelData->updatePP($idp);
		$this->session->unset_userdata('hd',0);

		// // simpan data detil
		// $data=array('No_PP'=>$this->input->post('pp'),
			
		// 	'jumlah_pinjam'=>(int)$this->input->post('uang'),
		// 	'keterangan'=>$this->input->post('kete'));
		// $this->ModelGue->Insert('d_cashadvance',$data);
		
		$this->session->set_userdata('pesan','Data Telah Disimpan');
		redirect(base_url().'Cpermintaan');

		
	}
	function delete_detil($id_pinjam)

		{
			
			$where=array('No_PP'=>$id_pinjam);
			
			$dat=$this->ModelGue->GetWhere('cashadvancepermit',$where);

			// ini script ngapus dateta detail
			$this->ModelGue->delete('cashadvancepermit',$where);

			$this->session->set_userdata('pesan','Data permintaan peminjam sudah dihapus');
			redirect(base_url().'Cpermintaan');
		}

	public function Cetak_form($noPP){
			$this->session->set_userdata('muncul',true);
	
			$where=array('nomorPP'=>$noPP);
			$datadetil=$this->ModelData->cetak_formPP($noPP);	

			// if (count($datadetil)==0) {
			// 	$this->session->set_userdata('pesan','Belum ada data');
			// 	redirect(base_url().'Cpermintaan');
			// 	exit;
			// }
			$this->load->library('fpdf');
			$pdf= new FPDF('P','mm','A4');
			$pdf->AddPage();
			// judul baris 1
			$pdf->SetFont('Arial','B',14);
			$title="Form Permintaan Peminjaman";
			$pdf->SetTitle($title);
			$pdf->SetAuthor('Fajar karunia');
			// cell(width,height,text,border,endline, align)
				$pdf->Cell(200,4,'Form Permintaan Peminjaman  ',0,1,'C');
				$pdf->Cell(205,4,'Di PT Amarta Gemilang ',0,1,'C');
				$pdf->Cell(205,4,'Jln Pintu Air Utara ',0,1,'C');

			$pdf->Ln();
			$pdf->SetFont('Arial','',11);
			// cell(width,height,text,border,endline, align)
			// $pdf->Cell(8,8,'',1,0,'C');
				$pdf->Cell(95,8,'No PP ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->No_PP,0,1,'C');


				$pdf->Cell(95,8,'Tanggal ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->tanggal,0,1,'C');

				$pdf->Cell(95,8,'NIK ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->nik,0,1,'C');

				$pdf->Cell(95,8,'admin ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->admin,0,1,'C');

				$pdf->Cell(95,8,'Deskripsi ',0,0,'C');
				$pdf->Cell(5,8,':',0,0,'C');
				$pdf->Cell(45,8,$datadetil->deskripsi,0,1,'C');

			$pdf->Ln();
				$pdf->SetLineWidth(0.5);
				$pdf->Line(20, 25, 190, 25);

			$pdf->Ln();
				//menentukan tebal
				$pdf->SetLineWidth(0.5);
				
				//menentukan titik awal dan titik akhir garis yang akan di buat (x1,y1,x2,y2)
				$pdf->Ln();
				$pdf->Cell(300,5,'Prepared By,',0,1,'C');
				$pdf->Line(85, 135, 45, 135); 
				$pdf->Cell(60,70,$datadetil->nama_karyawan,0,0,'R');  //nama 
				$pdf->Line(135, 135, 175, 135); 
				$pdf->Cell(100,70,$datadetil->admin,0,1,'R');  //nama 



				// $pdf->Line(85, 125, 125, 125); 

			
			

			$pdf->Output();

		}
}
 ?>