<?php
if (isset($this->session->userlogin)==FALSE) {
redirect(); //= memanggil routes nya boleh di isi redirect('signin/login')
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- untuk hape -->
	<meta http-equiv="content-Language" content="en-us">
	<meta charset="utf-8">
<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js') ?>"></script> -->

	
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
	 
           <div class="right_col" role="main">


							<div class ="container-fluid">
								<form class="form-horizontal" name="formbook" enctype="multipart/form-data" action="<?php echo base_url('Pinjam/act_preview_karyawan') ?> " method="POST" >
								
									<div class="col-md-4">
									<!-- panel pertama -->
									<div class="panel panel-primary">
									<div class="panel-heading"><i class="glyphicon glyphicon-cog "></i> laporan</div>
									<div class="panel-body">

										<div class="form-group">
										<label style="margin-top: 5px;" class="col-sm-4 control-label">Dari tanggal</label>
											<div class="col-sm-8">
										<input type="date" name="dari" id="dari" class="form-control" value="<?php echo date('Y-m-d') ?>">
											</div>
										</div>

											<div class="form-group">
										<label style="margin-top: 5px;" class="col-sm-4 control-label">sampai Tanggal</label>
											<div class="col-sm-8">
										<input type="date" name="sampai" id="sampai" class="form-control" value="<?php echo date('Y-m-d') ?>">
											</div>
										</div>

										<div class="form-group">
										<label style="margin-top: 5px;" class="col-sm-4 control-label">Nama karyawan</label>
											<div class="col-sm-8">
												<select  class="form-control input-sm" id="karyawan" name="karyawan">
												<option value="">==SILAHKAN PILIH==</option>
										

											<?php 
											if ($cmbkar->num_rows() > 0) {
												foreach ($cmbkar->result() as $row ) {
												echo "<option value='$row->nik'>
												$row->nama_karyawan
												</option>";

												}
											}
											 ?>
										</select>
											</div>
										</div>

										<div class="col-sm-4"></div>
										<div class="col-sm-4">
												<button type="submit" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-print"></span>Preview</a></button>

											</div>
											<div class="col-sm-4">
												
											</div>
										

											</div>
										</div>
									</div>
								</form>

							<div class="col-sm-7">
								<?php 
							 	if ($this->session->muncul==true) {
							 		# code...
							 	
								 ?>
							</div>


								<div class="col-sm-8">
									<div class="panel panel-primary">
									<div class="panel-heading">
									<h5>Laporan Peminjaman Cash</h5>
									<h6>Periode tanggal : <?php echo $tglawal; ?> sampai <?php echo $tglakhir; ?></h6>
								</div>
									<table class="table table-bordered" id="TabelLaporan">
										<thead>
											<tr class="info">
												<th style="width:35px;">No</th>
												<th style="width:130px;">Id Pinjam</th>
												<th style="width:150px;">Tanggal</th>
												<th >Nama Karyawan</th>
												<th style="width:75px;">Jumlah Pinjam</th>
												<!-- <th style="width:125px;text-align: right;">Total</th> -->
												<th style="width:75px;">Keterangan</th>
												<!-- <th style="width:40px;"></th> -->

											</tr>
										</thead>
										<?php 
									
									?>
										<tbody>
											<?php 
											$no=0;
											$tot=0;
												$qti=0;
											foreach ($laporan as $row) {
												$no++;
												

												$tot=$tot+$row->jumlah_pinjam;
												// $qti=$qti+$row->jumlah_beli;
												?>

												<tr>
													<td><?php echo $no; ?></td>
													<td><?php echo $row->id_pinjam; ?></td>
													<td><?php echo $row->tgl_pinjam; ?></td>
													<td><?php echo $row->nama_karyawan; ?></td>
													<td><?php echo $row->jumlah_pinjam; ?></td>
													<!-- <td><?php echo number_format($row->total,0) ?></td> -->
													<td><?php echo $row->keterangan; ?></td>
												</tr>

												<?php 

											}
											 ?> 
											 <tr>
											 	<td colspan="4" align="right">
											 		Total:
											 	</td>

											<!--  	<td align="right">
											 		<?php echo number_format($qti,0) ?>
											 	</td> -->

											 	<td align="right">
											 		<?php echo number_format($tot,0) ?>
											 	</td>
											 </tr>


										</tbody>
									</table>
								</div>
								<a href="<?php echo base_url('Pinjam/list_peminjaman_user_pdf'); ?>" type="button" class="btn btn-success">Print PDF</a>
								<?php } ?>
								
								
								</div>


</body>


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