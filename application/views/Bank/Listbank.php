    <!-- Custom Theme Scripts -->

<?php
if (isset($this->session->userlogin)==FALSE) {
redirect(); //= memanggil routes nya boleh di isi redirect('signin/login')
}
?>
<!DOCTYPE html>
<html>
<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- untuk hape -->
	<meta http-equiv="content-Language" content="en-us">
	<meta charset="utf-8">
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
				<div class="col-md-12">
				<!-- untuk isi -->
				<div class="panel panel-info">
					<div class="panel-heading">Daftar Bank</div>
				<div class="panel-body">
			<table class="table " id="tbl_dep">
				<thead>
					<tr>
					<th>No</th>
					<th>Id Bank</th>
					<th>Nama Bank</th>
					
					<th>Aksi &nbsp;<a class="btn btn-primary btn-xs btn_new" data-toggle="modal" data-target="#myModal1" role="button" title="New">
						<span class="glyphicon glyphicon-plus"></span> New</a>
						<button  type="button" class="btn btn-info btn-xs btn_details" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-th-large"></span>Details</button></th>
					</tr>
				</thead>
			<tbody>
			<?php 
			// $n=0;
			$n=0;
			foreach ($datadp as $row) {
				$n++;
				?>

					
					<tr>
					<td><?php echo $n; ?></td>
					<td><?php echo $row->idBank; ?></td>
					<td><?php echo $row->nm_Bank; ?></td>
					

					<td><a class="btn btn-primary btn-xs" role="button" title="Edit"  data-toggle="modal" data-target="#myModalEdit" onclick="edit('<?php echo $row->idBank;?>')">
						<span class="glyphicon glyphicon-edit"></span>Edit </a>
						<a class="btn btn-danger btn-xs" href="<?php echo base_url('CBank/delete_bank/').$row->idBank; ?>" role="button" title="Delete"  title="delete department" onclick="return confirm('benar akan dihapus?');" >
						<span class="glyphicon glyphicon-remove"></span> Delete</a>
						<button data-id="<?php echo $row->idBank; ?>" type="button" class="btn btn-info btn-xs btn_detil"><span class="glyphicon glyphicon-th-large"></span>info</button></td>
					</tr>
				<?php
			}
			 ?>
			 </tbody>
			 </table>
			<!-- <?php //echo $this->pagination->create_links(); ?> -->
			</div>

				<!-- Modal -->
				<div id="myModalEdit" class="modal fade" role="dialog" >
					<div class="modal-dialog modal-lg">
						<!-- konten modal-->
						<div class="modal-content">
							<!-- heading modal -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit Data Bank</h4>
							</div>
							<!-- body modal -->
							<div class="container" style="width: 60% ; ">

								<div class="col-sm-11">
								<!-- untuk isi -->
								<div class="panel panel-info">
									<div class="panel-heading">Formulir Update Bank</div>

								<div class="panel-body">
									<?php if (isset($pesan)) {?>
										<div class="alert alert-danger" role="alert">
											<button type="button" class="close" data-dismiss="alert"> X </button>
											<h4>Peringatan</h4>
											<?php echo $pesan; ?>
										</div>
									<?php } ?>
									<!-- awal pembuatan form -->
									<form class="form-horizontal" action="<?php echo base_url('CBank/updet_bank') ?>" method="POST" name="formbook" enctype="multipart/form-data" id="formedit">


										<div class="form-group">
											<label class="col-sm-2 control-label">Id Bank</label>
											<div class="col-sm-2">
											<input type="text" name="id" id="id2" value="" readonly>
											
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Bank</label>
											<div class="col-sm-2">
											
											<input type="text" name="nama" id="nama2" value="" required>
										</div></div>
										

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

							<!-- footer modal -->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
							</div>
						</div>
					</div>
				</div>



			<!-- Modal -->
				<div id="myModal1" class="modal fade" role="dialog" >
					<div class="modal-dialog modal-lg">
						<!-- konten modal-->
						<div class="modal-content">
							<!-- heading modal -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Input Data Bank</h4>
							</div>
							<!-- body modal -->
						<div class="panel panel-info">
							<div class="modal-body" style="overflow: auto;">
						<div>
							<div style="overflow: auto;">
							<!-- isi -->
							<div class="container" style="width: 60% ; ">
								<div class="col-sm-11">
								<!-- untuk isi -->
								<div class="panel panel-info">
									<div class="panel-heading">Formulir Input Bank Baru</div>

								<div class="panel-body">
									<!-- awal pembuatan form -->
									<form class="form-horizontal" action="<?php echo base_url('CBank/savebank') ?>" method="POST" name="formbook" enctype="multipart/form-data">


										<div class="form-group">
											<label class="col-sm-2 control-label">Id Bank</label>
											<div class="col-sm-2">
											<input type="text" name="id" >
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Bank</label>
											<div class="col-sm-2">
											<input type="text" name="nama" placeholder="isi nama Bank " required>
										</div></div>
										

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

				


			<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog" >
					<div class="modal-dialog modal-lg">
						<!-- konten modal-->
						<div class="modal-content">
							<!-- heading modal -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Data Bank</h4>
							</div>
							<!-- body modal -->
						<div class="panel panel-info">
						
							<div class="modal-body" style="overflow: auto;">

						<div>
							<div style="overflow: auto;">
								
								<table class="table">
									<thead>
										<th>No</th>
										<th>Id Bank</th>
										<th>Nama Bank</th>
										

									</thead>
									<?php 
							// $n=0;
							$n=0;
							foreach ($datadp as $row) {
								$n++;
								?>

									<tbody>
									<td><?php echo $n; ?></td>
									<td><?php echo $row->idBank; ?></td>
									<td><?php echo $row->nm_Bank; ?></td>
									
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
								<h4 class="modal-title">Data Department</h4>
							</div>
							<!-- body modal -->
						<div class="panel panel-info">
						
							<div class="modal-body" style="overflow: auto;">

					<form class="form-horizontal" action="" method="POST" name="formbook" enctype="multipart/form-data">

						<div class="form-group">
							<label class="col-sm-2 control-label">Id Department</label>
							<div class="col-sm-2">
							<input type="text" id="id" value="" readonly>
							
						</div></div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Nama Department</label>
							<div class="col-sm-2">
							<input type="text" id="nama" readonly>
						</div></div>
						
						
						
					</form>

						</div>
					</div>

							<!-- footer modal -->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
							</div>
						</div>
					</div>
				</div>
			

								
<!-- tutup colom kanan -->
			</div>
		</div>
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
  	<!-- sweet alert -->
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
    <!-- swal online -->
	<script src="<?php echo base_url('assets/build/js/sweet.js')?>"></script>
	<script src="<?php echo base_url('assets/build/js/sweetalert.min.js')?>"></script>
	<script src="<?php echo base_url('assets/build/js/sweetalert-dev.js')?>"></script>



	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

<?php if (isset($pesan)) {?>
<?php if($pesan !== ""){ ?>
	<!-- <label id="pesan"><?php echo $pesan; ?></label> -->
	<script type="text/javascript">
		$(document).ready(function(){
			
			swal("Notification", "Duplicate!", "error", {
				button: "OK!",
			});
		});
	</script>

<?php } } ?>



<script type="text/javascript">
	

	$('#myModalEdit').submit(function(){
		if (confirm("yakin data ingin di simpan?")) {

			nama=$('#nama2').val();
			id=$('#id2').val();

			$.ajax({
				type:'POST',
				url : "<?php echo base_url('CBank/updet_bank/'); ?>",
				data : {nama: nama, id:id},
				dataType: "json",
				success: function(data){
					swal({
					  title: "Notification",
					  text: "Berhasil Updated",
					  icon: "success",
					  button:'OK'
					 
					}).then(function(){

						window.location.href="<?php echo base_url('CBank/index/') ?>";
					})
						
					
				},
				error:function(data){
					swal({
					  title: "Notification",
					  text: "Failed Updated",
					  icon: "error",
					  button:'OK'
					 
					});
				}
			});
			return false
		}
		return false
	});




	function edit(id){
		// alert('a');
		$.ajax({
			type : "GET",
			url : "<?php echo base_url('CBank/editbank/') ?>"+id,
			dataType : "JSON",
			success:function(data){
				
				$('#id2').val(data.id);
				$('#nama2').val(data.nama);
			},
			error: function(err){

			}	
		})
	}

	// var table;
	$(document).ready(function(){ 
		
		var table = $("table#tbl_dep").DataTable();
		

		$(document).on('click','.btn_detil',function(){
			idBank= $(this).attr("data-id");
			// alert('a');
				$.ajax({
						url:"<?php echo base_url('CBank/get_bank/') ?>"+idBank,
						method:"POST",
						dataType:"json",
						success:function(data){
							$('#id').val(data.idBank);
							$('#nama').val(data.nm_Bank);
							

							$('#infoModal').modal("show");
						},
						error:function(xhr){
							// console.log(xhr);
						}
					});
		
		})

	})
</script>

  
</html>

