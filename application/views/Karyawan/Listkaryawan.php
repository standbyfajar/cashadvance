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
<!-- <script src="<?php //echo base_url('bootstrap/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?php// echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
 -->
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js')?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('assets/DataTables/datatables.min.js') ?>"></script>

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
						<div class="container" style="margin-top: 10pt">
					<!-- index -->
					<div class="col-sm-12">
					<!-- untuk isi -->
					<div class="panel panel-info">
						<div class="panel-heading">Daftar Karyawan</div>
					<div class="panel-body">
					<table class="table" id="tbl_one">
					<thead>
						<tr>
						<th>No</th>
						<th>Id Karyawan</th>
						<th>Nama Karyawan</th>
						<th>Jabatan</th>
						<th>Status</th>
						<th>Aksi &nbsp;<a  class="btn btn-primary btn-xs btn_new" href="<?php echo base_url('CKaryawan/tambahkaryawan'); ?>"  role="button" title="New">
							<span class="glyphicon glyphicon-plus"></span> New</a>
							<button  type="button" class="btn btn-info btn-xs btn_details" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-th-large"></span>Details</button></th>
					</tr>
					</thead>
				<tbody>

				<?php 
				// $n=0;
				$n=0;
				foreach ($datakr as $row) {
					$n++;
					?>
					<tr>
						<td><?php echo $n; ?></td>
						<td><?php echo $row->nik; ?></td>
						<td><?php echo $row->nama_karyawan; ?></td>
						<!-- <td><?php echo $row->email; ?></td>
					 -->	
						<td><?php echo $row->position; ?></td>
						<td><?php echo $row->status; ?></td>
						<!-- <td><?php //echo $row->jenis_kelamin; ?></td>
						<td><?php //echo $row->nomor_telpon; ?></td>
						<td><?php //echo $row->gaji; ?></td>
				 -->
						
						<td><a class="btn btn-primary btn-xs" role="button" title="Edit" href="<?php echo base_url('CKaryawan/editkaryawan/').$row->nik; ?>">
							<span class="glyphicon glyphicon-edit">Edit</span> </a>
							<a class="btn btn-danger btn-xs" href="<?php echo base_url('CKaryawan/deletkaryawan/').$row->nik; ?>" role="button" title="Delete"  title="delete karyawan" onclick="return confirm('benar akan dihapus?');" >
							<span class="glyphicon glyphicon-remove"></span> Delete</a>
							<button data-id="<?php echo $row->nik; ?>" type="button" class="btn btn-info btn-xs btn_detil" ><span class="glyphicon glyphicon-th-large"></span>info</button></td>
					</tr><?php
				}
				 ?>
				 </tbody>
				 </table>
				<!-- <?php //echo $this->pagination->create_links(); ?> -->
				</div></div>
				<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog" >
						<div class="modal-dialog modal-lg">
							<!-- konten modal-->
							<div class="modal-content">
								<!-- heading modal -->
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Data Karyawan</h4>
								</div>
								<!-- body modal -->
							<div class="panel panel-info">
								
								<div class="modal-body" style="overflow: auto;">

							<div>
								<div style="overflow: auto;">
									
									<table class="table">
										<thead>
											<th>No</th>
											<th>Id Karyawan</th>
											<th>Nama Karyawan</th>
											<th>Email</th>
											<th>Jabatan</th>
											 <th>Id Department</th>
											<th>Jenis Kelamin</th>
											<th>Telepon</th>
											<th>Gaji</th>

										</thead>
										<?php 
								// $n=0;
								$n=0;
								foreach ($datakr as $row) {
									$n++;
									?>

										<tbody>
										<td><?php echo $n; ?></td>
										<td><?php echo $row->nik; ?></td>
										<td><?php echo $row->nama_karyawan; ?></td>
										<td><?php echo $row->alamat; ?></td>
									
										<td><?php echo $row->tmptlahir; ?></td>
										<td><?php echo $row->position; ?></td>
										<td><?php echo $row->status; ?></td>
										<td><?php echo $row->nomor_telpon; ?></td>
										<td><?php echo $row->gaji; ?></td>
										</tbody><?php } ?>
									</table>
								</div>
								
							</div>

							</div>
						</div>

								<!-- footer modal -->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
								</div>
							</div>
						</div>
					</div>
				<!-- modal info -->
					<div id="infoModal" class="modal fade" role="dialog" >
						<div class="modal-dialog modal-lg">
							<!-- konten modal-->
							<div class="modal-content">
								<!-- heading modal -->
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Data Karyawan</h4>
								</div>
								<!-- body modal -->
							<div class="panel panel-info">
								
								<div class="modal-body" style="overflow: auto;">

						<div class="col-sm-6">
							<form class="form-horizontal" action="<?php echo base_url('') ?>" method="POST" name="formbook" enctype="multipart/form-data">

							<div class="form-group">
								<label class="col-sm-2 control-label">Id Karyawan</label>
								<div class="col-sm-2">
								<input type="text" id="id" value="" readonly>
								
							</div></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Karyawan</label>
								<div class="col-sm-2">
								<input type="text" id="nama" readonly>
							</div></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Alamat</label>
								<div class="col-sm-2">
								<input type="text" id="eml" readonly>
							</div></div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Id Department</label>
								<div class="col-sm-2">
								<input type="text" id="dept" readonly>
								
							</div></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Jabatan</label>
								<div class="col-sm-2">
								<input type="text" id="jbt" readonly>
							</div></div>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Jenis Kelamin</label>
								<div class="col-sm-2">
								<input type="text" id="jk" readonly>
								
							</div></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Telepon</label>
								<div class="col-sm-2">
								<input type="text" id="tel" readonly>
								
							</div></div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Gaji</label>
								<div class="col-sm-2">
								<input type="text" id="gaji" readonly="">
								
							</div></div>
							
							
						</form>
						</div>


						<div class="col-sm-6">
							<img src="" id="foto" class="img-responsive">
						</div>
							</div>
						</div>

								<!-- footer modal -->
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
								</div>
							</div>
						</div>
					</div>
					<!-- tutup modal karyawan by id-->
			<!-- tuttup col-sm -->
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


<script type="text/javascript">
	
	$(document).ready(function(){

		$('#tbl_one').DataTable();

		$(document).on('click','.btn_detil',function(){
			nik=$(this).attr("data-id");
				// alert(id_karyawan);
				$.ajax({
						url:"<?php echo base_url('CKaryawan/get_karyawan/') ?>"+nik,
						method:"POST",
						dataType:"json",
						success:function(data){
							$('#id').val(data.nik);
							$('#nama').val(data.nama_karyawan);
							$('#eml').val(data.alamat);
							$('#dept').val(data.id_department);
							$('#jbt').val(data.position);
							$('#jk').val(data.jenis_kelamin);
							$('#tel').val(data.nomor_telpon);
							$('#gaji').val(data.gaji);
							$('#foto').attr('src','<?=base_url()?>/image/'+data.Foto);

							$('#infoModal').modal("show");
						},
						error:function(xhr){
							console.log(xhr);
						}
					});
		})

		

	});
</script>


  
</html>

