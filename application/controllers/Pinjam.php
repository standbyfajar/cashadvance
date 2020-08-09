<?php 
/**
* 
*/
class Pinjam extends CI_Controller
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
			

		
		//$this->load->library('Mylibrary');
		//$this->load->library('Fpdf');

	}


	function index(){

	
				if (!isset($this->session->hd)) 
				{
					$no= $this->ModelData->get_notrans();
					// $notransbaru= "TR".date('Y-m-d').sprintf("%03s",$no->transaksi+1);
					$n=$no->nota+1;
					// echo $n;
					$notransbaru="TR".date('y-m-d').substr('000'.$n,-3,3);

					$datasesi=array('permintaan'=>'','notrans'=>$notransbaru,'tanggal'=>date('y-m-d'),'id_karyawan'=>'');
					$this->session->set_userdata($datasesi);

					$this->session->set_userdata('hd',0);
					// buat session alamat dan no tel
					$sesi_pelanggan=array('department'=>'','jabatan'=>'','gaji'=>'');
					$this->session->set_userdata($sesi_pelanggan);
				}
			$nota=$this->session->notrans;
			$combokar=$this->ModelData->combokaryawan();
			
			$detiltrans=$this->ModelData->tampildata($nota);
			$PP=$this->ModelData->data_PP();
			
			// echo print_r($_SESSION);
			$data = array('comkar' =>$combokar,'datadetil'=>$detiltrans,'datapp'=>$PP);
			$this->load->view('Cash/SistemCashAdvance',$data);
		}
	

	public function transaksibaru()
{
	$idp=$this->session->notrans;
	$ses=array('hd'=>0,
				'notrans'=>'',
				'tgl_pinjam'=>'',
				'nik'=>'',
				'department'=>'',
				'position'=>'',
				'gaji'=>'');
	$this->session->unset_userdata($ses);
	$this->ModelData->updatenota($idp);
	$this->session->unset_userdata('hd',0);

	$this->session->set_userdata('pesan','Transakasi Baru sudah dapat digunakan');
	redirect(base_url().'Pinjam');
	//$this->index();
	
}

public function transaksibatal()
{
	$nota=$this->session->notrans;
	$kar=$this->session->id_karyawan;
	$hasil=$this->ModelData->data_detil($nota);
	$ses=array('hd'=>0,
				'permintaan'=>'',
				'notrans'=>'',
				'tgl_pinjam'=>'',
				'nik'=>'',
				'department'=>'',
				'tgl_pinjam'=>'',
				'position'=>'',
				'gaji'=>'');
	$this->session->set_userdata($ses);
	// foreach ($hasil as $row ) {
	// 		// trigger menambah stock jika cancel
	// 		$this->ModelData->update_gaji($row->id_karyawan,$row->pinjaman,"+");	
	// 	}

	$this->session->unset_userdata('hd');
	// ini udah bisa
	$where=array('id_pinjam'=>$nota);
	$wr=array('nik'=>$kar);
	$this->ModelGue->delete('h_cashadvance',$where);
	$this->ModelGue->delete('pinjaman',$wr);

	// $gj=$this->session->gaji;
	// $dat=$this->ModelGue->GetWhere('d_cashadvance',$where);
	$this->session->set_userdata('pesan','Data Transakasi Telah dibatalkan');
	redirect(base_url().'Pinjam');
	
}
	function ckaryawan(){
		$id=$this->input->post('idk');
		// tabel karyawan
		$data=$this->ModelData->tampil_nama($id);
		// $id=$data->id_karyawan;

		// ambil data tb pinjaman
		$dt=$this->ModelData->cek_id($id);
		$dataa=$dt->row();
		if ($dt->num_rows()>0) {
			
			$jar['gaji']=$dataa->gaji_blndpn;
		}else{
			$jar['department']=$data->id_department;
			$jar['jabatan']=$data->position;
			$jar['gaji']=$data->gaji;

		}
			$jar['department']=$data->id_department;
			$jar['jabatan']=$data->position;

			// $jar['gaji']=$data->gaji;

		echo json_encode($jar);
	}
	function carinama(){
		$nama=$this->input->get('nama_karyawan');
		$query=$this->ModelData->CariNama($nama);
		foreach ($query->result() as $row ) {
			echo "$row->nama_karyawan \n";
		}
	}
	function save(){
			$pp=$this->input->post('pp');
			$notr=$this->input->post('pinjam');
			$tgl=$this->input->post('tanggal');
			$kar=$this->input->post('karyawan');
			$gaj=$this->input->post('gajihidden');
			$ad=$this->input->post('admin');
			$dep=$this->input->post('dep');
			$post=$this->input->post('jbt');

			$tot=$this->input->post('totalbayar');
			$bln=$this->input->post('bln');
			// $jbt=$this->input->post('jbt');
			// $gj=$this->input->post('gaji');
			$pj=$this->input->post('uang');
			$ket=$this->input->post('kete');
			
			$this->form_validation->set_rules('karyawan','<b><i>karyawan </i></b>','required');
			$this->form_validation->set_rules('uang','<b><i>Nominal Uang</i></b>','required|numeric');
			$this->form_validation->set_rules('tanggal','<b><i>tanggal</i></b>','required');
			//--cek validasi data--
			if ($this->form_validation->run() == FALSE ) { 
				$this->session->set_userdata('pesan','Data belum lengkap, '.validation_errors());
				redirect(base_url().'Pinjam');
				exit;
			}
			// $bl=$this->input->post('bln');
		if ($this->session->hd==0) {


			$data = array('id_pinjam' =>$notr ,
				'tgl_pinjam'=>$tgl,
				'nik'=>$kar,
				'id_admin'=>$ad,
				'id_department'=>$dep,
				'position'=>$post,
				'total'=>$tot);
			$dt2=array('nik'=>$kar,'gaji'=>$gaj,'pinjaman'=>$pj,'gaji_blndpn'=>$bln,'datetime'=>date("Y-m-d")." ".(date('H')+6).":".date("i:s"));
			// simpan data ke tabel tr
			$this->ModelGue->insert('h_cashadvance',$data);
			$this->ModelGue->insert('pinjaman',$dt2);
			
			$sesi=array('hd'=>1,'permintaan'=>$pp,'id_pinjam'=>$notr,'tgl_pinjam'=>$tgl,'id_admin'=>$ad,'id_karyawan'=>$kar,'department'=>$dep,'position'=>$post);
			$this->session->set_userdata($sesi);

			$kar=$this->ModelData->data_karyawan($sesi['id_karyawan']);
			$sesi=array('department'=>$kar->id_department,'position'=>$kar->position,'gaji'=>$kar->gaji);
			$this->session->set_userdata($sesi);

		}
		$dat=array('gaji'=>$this->input->post('bln'));
		$this->session->set_userdata($dat);
		//update header
		$data=array(
			// 'id_pinjam' =>$notr ,
			'tgl_pinjam'=>$tgl,
			'nik'=>$this->session->id_karyawan,
			'id_admin'=>$ad
			);

		$where=array('id_pinjam'=>$notr);
		$this->ModelGue->update('h_cashadvance',$data,$where);
		
		// simpan data detil
		$data=array('id_pinjam'=>$this->input->post('pinjam'),
			
			'jumlah_pinjam'=>(int)$this->input->post('uang'),
			'keterangan'=>$this->input->post('kete'));
		$this->ModelGue->Insert('d_cashadvance',$data);
		// // update no transaksi
		// $idp=$this->session->notrans;
		// $ses=array('hd'=>0,
		// 			'notrans'=>'',
		// 			'tgl_pinjam'=>'',
		// 			'nik'=>'',
		// 			'department'=>'',
		// 			'position'=>'',
		// 			'gaji'=>'');
		// $this->session->unset_userdata($ses);
		// $this->ModelData->updatenota($idp);
		// $this->session->unset_userdata('hd',0);

		$this->session->set_userdata('pesan','Data Telah Disimpan');
		redirect(base_url().'Pinjam');
	}
	function delete_detil($id_pinjam,$index)

		{
			
			$where=array('id_pinjam'=>$id_pinjam,'index'=>$index);
			$gj=$this->session->gaji;
			$dat=$this->ModelGue->GetWhere('d_cashadvance',$where);

			// gaji balik
			$gaji_yg_ada=$dat->jumlah_pinjam;

			$hsl=$gj+$gaji_yg_ada;

			$jadi=array('gaji'=>$hsl);
			$this->session->set_userdata($jadi);
			// ini script ngapus dateta detail
			$this->ModelGue->delete('d_cashadvance',$where);

			$this->session->set_userdata('pesan','Data barang sudah dihapus');
			redirect(base_url().'Pinjam');
		}

		public function Cetak_form($id_pinjam){
			// $nota=$this->session->notrans;
		$where=array('id_pinjam'=>$id_pinjam);
		$data1=$this->ModelData->Penjualan_header($id_pinjam);
		
		$data2=$this->ModelData->penjualan_detil($id_pinjam);

		// echo "<pre>";
		// var_dump($data2);
		// exit();
		
		
		$this->load->library('fpdf');		
		$pdf = new FPDF('P','mm','A5');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',9);
		$pdf->Ln();

		$pdf->Cell(120,7,'Faktur Peminjaman Cash Advance',0,1,'C');
		$title = 'Faktur Peminjaman Cash Advance';
		$pdf->SetTitle($title);
		$pdf->SetAuthor('Fajar Karunia');
		$pdf->Cell(20, 4, 'Id Pinjam', 0, 0, 'L'); 
		$pdf->Cell(55, 4, ' : '.$data1->id_pinjam, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(20, 4, 'Tanggal', 0, 0, 'L');
		$pdf->Cell(85, 4, ' : '.$data1->tgl_pinjam, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(20, 4, 'Admin', 0, 0, 'L'); 
		$pdf->Cell(85, 4, ' : '.$data1->id_admin, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(20, 4, 'Karyawan', 0, 0, 'L'); 
		$pdf->Cell(85, 4, ' : '.$data1->nama_karyawan, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(20, 4, 'No Telfon', 0, 0, 'L'); 
		$pdf->Cell(85, 4, ' : '.$data1->nomor_telpon, 0, 0, 'L');
		$pdf->Ln();
		// //$pdf->Cell(130, 5, '--------------------------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		// untuk detail
		$pdf->Cell(25, 5, 'Kode Pinjam', 1, 0, 'L');
		// $pdf->Cell(40, 5, 'Nama Karyawan', 1, 0, 'L');
		$pdf->Cell(35, 5, 'Keterangan', 1, 0, 'R');
		$pdf->Cell(50, 5, 'Nominal Pinjam', 1, 0, 'R');
		// $pdf->Cell(25, 5, 'Total', 1, 0, 'R');
		//$pdf->Ln();
		// //$pdf->Cell(130, 5, '--------------------------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		
		foreach ($data2 as $row)  {
			$pdf->Ln();
			$pdf->Cell(25, 5, $row->id_pinjam, 1, 0, 'L');
		
			$pdf->Cell(35, 5, $row->keterangan, 1, 0, 'R');
			$pdf->Cell(50, 5, number_format($row->jumlah_pinjam,0), 1, 0, 'R');
			
		}
		$pdf->Ln();
		// //$pdf->Cell(130, 5, '--------------------------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		
		$pdf->Cell(60, 5, 'Total', 1, 0, 'R');
		$pdf->Cell(50, 5, number_format($data1->total,0), 1,0,'R');
		$pdf->Ln();
		// //$pdf->Cell(131, 5, '----------------------------------', 0, 0, 'R');
		$pdf->Ln();
		
		$pdf->Cell(130, 5, "Terimakasih ", 0, 0, 'C');

		$pdf->Output();


		}

	function laporan_perbul(){

	
		// jika belom disi tanggal
		$this->session->set_userdata('muncul',False);
		$this->load->view('Cash/LaporanPerPeriode');
	}
	function laporan(){

		$kr=$this->ModelData->combokaryawan();
		$data=array('cmbkar'=>$kr);

		// jika belom disi tanggal
		$this->session->set_userdata('muncul',False);
		$this->load->view('Cash/LaporanPerUser',$data);
	}

	function laporantrans(){
		$hasil=$this->ModelGue->semuadata('tampilreporttransaksi');
		$data=array('datadp'=>$hasil);
		$this->load->view('Laporan/LaporanTRCash',$data);
	}
	function get($id){
	
		$data = array('id_pinjam'=>$id);
		$hasil = $this->ModelGue->GetWhere('tampilreporttransaksi',$data); 

		echo json_encode($hasil);
	}
	function act_preview(){
		// jika belom di klik preview
		// $kar=$this->ModelData->combokaryawan();
		// $data=array('cmbarang'=>$kar);
		$this->session->set_userdata('muncul',true);

		$tglawal=$this->input->post('dari');
		$tglakhir=$this->input->post('sampai');
		// $kode_barang= $this->input->post('barang');

		$this->session->set_userdata('tglawal',$tglawal);
		$this->session->set_userdata('tglakhir',$tglakhir);
		// $this->session->set_userdata('barang',$kode_barang);

		$a=$this->ModelData->laporan_bln($tglawal,$tglakhir);
		// $b= $this->ModelData->laporan_user($tglawal,$tglakhir,$kode_barang);

		$tglawal=$this->mylibrary->format_tanggal($tglawal);
		$tglakhir=$this->mylibrary->format_tanggal($tglakhir);

		// if ($this->session->set_userdata('barang',$kode_barang)) {
		$data=array('laporan'=>$a,'tglawal'=>$tglawal,'tglakhir'=>$tglakhir);
		// }else{
		
		// $data=array('laporantgl'=>$a,'tglawal'=>$tglawal,'tglakhir'=>$tglakhir);

		$this->load->view('Cash/LaporanPerPeriode',$data);
		// $this->load->view('transaksi/preview_laporan_tgl',$data1);

		// }
	}
	function act_preview_karyawan(){
		// jika belom di klik preview
		$this->session->set_userdata('muncul',true);
		$kar=$this->ModelData->combokaryawan();
		$data=array('cmbkar'=>$kar);
		
		$tglawal=$this->input->post('dari');
		$tglakhir=$this->input->post('sampai');
		$kd_karyawan= $this->input->post('karyawan');

		$this->session->set_userdata('tglawal',$tglawal);
		$this->session->set_userdata('tglakhir',$tglakhir);
		$this->session->set_userdata('karyawan',$kd_karyawan);

		// $a=$this->ModelData->laporan_bln($tglawal,$tglakhir);
		$b= $this->ModelData->laporan_user($tglawal,$tglakhir,$kd_karyawan);

		$tglawal=$this->mylibrary->format_tanggal($tglawal);
		$tglakhir=$this->mylibrary->format_tanggal($tglakhir);

		// if ($this->session->set_userdata('barang',$kode_barang)) {
		$data=array('laporan'=>$b,'cmbkar'=>$kar,'tglawal'=>$tglawal,'tglakhir'=>$tglakhir,'karyawan'=> $kd_karyawan);
		// }else{
		
		// $data=array('laporantgl'=>$a,'tglawal'=>$tglawal,'tglakhir'=>$tglakhir);

		$this->load->view('Cash/LaporanPerUser',$data);
		// $this->load->view('transaksi/preview_laporan_tgl',$data1);

		// }
	}
	public function list_Penjualan_pdf(){
		$this->session->set_userdata('muncul',true);


		$tglawal=$this->session->tglawal;
		$tglakhir=$this->session->tglakhir;

		$a=$this->ModelData->laporan_bln($tglawal,$tglakhir);
		$tglawal=$this->mylibrary->format_tanggal($tglawal);
		$tglakhir=$this->mylibrary->format_tanggal($tglakhir);

		$this->load->library('fpdf');
		$pdf= new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',9);
		$title="LAPORAN Peminjaman Cash Advance PER PERIODE";
		$pdf->SetTitle($title);
		$pdf->SetAuthor('Fajar karunia');
		$pdf->Cell(200,4,'Laporan Peminjaman Cash Advance Per Bulan ',0,1,'C');
		$pdf->Cell(205,4,'Di PT Amarta Gemilang ',0,1,'C');

		$pdf->Ln();

		$pdf->Cell(8,8,'No',1,0,'C');
		$pdf->Cell(35,8,'Id Pinjam',1,0,'C');
		$pdf->Cell(25,8,'Tanggal',1,0,'C');
		$pdf->Cell(60,8,'Jumlah Pinjam',1,0,'C');
		$pdf->Cell(25,8,'Keterangan',1,0,'C');
		$pdf->Cell(30,8,'Total',1,0,'C');

		$no=0;
		$total=0;
		foreach ($a as $row ) {
		$no++;	
		$total += $row->total;

		$pdf->Ln();

		$pdf->Cell(8,8,$no,1,0,'C');
		$pdf->Cell(35,8,$row->id_pinjam,1,0,'C');
		$pdf->Cell(25,8,$row->tgl_pinjam,1,0,'C');
		$pdf->Cell(60,8,$row->jumlah_pinjam,1,0,'C');
		$pdf->Cell(25,8,$row->keterangan,1,0,'C');
		$pdf->Cell(30,8,number_format($row->total,0),1,0,'C');
	
				}
		$pdf->Ln();

		$pdf->Cell(153,8,'Grand Total',1,0,'C');
		$pdf->Cell(30,8,number_format($total,0),1,0,'C');
		

		$pdf->Output();

	}

	public function list_peminjaman_user_pdf(){
		$this->session->set_userdata('muncul',true);


		$tglawal=$this->session->tglawal;
		$tglakhir=$this->session->tglakhir;
		$kd_karyawan=$this->session->karyawan;

		$a=$this->ModelData->laporan_user($tglawal,$tglakhir,$kd_karyawan);
		$tglawal=$this->mylibrary->format_tanggal($tglawal);
		$tglakhir=$this->mylibrary->format_tanggal($tglakhir);

		$this->load->library('fpdf');
		$pdf= new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',9);
		$title="LAPORAN Peminjaman Cash Advance PER PERIODE";
		$pdf->SetTitle($title);
		$pdf->SetAuthor('Fajar karunia');
		$pdf->Cell(200,4,'Laporan Peminjaman Cash Advance Per user ',0,1,'C');
		$pdf->Cell(205,4,'Di PT Amarta Gemilang ',0,1,'C');

		$pdf->Ln();

		$pdf->Cell(8,8,'No',1,0,'C');
		$pdf->Cell(35,8,'Id Pinjam',1,0,'C');
		$pdf->Cell(35,8,'nama karyawan',1,0,'C');
		$pdf->Cell(25,8,'Tanggal',1,0,'C');
		$pdf->Cell(60,8,'Jumlah Pinjam',1,0,'C');
		$pdf->Cell(25,8,'Keterangan',1,0,'C');
		// $pdf->Cell(30,8,'Total',1,0,'C');

		$no=0;
		foreach ($a as $row ) {
		$no++;	
		

		$pdf->Ln();

		$pdf->Cell(8,8,$no,1,0,'C');
		$pdf->Cell(35,8,$row->id_pinjam,1,0,'C');
		$pdf->Cell(35,8,$row->nama_karyawan,1,0,'C');
		$pdf->Cell(25,8,$row->tgl_pinjam,1,0,'C');
		$pdf->Cell(60,8,$row->jumlah_pinjam,1,0,'C');
		$pdf->Cell(25,8,$row->keterangan,1,0,'C');
		// $pdf->Cell(30,8,number_format($row->total,0),1,0,'C');

				}
		

		$pdf->Output();

	}

	public function cetak_transaksi()
{
	$nota=$this->session->notrans;
	$where=array('id_pinjam'=>$nota);
	$dataheader=$this->ModelData->Penjualan_header($nota);
	if(count($dataheader)==0) {
		$this->session->set_userdata('pesan','Belum ada data');
		redirect(base_url().'Pinjam');
		exit;
	}
	$datadetil=$this->ModelData->Penjualan_detil($nota);
	$this->load->library('fpdf');		
		$pdf = new FPDF('P','mm','A5');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',9);
		$pdf->Ln();

		$pdf->Cell(120,7,'Faktur Peminjaman Cash Advance',0,1,'C');
		$title = "Faktur Peminjaman Cash Advance";
		$pdf->SetTitle($title);
		$pdf->SetAuthor("Fajar Karunia");
		$pdf->Cell(20, 4, 'Id Pinjam', 0, 0, 'L'); 
		$pdf->Cell(55, 4, ' : '.$nota, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(20, 4, 'Tanggal', 0, 0, 'L');
		$pdf->Cell(85, 4, ' : '.$dataheader->tgl_pinjam, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(20, 4, 'Admin', 0, 0, 'L'); 
		$pdf->Cell(85, 4, ' : '.$dataheader->id_admin, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(20, 4, 'Karyawan', 0, 0, 'L'); 
		$pdf->Cell(85, 4, ' : '.$dataheader->nama_karyawan, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(20, 4, 'No Telfon', 0, 0, 'L'); 
		$pdf->Cell(85, 4, ' : '.$dataheader->nomor_telpon, 0, 0, 'L');
		$pdf->Ln();
		//$pdf->Cell(130, 5, '--------------------------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		// untuk detail
		$pdf->Cell(25, 5, 'Kode Pinjam', 1, 0, 'L');
		// $pdf->Cell(40, 5, 'Nama Karyawan', 1, 0, 'L');
		$pdf->Cell(35, 5, 'Keterangan', 1, 0, 'R');
		$pdf->Cell(50, 5, 'Nominal Pinjam', 1, 0, 'R');
		// $pdf->Cell(25, 5, 'Total', 1, 0, 'R');
		//$pdf->Ln();
		//$pdf->Cell(130, 5, '--------------------------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		
		foreach ($datadetil as $row)  {
			$pdf->Ln();
			$pdf->Cell(25, 5, $row->id_pinjam, 1, 0, 'L');
			// $pdf->Cell(40, 5, $row->nama_karyawan, 1, 0, 'L');
			$pdf->Cell(35, 5, $row->keterangan, 1, 0, 'R');
			$pdf->Cell(50, 5, number_format($row->jumlah_pinjam,0), 1, 0, 'R');
			// $pdf->Cell(25, 5, number_format($row->total,0), 1,0,'R');
		}
		//$pdf->Ln();
		//$pdf->Cell(130, 5, '--------------------------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(60, 5, 'Total', 1, 0, 'R');
		$pdf->Cell(50, 5, number_format($dataheader->total,0), 1,0,'R');
		$pdf->Ln();
		//$pdf->Cell(131, 5, '----------------------------------', 0, 0, 'R');
		$pdf->Ln();
		
		$pdf->Cell(130, 5, "Terimakasih ", 0, 0, 'C');

		$pdf->Output();
	//redirect(base_url().'Penjualan');
	//$this->index();
}
}
 ?>