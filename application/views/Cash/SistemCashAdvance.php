

<?php
if (isset($this->session->userlogin)==FALSE) {
redirect(); //= memanggil routes nya boleh di isi redirect('signin/login')
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cash Advance</title>
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

					function tombolbatal(evt){
						<?php 

							$button = $this->session->hd;
							
						 ?>
							if($button==1){
							  $('#batal').attr('disabled',true);
							}

							
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
			
	$(document).ready(function(){
		
			$("#karyawan").change(function(){
				
				if ($("#karyawan").val()!=='') {
					
					$.ajax({
					url:"<?php echo base_url('Pinjam/ckaryawan'); ?>",
					type:"POST",
					data:"idk="+$(this).val(),
					dataType:"json",
					success: function(jar){
						
						$("#dep").html(jar.department);
						$("#jbt").html(jar.jabatan);
						$("#gaji").html(jar.gaji);
						$("#gajihidden").val(jar.gaji);
					}

				});
					
				}else{
					// alert($("#karyawan").val());
					$("#dep").html('<i>Tidak Ada </i>');
					$("#jbt").html('<i>Tidak Ada </i>');
					$("#gaji").html('<i>Tidak Ada </i>');
					$("#gajihidden").val(0);

				}
				});

			// $('#karyawan').keyup(function(){
			// 	$( "#karyawan" ).autocomplete("<?php //echo base_url('Pinjam/carinama');?>")
			// 		{
			// 			width:150;
			// 			$.ajax({
			// 						url:"<?php //echo base_url('Pinjam/ckaryawan'); ?>",
			// 						type:"POST",
			// 						data:"idk="+$(this).val(),
			// 						dataType:"json",
			// 						success: function(jar){
			// 							$("#dep").html(jar.department);
			// 							$("#jbt").html(jar.jabatan);
			// 							$("#gaji").html(jar.gaji);
			// 							$("#gajihidden").val(jar.gaji);

			// 						}
			// 					});
			// 		};
			// })	

			$('#uang').change(function(){
				if ($(this).val()> 100000)   {
					alert('tidak boleh');
					$(this).val('');
					$('#uang').focus();
				}
			})
			

			// pengurangan gaji dari session
			$('#uang').keyup(function(){
				gj=$('#gajihidden').val();
				uang=$(this).val();
				
				blndpn=gj-uang;

				if (blndpn < 0) {
						$("#simpan").attr('disabled',true);
					}else if(blndpn > 0){
						$("#simpan").attr('disabled',false);

					}
				$('#bln').val(blndpn);
				$('input#TotalBayarHidden').val($(this).val());
				// alert(uang);
				HitungTotalBayar();
			})

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
			<form class="form-horizontal" name="formbook" enctype="multipart/form-data" action="<?php echo base_url('Pinjam/save') ?>" method="POST" >
	
			<div class="row">

			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel-heading"><i class="glyphicon glyphicon-cog "></i> Informasi Nota Peminjaman Uang</div>
					<div class="panel-body">
							<!-- panel pertama kiri -->
							<div class="col-sm-6">

									<div class="form-group">
									<label style="margin-top: 5px;" class="col-sm-4 control-label">NO. PP </label>
										<div class="col-sm-5">
									<?php print_r($_SESSION); ?> 
									<input type="text" name="pp" id="pp" class="form-control" readonly value="<?php echo $this->session->permintaan; ?>">
									
									</div>
									<div class="col-sm-1">
									<button id="btnPop" type="button" class="btn btn-info btn-xs btn_PP">..</button>
										</div>
									</div>

									<div class="form-group">
									<label style="margin-top: 5px;" class="col-sm-4 control-label">ID Pinjam</label>
										<div class="col-sm-6">
									<!-- <?php //print_r($_SESSION); ?> -->
									<input type="text" name="pinjam" id="pinjam" class="form-control" value="<?php echo $this->session->notrans; ?>" readonly>
										</div>
									</div>

			

			
									<div class="form-group">
									<label for="karyawan" class="col-sm-4 control-label">Karyawan</label>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="karyawan" id="karyawan" value="<?php echo $this->session->id_karyawan; ?>" readonly>

								
									</select> 
										</div>
									</div>

									<div class="form-group">
										<label for="alamat" class="col-sm-4 control-label">Department</label>
									<div  class="col-sm-5">
										
									<input type="text" id="dep" name="dep" class="form-control" style="text-align: left;" readonly value="<?php echo $this->session->department; ?>">
									
									
										</div>
									</div>
										<div class="form-group">
												<label for="alamat" class="col-sm-4 control-label">Jabatan</label>
											<div  class="col-sm-5">
												<input type="text" name="jbt" id="jbt" class="form-control" style="text-align: left;" readonly value="<?php echo $this->session->position; ?>">
												
											
											</div>
										</div>
										<div class="form-group">
												<label for="alamat" class="col-sm-4 control-label">Gaji</label>
											<div  class="col-sm-5">
												<input type="text" name="gajihidden" id="gajihidden" class="form-control" value="<?php echo $this->session->gaji; ?>" readonly>
												
											<!-- div id="gaji" name="gaji" class="control-label" style="text-align: left;"><?php// echo $this->session->gaji; ?>
												<input type="text" name="gajihidden" id="gajihidden">
											</div> -->
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
												
											<input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo $this->session->tgl_pinjam; ?>" readonly>
												</div>
											</div>

											<div class="form-group">
											<label style="margin-top: 5px;" class="col-sm-4 control-label">Admin</label>
												<div class="col-sm-8">
											<input type="text" name="admin" id="admin" class="form-control" value="<?php echo $this->session->userlogin['nama']; ?>" readonly>
												</div>
											</div>
											<div class="form-group">
											<label style="margin-top: 5px;" class="col-sm-4 control-label">Nominal Uang</label>
												<div class="col-sm-8">
											<input type="text" name="uang" id="uang" class="form-control" onkeypress="return hanyaAngka(event)">
												</div>
											</div>

											<div class="form-group">
											<label style="margin-top: 5px;" class="col-sm-4 control-label">Keterangan</label>
												<div class="col-sm-8">
											<textarea name="kete" id="kete" class="form-control"></textarea>
												</div>
											</div>

											<div class="form-group">
											<label style="margin-top: 5px;" class="col-sm-4 control-label">Gaji Anda bln Depan</label>
												<div class="col-sm-8">
											<input type="text" name="bln" id="bln" class="form-control"  readonly >
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
			<div class="panel-heading"><i class="glyphicon glyphicon-cog "></i> Informasi Peminjaman Uang</div>
				<div class="panel-body">
					<div class="form-horizontal">

						<table class="table table-bordered" id="TabelCash">
							<thead>
								<tr class="info">
									<th style="width:30px;">No</th>
									<th style="width:180px; text-align: center;">Jumlah Pinjam</th>
									<th style="width:100px;">Keterangan</th>
									<th style="width:50px;">Total</th>
									<th style="width:20px;"></th>


								</tr>
							</thead>
							<?php 
							

							
							foreach ($datadetil->result() as $row) { 
								$no++;
								$total += $row->jumlah_pinjam;

								?>
								<tbody>
								<tr>
									<td>
										<?php echo $no; ?>
										<input type="hidden" name="id">
									</td>
									
									<td style="text-align: center;"><?php echo $row->jumlah_pinjam; ?></td>
									<td><?php echo $row->keterangan; ?></td>
									<td style="text-align:right">
									<input type='hidden' name="totalhiden" value="<?php echo $row->jumlah_pinjam;?>">	
									<span><?php echo number_format($row->jumlah_pinjam,0);?></span>
									</td> 

									<td>
										<!-- apus detail  -->
										<!-- <a href="javascript:;" data-id="<?php echo $row->id_pinjam?>" data-toggle="modal"  data-target="#modal-konfirmasi" class="btn btn-info btn-xs" title="Hapus"><i class="glyphicon glyphicon-trash"></i></a> -->
										<a href="<?php echo base_url('pinjam/delete_detil/').$row->id_pinjam.'/'.$row->index ?>" class="btn btn-danger" onclick="return confirm('apus ga?')"><i class="glyphicon glyphicon-trash"></i>hapus data</a>
									</td>
								</tr>

								
							</tbody>
							<?php }?>
							
<!-- looping berenti di atas -->
							
					</table>
						<div class='alert alert-info' style="text-align: right">
							<div class=" pull-left">	
								<button type='button' class='btn btn-danger' id='batal'><span class="glyphicon glyphicon-remove" onclick="tombolbatal(evt)"></span> Transaksi Batal</button>	

								<button type='button' class='btn btn-success' id='baru'><span class="glyphicon glyphicon-edit"></span> Transaksi Baru</button>
							    
							    <button type='button' class='btn btn-warning' id='cetak'><span class="glyphicon glyphicon-print"></span> Cetak Transaksi</button>

							    <!-- <a href="<?php //echo base_url('pinjam/transaksibatal') ?>" class="btn btn-danger">Transaksi Batal</a> -->	
							   <!--  <a href="<?php //echo base_url('pinjam/transaksibaru') ?>" class="btn btn-primary">Transaksi Baru</a> -->
							   <!--  <a href="<?php //echo base_url('pinjam/cetak_transaksi') ?>" class="btn btn-info">Cetak Transaksi</a> -->
							</div>	
							<h2 style="margin-top: 0px;margin-bottom: 0px">Total : <span id='TotalBayar'>Rp. <?php echo number_format($total,0);?></span></h2>
							<input type="text" id='TotalBayarHidden' name="totalbayar" value="<?php echo $total;?>" >
					
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
	
	<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data PP</h4>
      </div>
      <div class="modal-body">
        <div style="overflow: auto;">
								
								<table class="table" id="tb_PP">
									<thead>
										<th>No.</th>
										<th>No PP</th>
										<th>tanggal</th>
										<th>Nik</th>
										<th>Id Department</th>
										<th>Nama Department</th>
										<th>position</th>
										<th>gaji</th>
										<th>Gaji bln Depan</th>

									</thead>
									<tbody>
									<?php 
							// $n=0;
							$n=0;
							foreach ($datapp->result() as $row) {
								$n++;
								?>
									<tr>
									
									<td><?php echo $n; ?></td>
									<td><span><?php echo $row->No_PP; ?></span></td>
									<td><span><?php echo $row->tanggal; ?></span></td>
									<td><span><?php echo $row->nik; ?></span></td>
									<td><span><?php echo $row->id_department; ?></span></td>
									<td><span><?php echo $row->nmDepart; ?></span></td>
									<td><span><?php echo $row->position; ?></span></td>
									<td><span><?php echo $row->gaji; ?></span></td>
									<td><span><?php echo $row->gaji_blndpn; ?></span></td>


									<td>
										<button  class="btn btn-danger btn_pilih"><i class=""></i>SELECT</buttton>
									</td>
									</tr>
									
									
									<?php } ?>


									</tbody>
								</table>
							</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
		window.open("<?php echo base_url('Pinjam/transaksibaru')?>",'_self');
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
		window.open("<?php echo base_url('Pinjam/transaksibatal')?>",'_self');
});

// cetak transaksi
$('#cetak').click(function(){
	
if($('#TotalBayarHidden').val() >0) {
	$('#ModalHeader').html('Konfirmasi');
	$('#ModalContent').html("Apakah yakin data akan dicetak ?");
	$('#ModalFooter').html("<button type='button' id='CetakTransaksi' class='btn btn-primary'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
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
				modal.find('#hapus-true-data').attr("href","Pinjam/delete_detil/"+id);
				})
			 
			});

// kode untuk aksi dai transaksi baru
$(document).on('click','#CetakTransaksi',function(){
		$('#ModalGue').modal('hide');
		window.open("<?php echo base_url('Pinjam/cetak_transaksi')?>",'_blank');
});

// kode untuk aksi dai transaksi baru
$(document).on('click','#hapus_detil',function(){
		$('#ModalGue').modal('hide');
		window.open("<?php echo base_url('Penjualan/transaksibatal')?>",'_self');
});

$("#btnPop").click(function(){
	$("#myModal").find(".modal-dialog").css({width:'800'});
	$('#myModal').modal('show');
})

$(".btn_pilih").click(function(){
	//alert('aa');
	index=$(this).parent().parent().index();
	NoPP=$("#tb_PP tbody tr:eq("+index+") td:nth-child(2) span").text();
	tgl=$("#tb_PP tbody tr:eq("+index+") td:nth-child(3) span").text();
	idkar=$("#tb_PP tbody tr:eq("+index+") td:nth-child(4) span").text();
	kddept=$("#tb_PP tbody tr:eq("+index+") td:nth-child(5) span").text();
	jabat=$("#tb_PP tbody tr:eq("+index+") td:nth-child(7) span").text();
	
	if ( $("#tb_PP tbody tr:eq("+index+") td:nth-child(9) span").text() == 0 ){
		gaji=$("#tb_PP tbody tr:eq("+index+") td:nth-child(8) span").text();
	}else{
		gaji=$("#tb_PP tbody tr:eq("+index+") td:nth-child(9) span").text();
	}
	



	$("#pp").val(NoPP);
	$("#karyawan").val(idkar);
	$("#dep").val(kddept);
	$("#jbt").val(jabat);
	$("#tanggal").val(tgl);
	$("#gajihidden").val(gaji);


	$("#myModal").modal("hide");
})





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