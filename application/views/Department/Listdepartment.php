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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/build/js/sweetalert.css') ?>">
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
					<div class="panel-heading">Daftar Department</div>
				<div class="panel-body">
			<table class="table " id="tbl_dep">
				<thead>
					<tr>
					<th>No</th>
					<th>Id Department</th>
					<th>Nama Department</th>
					
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
					<td><?php echo $row->id_department; ?></td>
					<td><?php echo $row->nmDepart; ?></td>
					

					<td><a class="btn btn-primary btn-xs" role="button" title="Edit"  data-toggle="modal" data-target="#myModalEdit" onclick="edit('<?php echo $row->id_department;?>')">
						<span class="glyphicon glyphicon-edit"></span>Edit </a>
						<a class="btn btn-danger btn-xs" onclick="deletedata('<?php echo $row->id_department; ?>')" data-toggle="tooltip" role="button" title="Delete"  title="delete department">
						<span class="glyphicon glyphicon-remove"></span> Delete</a>
						<button data-id="<?php echo $row->id_department; ?>" type="button" class="btn btn-info btn-xs btn_detil"><span class="glyphicon glyphicon-th-large"></span>info</button></td>
					</tr>
				<?php
			}
			 ?>
			 </tbody>
			 </table>
			<!-- <?php //echo $this->pagination->create_links(); ?> -->
			</div>

				<!-- Modal Update -->
				<div id="myModalEdit" class="modal fade" role="dialog" >
					<div class="modal-dialog modal-lg">
						<!-- konten modal-->
						<div class="modal-content">
							<!-- heading modal -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Edit Data Department</h4>
							</div>
							<!-- body modal -->
							<div class="container" style="width: 60% ; ">

								<div class="col-sm-11">
								<!-- untuk isi -->
								<div class="panel panel-info">
									<div class="panel-heading">Formulir Update Department</div>

								<div class="panel-body">
							
									<!-- awal pembuatan form -->
									<form class="form-horizontal" action="<?php echo base_url('CDepartment/updetdepart') ?>" method="POST" name="formbook" enctype="multipart/form-data" id="formedit">


										<div class="form-group">
											<label class="col-sm-2 control-label">Id Department</label>
											<div class="col-sm-2">
											<input type="text" name="id" id="id2" value="" readonly>
											
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Department</label>
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



			<!-- Modal input -->
				<div id="myModal1" class="modal fade" role="dialog" >
					<div class="modal-dialog modal-lg">
						<!-- konten modal-->
						<div class="modal-content">
							<!-- heading modal -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Input Data Department</h4>
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
									<div class="panel-heading">Formulir Input Department Baru</div>

								<div class="panel-body">
										
									<!-- awal pembuatan form -->
									<form class="form-horizontal" method="POST" name="formbook" enctype="multipart/form-data">


										<div class="form-group">
											<label class="col-sm-2 control-label">Id Department</label>
											<div class="col-sm-2">
											<input type="text" name="id" id="id">
										</div></div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Nama Department</label>
											<div class="col-sm-2">
											<input type="text" name="nama" id="nama" placeholder="isi nama Department... " required>
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
								<h4 class="modal-title">Data Department</h4>
							</div>
							<!-- body modal -->
						<div class="panel panel-info">
						
							<div class="modal-body" style="overflow: auto;">

						<div>
							<div style="overflow: auto;">
								
								<table class="table">
									<thead>
										<th>No</th>
										<th>Id Department</th>
										<th>Nama Department</th>
										

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
									<td><?php echo $row->id_department; ?></td>
									<td><?php echo $row->nmDepart; ?></td>
									
									</tr>
																		
									<?php } ?>
									</tbody>
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
	<!-- <script src="<?php //echo base_url('assets/build/js/sweetalert-dev.js')?>"></script> -->



	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

<?php if (isset($pesan)) {?>
<?php if($pesan !== ""){ ?>
	
	<script type="text/javascript">
		$(document).ready(function(){
			// var pesan = $("label#pesan").text();
			// $.alert({
			//     title: 'Duplicate!',
			//     content: pesan,
			// });
			swal("Notification", "Duplicate!", "error", {
				button: "OK!",
			});
		});
	</script>

<?php } } ?>



<script type="text/javascript"> 
	// deleteswall
		function deletedata(id_department)
		{

			swal({
			  title: "Question !",
			  text: "Yakin di Hapus?",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {

			  if (willDelete) {
			  	// alert('a');
			    $.ajax({
			    	url: "<?php echo base_url('CDepartment/deletedepartment/');  ?>"+ id_department,
			    	type: "post",
			    	
			    	success:function(){
			    		swal({
					  title: "Notification",
					  text: "Berhasil Hapus",
					  icon: "success",
					  button:'OK'
					 
					}).then(function(){

					window.location.href="<?php echo base_url('CDepartment') ?>";
					})
			    		
			    	}
			    })
			  } else {
			    swal("Your file is safe!");
			  }
			});
		}

	// SaveModalSwal
	$('#myModal1').submit(function(){
		if (confirm("yakin data ingin di simpan?")) {

			nama=$('#nama').val();
			id=$('#id').val();

			$.ajax({
				type:'POST',
				url : "<?php echo base_url('CDepartment/savedepart/'); ?>",
				data : {nama: nama, id:id},
				dataType: "json",
				success: function(data){

					swal({
					  title: "Notification",
					  text: "Berhasil Simpan",
					  icon: "success",
					  button:'OK'
					 
					}).then(function(){

					window.location.href="<?php echo base_url('CDepartment') ?>";
					})
						
					
				},
				error:function(data){
					swal({
					  title: "Notification",
					  text: "Failed Updated",
					  icon: "error",
					  button:'OK'
					 
					})
			
				}
			});
			return false
		}
		return false
	});

	// updatedswal
	$('#myModalEdit').submit(function(){
		if (confirm("yakin data ingin di simpan?")) {

			nama=$('#nama2').val();
			id=$('#id2').val();

			$.ajax({
				type:'POST',
				url : "<?php echo base_url('CDepartment/updetdepart/'); ?>",
				data : {nama: nama, id:id},
				dataType: "json",
				success: function(data){

					swal({
					  title: "Notification",
					  text: "Berhasil Updated",
					  icon: "success",
					  button:'OK'
					 
					}).then(function(){

					window.location.href="<?php echo base_url('CDepartment') ?>";
					})
						
					
				},
				error:function(data){
					swal({
					  title: "Notification",
					  text: "Failed Updated",
					  icon: "error",
					  button:'OK'
					 
					})
			
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
			url : "<?php echo base_url('CDepartment/editdepart/') ?>"+id,
			dataType : "JSON",
			success:function(data){
				
				$('#id2').val(data.id);
				$('#nama2').val(data.nama);
			},
			error: function(err){

			}	
		})
	}

	$(document).ready(function(){ 
		
		$("#tbl_dep").DataTable({
		
	});


		$(document).on('click','.btn_detil',function(){
			id_department= $(this).attr("data-id");
			// alert('a');
				$.ajax({
						url:"<?php echo base_url('CDepartment/get_departmen/') ?>"+id_department,
						method:"POST",
						dataType:"json",
						success:function(data){
							$('#id').val(data.id_department);
							$('#nama').val(data.nmDepart);
							

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

