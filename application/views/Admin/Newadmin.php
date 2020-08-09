<?php
if (isset($this->session->userlogin)==FALSE) {
redirect(); //= memanggil routes nya boleh di isi redirect('signin/login')
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- untuk hape -->
	<meta http-equiv="content-Language" content="en-us">
	<meta charset="utf-8">
	<link rel="icon" href="<?php echo base_url('image/era.jpg') ?>" type="image/ico" />
	
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
	<!-- jQuery -->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>

	<link href='<?php echo base_url('cash.png') ?>' rel='shortcut icon'>

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

<body class="nav-md">
		<div class="container body">
			<div class="main_container">
					<?php $this->load->view('sampingatasmenu.php'); ?>
			          <?php $this->load->view('topnav'); ?>
				 

			        <!-- page content -->
			      
			     <!-- <div class="col-sm-12" role="main"> -->


					<div class="container" style="width: 60% ; ">									
						<div class="col-sm-12">
									<!-- untuk isi -->
								<div class="panel panel-info">
											<div class="panel-heading">Formulir Input Karyawan Baru</div>

									<div class="panel-body">
												<?php if (isset($pesan)) {?>
													<div class="alert alert-danger" role="alert">
														<button type="button" class="close" data-dismiss="alert"> X </button>
														<h4>Peringatan</h4>
														<?php echo $pesan; ?>
													</div>
												<?php } ?>
												<!-- awal pembuatan form -->
										<form class="form-horizontal" action="<?php echo base_url('Cashadvance/save_admin') ?>" method="POST" name="formbook" enctype="multipart/form-data">

										<div class="form-group">
											<label class="col-sm-2 control-label">Id Admin Login</label>
											<div class="col-sm-2">
											<input type="text" name="id" id="id">
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama karyawan</label>
											<div class="col-sm-2">
											<input type="text" name="nama" id="nama" placeholder="isi nama Karyawan... " required>
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Username</label>
											<div class="col-sm-2">
											<input type="text" name="user" id="user">
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">password</label>
											<div class="col-sm-2">
											<input type="text" name="pass" id="pass">
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">jabatan </label>
											<div class="col-sm-2">
											<input type="text" name="jbt" id="jbt">
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">id department</label>
											<div class="col-sm-2">
											<select  class="form-control " id="depart" name="depart">
															<option value="">Pilih</option> 
															<?php 
															if ($datakombo->num_rows() > 0) {
															foreach ($datakombo->result() as $row ) {
																echo "<option value='$row->idDepartment'>
																$row->nmDepart
																</option>";

																}
															}
																?>
										</select>
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Hak Akses</label>
											<div class="col-sm-2">
											<input type="text" name="akses" id="akses">
										</div></div>

													<div class="form-group">
															<label class="col-sm-2 control-label"></label>
															<div class="col-sm-6">
															<button type="submit" class="btn btn-primary" name="proses" value="proses"><span class="glyphicon glyphicon-save"></span>Simpan</button>
															</div>
													</div>
													

												</div>
													
											<!-- </div> tutup colom input -->
										
										
												
										</form>

									</div>
								</div>
						</div>

							
					</div>
			</div>

					<!-- tutup page content -->
					        <!-- footer content -->
			        <footer>
			          <div class="pull-right">
			           Copyright &copy; PT. Amarta Gemilang
			          </div>
			          <div class="clearfix"></div>
			        </footer>
			        <!-- /footer content -->
			      
		</div>
			  

</body>


  	<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-confirm.min.js') ?>"></script>

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
<script type="text/javascript">
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
</script>

<!-- <?php if (isset($pesan)) {?>
<?php if($pesan !== ""){ ?>
	<label id="pesan"><?php echo $pesan; ?></label>
	<script type="text/javascript">
		$(document).ready(function(){
			var pesan = $("label#pesan").text();
			$.alert({
			    title: 'Duplicate!',
			    content: pesan,
			});
		});
	</script>

<?php } } ?> -->