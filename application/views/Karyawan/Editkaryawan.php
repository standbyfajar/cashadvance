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
	<!-- <script src="<?php ///echo base_url('bootstrap/js/jquery-3.1.1.min.js') ?>"></script>
	<script src="<?php //echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
 -->
 	 <!-- jQuery -->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>

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
       	
        <!-- ,menu atas -->
		<?php $this->load->view('topnav'); ?>



        <!-- page content -->
        <div class="right_col" role="main">

			<div class="container" style=" margin-top: 10pt ">

				<div class="col-sm-9">
				<!-- untuk isi -->
				<div class="panel panel-info">
					<div class="panel-heading">Edit data Karyawan</div>
				<div class="panel-body">
					<!-- awal pembuatan form -->
					<form class="form-horizontal" action="<?php echo base_url('CKaryawan/updatekaryawan') ?>" method="POST" name="formbook" enctype="multipart/form-data">

					<div class="col-sm-6">

							<div class="form-group">
							<label class="col-sm-2 control-label">Id Karyawan</label>
							<div class="col-sm-2">
							<input type="text" name="id" value="<?php echo $datakar->nik; ?>" readonly>
							<input type="hidden" name="idold" value="<?php echo $datakar->nik; ?>" >
							
						</div></div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Karyawan</label>
							<div class="col-sm-2">
							<input type="text" name="nama" onkeypress="" value="<?php echo $datakar->nama_karyawan; ?>">
						</div></div>
						<div class="form-group">
							<label class="col-sm-2 control-label">alamat</label>
							<div class="col-sm-2">
							<input type="text" name="eml" value="<?php echo $datakar->alamat; ?>">
						</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tempat lahir</label>
							<div class="col-sm-2">
							<input type="text" name="tmptlhr" value="<?php echo $datakar->tmptlahir; ?>">
						</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Tanggal lahir</label>
							<div class="col-sm-2">
							<input type="date" name="tgllahir" value="<?php echo $datakar->tgllahir; ?>">
						</div></div>
						
						<div class="form-group">
							<label class="col-sm-2 control-label">Department</label>
							<div class="col-sm-5">
							<select name="depart">
								<?php 
								foreach ($datakombo as $row ) {
										if ($row->id_department == $datakar->id_department ) {
											$pilih="selected";
										}else{
											$pilih="";
										}
								?>
									<option value="<?php echo $row->id_department ?>" <?php echo $pilih; ?> ><?php echo $row->nmDepart; ?></option>
								<?php } ?>
							</select>
						</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Posisi</label>
							<div class="col-sm-2">
							<input type="text" name="jbt" onkeypress="" value="<?php echo $datakar->position; ?>">
						</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Id Shift</label>
							<div class="col-sm-5">
							<select name="shf">
								<?php 
								foreach ($data2 as $row ) {
										if ($row->idShift == $datakar->idShift ) {
											$pilih="selected";
										}else{
											$pilih="";
										}
								?>
									<option value="<?php echo $row->idShift ?>" <?php echo $pilih; ?> ><?php echo $row->ShiftName; ?></option>
								<?php } ?>

							</select>
						</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Jenis Kelamin</label>
							<div class="col-sm-5">
								 
							<?php 
							$checked_l = false;
							$checked_p = false;
							if ($datakar->jenis_kelamin == 'Laki-Laki') {
								$checked_l = true;
							}else{
								$checked_p = true;
							} 
							?>
							
						 	<input type="radio" name="jk" value="Laki-Laki" <?php if($checked_l == true){ echo "checked='true' "; } ?> /> Laki-Laki <br>
						 	
							<input type="radio" name="jk" value="Perempuan" <?php if($checked_p == true){ echo "checked='true' "; } ?> /> Perempuan
								


						</div></div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Telepon</label>
							<div class="col-sm-2">
							<input type="text" name="tel" onkeypress="return hanyaAngka(event)" value="<?php echo $datakar->nomor_telpon; ?>">
						</div></div>

					</div>
						
					<div class="col-sm-6">
						
						<div class="form-group">
						<label class="col-sm-2 control-label">Nama Bank</label>
						<div class="col-sm-1">
						<input type="text" name="nmBank" onkeypress ="return hanyaChar(event)" value="<?php echo $datakar->nm_bank; ?>">
					</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Account No.Bank</label>
							<div class="col-sm-1">
							<input type="text" name="accNo" onkeypress ="return hanyaAngka(event)" value="<?php echo $datakar->accNo_bank; ?>">
						</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Status</label>
							<div class="col-sm-4">
							<!-- <input type="text" name="status" onkeypress =""> -->
							
							<?php 
								$checked_Single = false;
								$checked_Married = false;

								if (strtolower($datakar->status) == 'single') {
									$checked_Single = true;
								}else{
									$checked_Married = true;
								} 
							?>
							<select name="status">
								<option <?php if($checked_Single == true){ echo "selected"; } ?> value="Single" />Single</option>
								<option <?php if($checked_Married == true){ echo "selected"; } ?> value="Married" />Married</option> 

							</select>
						</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Anak</label>
							<div class="col-sm-4">
							<!-- <input type="text" name="anak" onkeypress =""> -->

							<select name="anak">
								<?php 
								$checked_anak = false;
								$checked_Married = false;

								if (strtolower($datakar->anak) == '1') {
									$checked_anak = true;
								}else if(strtolower($datakar->anak) == '2'){
									$checked_anak = true;
								} else {
									$checked_anak = true;
								}
							?>
								<option <?php if ($checked_anak == true) {
									echo "selected";
								} ?> value="1">1</option>
								<option <?php if ($checked_anak == true) {
									echo "selected";
								} ?> value="2">2</option>
								<option <?php if ($checked_anak == true) {
									echo "selected";
								} ?> value="3">3</option>

							</select>
						</div></div>

						<div class="form-group">
							<label class="col-sm-2 control-label">NPWP</label>
							<div class="col-sm-2">
							<input type="text" name="npwp" onkeypress ="return hanyaAngka(event)" value="<?php echo $datakar->npwp; ?>">
						</div></div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Gaji</label>
						<div class="col-sm-2">
						<input type="text" name="gaji" onkeypress="return hanyaAngka(event)" value="<?php echo $datakar->gaji; ?>" >
					</div></div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Foto</label>
						<div class="col-sm-2">
						<input type="hidden" name="ftlama" value="<?php echo $datakar->Foto; ?>">
						<input type="File" name="ft" >

						</div></div>

					</div>
						
						
						<div class="form-group">
						<label class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
							<button type="submit" class="btn btn-primary" name="proses" value="proses"><span class="glyphicon glyphicon-save"></span>Simpan</button>
						</div></div>
						</form>

	 				</div>
	 			</div>
	 		</div>
	 	</div>
	        <!-- /page content -->
	  </div>
	<!-- tutup colom kanan -->
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


</body>
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