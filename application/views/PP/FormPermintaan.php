<?php
if (isset($this->session->userlogin)==FALSE) {
redirect(); //= memanggil routes nya boleh di isi redirect('signin/login')
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Permintaan Peminjaman Uang</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- untuk hape -->
	<meta http-equiv="content-Language" content="en-us">
	<meta charset="utf-8">
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/js/jquery.autocomplete.css') ?>">
	<!-- jQuery -->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js')?>"></script>
    <!-- jQuery Autocomplete -->
    <script src="<?php echo base_url('assets/js/jquery.autocomplete.js') ?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>

	<link rel="icon" href="<?php echo base_url('image/era.jpg') ?>" type="image/ico" />
	<!-- <link href='<?php //echo base_url('cash.png') ?>' rel='shortcut icon'> -->

	<!-- tambahan -->
 <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/vendors/iCheck/skins/flat/green.css')?>" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')?>" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets/vendors/jqvmap/dist/jqvmap.min.css')?>" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.css')?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.min.css')?>" rel="stylesheet">
</head>
<script >		

				
				function hanyaAngka(evt) {
				// alert('a');
				  var charCode = (evt.which) ? evt.which : event.keyCode;
				   if (charCode > 31 && (charCode < 48 || charCode > 57))
		 
				    return false;
				  return true;
				}
				function hanyaChar(evt){
				// alert('a');

					 var charCode = (evt.which) ? evt.which : event.keyCode;
			         if ((charCode < 65) || (charCode == 32))
			            return false;        
			         return true;
				}
					function HitungTotalBayar(){
						var $total=0;
						$('#TabelCash tbody tr').each(function(){
						
							if($(this).find('td:nth-child(2) input').val()>0 ){
								// var subtotal = $('input#uang').val();
								$total += parseInt($('input#uang').val());
							}
						});
						$('#TotalBayarHidden').val(total);
						$('#TotalBayar').html('Rp'+to_rupiah(total));

						
					}
			
			function to_rupiah(angka){
				var rev= parseInt(angka,10).toString().split('').reverse().join('');
				var rev2= '';
				for (var i = 0 ;i<rev.length;  i++) {
					rev2 += rev[i];
					if ((i+1) % 3 === 0 && i !== (rev.length -1)) {
						rev2 += '.';
					}
				}
				return rev2.split('').reverse().join('');
			}

			var jumlahpinjam = 0;

			
			// function cek(nik){
				// $.ajax({
				// 	url:"<?php echo base_url('Cpermintaan/cekjumlahdata/'); ?>"+nik,
				// 	type:"POST",
				// 	// data: "nik="+$nik,
				// 	dataType:"json",
				// 	success:function(jar){
				// 		// alert(jar.jumlahpinjam);
				// 		jumlahpinjam = jar.jumlahpinjam;
				// 		//alert(jumlahpinjam);
				// 	}

				// })
			//}
			
	$(document).ready(function(){
	
			

			$("#karyawan").change(function(){
			if ($("#karyawan").val()!=="") {

				
				$.ajax({
					url:"<?php echo base_url('Cpermintaan/ckaryawan'); ?>",
					type:"POST",
					data:"idp="+$(this).val(),
					dataType:"json",
					success: function(jar){
						//alert('aa');

						if( jar.jumlah_transaksi >= 2 ){
							$("#dep").html(jar.id_department);
							$("#dephid").val(jar.id_department);
							$("#jbt").html(jar.position);
							$("#jbthid").val(jar.position);
							// tombol tidak bisa disimpan
							alert('Transaction not allowed, Only 2 ');
							$("#simpan").attr('disabled',true);
						}else if( jar.jumlah_transaksi = 1 ){
							$("#dep").html(jar.id_department);
							$("#dephid").val(jar.id_department);
							$("#jbt").html(jar.position);
							$("#jbthid").val(jar.position);

							$("#simpan").attr('disabled',false);
						}
						else{
							$("#dep").html('<i>Tidak Ada </i>');
							$("#dephid").val('<i>Tidak Ada </i>');

							$("#jbt").html('<i>Tidak Ada </i>');
							$("#jbthid").val('<i>Tidak Ada </i>');

						}
						

					}
				});
				
			
			 }
			});



			// pengurangan gaji dari session
			// $('#uang').keyup(function(){
			// 	gj=$('#gaji').html();
			// 	uang=$(this).val();
			// 	// alert(gj);
			// 	blndpn=gj-uang;
			// 	$('#bln').val(blndpn);
			// 	$('input#TotalBayarHidden').val($(this).val());
			// 	// alert(uang);
			// 	HitungTotalBayar();
			// })

		});
</script>


	<!-- // <?php //echo $this->session->nota; ?> -->
	<style type="text/css">
		body{
			background: #f1f1f1;
		}
		.panel-primary .form-group{
			margin-bottom: 10px;
		}
		.form-control{
			border-radius: 0px;
			box-shadow: none;
		}
	</style>
	<?php 
	
	 ?>
<!-- ,menu atas -->

<?php 
	if (isset($this->session->pesan)) {
		$message=$this->session->pesan;
		$this->session->unset_userdata('pesan');
	}
	
	$no=0;
	$total=0;
	 ?>

	 	

<body class="nav-md">
    <div class="container body">
		<div class="main_container">
        <?php $this->load->view('sampingatasmenu.php'); ?>
          <?php $this->load->view('topnav'); ?>	 
        <!-- page content -->     
        <div class="right_col" role="main">	
		<div class="container-fluid">
			<form class="form-horizontal" name="formbook" enctype="multipart/form-data" action="<?php echo base_url('Cpermintaan/save') ?>" method="POST" >
	
			<div class="row">

			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel-heading"><i class="glyphicon glyphicon-cog "></i> Permintaan Peminjaman Uang</div>
					<div class="panel-body">
							<!-- panel pertama kiri -->
							<div class="col-sm-6">
									<div class="form-group">
									<label style="margin-top: 5px;" class="col-sm-4 control-label">No. PP</label>
										<div class="col-sm-6">
									<?php print_r($_SESSION); ?> 
									<input type="text" name="pp" id="pp" class="form-control" value="<?php echo $this->session->noPP; ?>" readonly>
										</div>
									</div>

			

			
									<div class="form-group">
									<label for="karyawan" class="col-sm-4 control-label">Karyawan</label>
									<div class="col-sm-6">
										<!-- <input type="text" class="form-control" name="karyawan" id="karyawan" value="<?php //echo $this->session->id_karyawan; ?>" > -->

									<select  class="form-control input md" id="karyawan" name="karyawan">
										<option value="">====PILIH====</option> 
										<?php 
											
											foreach ($comkar->result() as $row) {
												if ($row->nik==$this->session->nik) {
													$pilih="selected";
												}else{
													$pilih="";
												}
											

											echo "<option value='$row->nik' $pilih>
											$row->nama_karyawan
										</option>";																	
										}						
										 ?>
									</select> 
										</div>
									</div>

									<div class="form-group">
										<label for="alamat" class="col-sm-4 control-label">Department</label>
									<div  class="col-sm-8">
									<input type="hidden" name="dephid" id="dephid" value="<?php echo $this->session->department; ?>" readonly>
									<div id="dep" name="dep" class="control-label" style="text-align: left;"><?php echo $this->session->department; ?>
									</div>
										</div>
									</div>
										<div class="form-group">
												<label for="alamat" class="col-sm-4 control-label">Position</label>
											<div  class="col-sm-8">
											<input type="hidden" name="jbthid" id="jbthid" value="<?php echo $this->session->position; ?>" readonly>

											<div id="jbt" name="jbt" class="control-label" style="text-align: left;"><?php echo $this->session->position; ?>
											</div>
											</div>
										</div>
										


									<?php if (isset($message)) {?>
									<div class="alert alert-danger" role="alert">
										<button type="button" class="close" data-dismiss="alert"> <i class="glyphicon glyphicon-remove"></i> </button>
										<h4>Pesan</h4>
										<?php echo $message; ?>
									</div>
								<?php } ?>
									
								
						<!-- penutup panel pertama kiri -->
							</div>

								<!-- panel kanan -->
										<div class="col-sm-6">

											<div class="col-sm-12">
											<div class="form-group">
											<label style="margin-top: 5px;" class="col-sm-4 control-label">Tanggal</label>
												<div class="col-sm-8">
												
											<input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo $this->session->tanggal; ?>">
												</div>
											</div>

											<div class="form-group">
											<label style="margin-top: 5px;" class="col-sm-4 control-label">Admin</label>
												<div class="col-sm-8">
											<input type="text" name="admin" id="admin" class="form-control" value="<?php echo $this->session->userlogin['nama']; ?>" readonly>
												</div>
											</div>
										

											<div class="form-group">
											<label style="margin-top: 5px;" class="col-sm-4 control-label">Deskripsi</label>
												<div class="col-sm-8">
											<textarea name="kete" id="kete" class="form-control"></textarea>
												</div>
											</div>

											
												<div class="form-group">
											<label style="margin-top: 5px;" class="col-sm-4 control-label"></label>
												<div class="col-sm-8">
											<button type="submit" class="btn btn-success btn-xs" title="Simpan" id="simpan">Simpan<span class="glyphicon glyphicon-log-in"></span></button>
												</div>
											</div>

											</div>
											
										
										</div>
					<!-- batas penutup  kanan -->
				</div>
		<!-- batas atas panel body -->

			</div>
	<!-- batas atas panel primary -->
		
		</div>
<!-- tutuproow -->
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-primary">
			<div class="panel-heading"><i class="glyphicon glyphicon-cog "></i> Informasi Permintaan Peminjaman Uang</div>
				<div class="panel-body">
					<div class="form-horizontal">

						<table class="table table-bordered" id="TabelCash">
							<thead>
								<tr class="info">
									<th style="width:30px;">No</th>
									<th style="width:80px; text-align: center;">No PP</th>
									<th style="width:80px;">Tanggal</th>
									<th style="width:50px;">nik</th>
									<th style="width:50;">Admin</th>
									<th style="width:400px;">Deksripsi</th>

									<th style="width: 50px;"></th>


								</tr>
							</thead>
							<tbody>
							<?php 
							

							
							foreach ($datadetil->result() as $row) { 
								$no++;
					

								?>
								
								<tr>
									<td>
										<?php echo $no; ?>
									
									</td>
									
									<td style="text-align: center;"><?php echo $row->No_PP; ?></td>
									<td><?php echo $row->tanggal; ?></td>
									<td style="text-align:right"><?php echo $row->nik; ?></td> 
									<td style="text-align:right"><?php echo $row->admin; ?></td> 
									<td style="text-align:right"><?php echo $row->deskripsi; ?></td> 

									<td style="text-align: right">
										<!-- apus detail  -->
										<!-- <a href="javascript:;" data-id="<?php echo $row->id_pinjam?>" data-toggle="modal"  data-target="#modal-konfirmasi" class="btn btn-info btn-xs" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a> -->
										<a href="<?php echo base_url('Cpermintaan/delete_detil/').$row->No_PP ?>" class="btn btn-danger" onclick="return confirm('Yakin di Hapus ?')"><i class="glyphicon glyphicon-trash"></i> hapus data</a>

										<a style="width: 110px;" href="<?php echo base_url('Cpermintaan/Cetak_form/').$row->No_PP ?>" target="_blank"  class="btn btn-success" ><i class="glyphicon glyphicon-print"></i> Cetak</a>
										
									</td>
								</tr>

								
							
							<?php }?>
							</tbody>
<!-- looping berenti di atas -->
							
					</table>

						<div class='alert alert-info ' style="text-align: right">
							
								<button type='button' class='btn btn-danger' id='batal'><span class="glyphicon glyphicon-remove"></span> Transaksi Batal</button>	

								<button type='button' class='btn btn-success' id='baru'><span class="glyphicon glyphicon-edit"></span> Transaksi Baru</button>
							    
							    <!-- <button type='button' class='btn btn-warning' id='cetak'><span class="glyphicon glyphicon-print"></span> Cetak Form</button>
 -->
							    <!-- <a href="<?php //echo base_url('pinjam/transaksibatal') ?>" class="btn btn-danger">Transaksi Batal</a> -->	
							   <!--  <a href="<?php //echo base_url('pinjam/transaksibaru') ?>" class="btn btn-primary">Transaksi Baru</a> -->
							   <!--  <a href="<?php //echo base_url('pinjam/cetak_transaksi') ?>" class="btn btn-info">Cetak Transaksi</a> -->
							
							
					
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- tutup row bawah -->
	</div>

<!-- container fluid -->
</div>


<!-- tutup div right colom -->
</div>

        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
           Copyright &copy; PT. Amarta Gemilang
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>

<!-- BATES -->


	</form>
</body>

<!-- modal konfirmasi class="modal fade"-->
		<div id="modal-konfirmasi" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				 
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body btn-info">
					Apakah Anda yakin ingin menghapus data ini ?
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" id="hapus-true-data">Hapus</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				</div>
				 
				</div>
			</div>
		</div>

  <!-- FastClick -->
    <script src="<?php echo base_url('assets/vendors/fastclick/lib/fastclick.js')?>"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets/vendors/nprogress/nprogress.js')?>"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url('assets/vendors/Chart.js/dist/Chart.min.js')?>"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url('assets/vendors/gauge.js/dist/gauge.min.js')?>"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets/vendors/iCheck/icheck.min.js')?>"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url('assets/vendors/skycons/skycons.js')?>"></script>
    <!-- Flot -->
    <script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.pie.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.time.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.stack.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/Flot/jquery.flot.resize.js')?>"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/flot-spline/js/jquery.flot.spline.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/flot.curvedlines/curvedLines.js')?>"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url('assets/vendors/DateJS/build/date.js')?>"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('assets/vendors/jqvmap/dist/jquery.vmap.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')?>"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets/vendors/moment/min/moment.min.js')?>"></script>
    <script src="<?php echo base_url('assets/vendors/bootstrap-daterangepicker/daterangepicker.js')?>"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets/build/js/custom.min.js')?>"></script>


</html>
<script >
	// $(document).ready(function(){
// memulai transaksi baru
	$('#baru').click(function(){
//	$('.modal-dialog').removeClass('modal-lg');
//	$('.modal-dialog').add('modal-sm');
		$('#ModalHeader').html('Konfirmasi');
		$('#ModalContent').html("Apakah yakin akan membuat transaksi baru ?");
		$('#ModalFooter').html("<button type='button' id='TransaksiBaru' class='btn btn-primary'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal' autofocus>Batal</button>");
		$('#ModalGue').modal('show');
	});
/*action transaksi baruu*/
	$(document).on('click','#TransaksiBaru',function(){
		$('#ModalGue').modal('hide');
		window.open("<?php echo base_url('Cpermintaan/transaksibaru')?>",'_self');
});
// transaksi apus
$('#batal').click(function(){
//	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').add('modal-sm');
	$('#ModalHeader').html('Konfirmasi');
	$('#ModalContent').html("Apakah yakin akan dibatalkan ?");
	$('#ModalFooter').html("<button type='button' id='TransaksiBatal' class='btn btn-primary'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal' >Batal</button>");
	$('#ModalGue').modal('show');
});

// kode untuk aksi dai transaksi baru
$(document).on('click','#TransaksiBatal',function(){
		$('#ModalGue').modal('hide');
		window.open("<?php echo base_url('Cpermintaan/transaksibatal')?>",'_self');
});

// cetak transaksi
$('#cetak').click(function(){
	
if($('#TotalBayarHidden').val() >0) {
	$('#ModalHeader').html('Konfirmasi');
	$('#ModalContent').html("Apakah yakin data akan dicetak ?");
	$('#ModalFooter').html("<button type='button' id='cetak' class='btn btn-primary'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
	$('#ModalGue').modal('show');
} else {
	$('#ModalHeader').html('Konfirmasi');
	$('#ModalContent').html("Belum ada transaksi");
	$('#ModalFooter').html("<button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
	$('#ModalGue').modal('show');
};
});

			$(document).ready(function(){
			 
				$('#modal-konfirmasi').on('show.bs.modal', function (event) {
				var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
				 
				// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
				var id = div.data('id')
				 
				var modal = $(this)
				// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal .
				modal.find('#hapus-true-data').attr("href","Cpermintaan/delete_detil/"+id);
				})
			 
			});

// kode untuk aksi dai transaksi baru
$(document).on('click','#cetak',function(){
		
		$('#ModalGue').modal('hide');
		window.open("<?php echo base_url('Cpermintaan/Cetak_form');?>");
});

// kode untuk aksi dai transaksi baru
$(document).on('click','#hapus_detil',function(){
		$('#ModalGue').modal('hide');
		window.open("<?php echo base_url('Cpermintaan/transaksibatal')?>",'_self');
});






</script>

<div class="modal" id="ModalGue" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class='glyphicon glyphicon-remove'></i></button>
						<h4 class="modal-title" id="ModalHeader"></h4>
					</div>
					<div class="modal-body btn-danger" id="ModalContent"></div>
					<div class="modal-footer" id="ModalFooter"></div>
				</div>
			</div>
		</div>


<!-- modal konfirmasi class="modal fade"-->
		<div id="modal-konfirmasi" class="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
				 
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>
				<div class="modal-body btn-info">
					Apakah Anda yakin ingin menghapus data ini ?
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" id="hapus-true-data">Hapus</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				</div>
				 
				</div>
			</div>
		</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

 
</script>