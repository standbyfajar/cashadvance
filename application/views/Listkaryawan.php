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
      <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
<script src="<?php echo base_url('bootstrap/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('assets/DataTables/datatables.min.js') ?>"></script>
<script type="text/javascript">

</script>
</head>

<!-- ,menu atas -->
<?php $this->load->view('Navbar'); ?>
 
<body>
<?php 
?>
<!-- menu kiri -->
<div class="container" style="margin-top: 10pt">

	
	<!-- index -->
	<div class="col-sm-12">
	<!-- untuk isi -->
	<div class="panel panel-info">
		<div class="panel-heading">Daftar Karyawan</div>
	<div class="panel-body">
<table class="table " id="tbl_one">
	<thead>
		<tr>
		<th>No</th>
		<th>Id Karyawan</th>
		<th>Nama Karyawan</th>
		<!-- <th>Email</th> -->
		<th>Jabatan</th>
		<!-- <th>Id Department</th>
		<th>Jenis Kelamin</th>
		<th>Telepon</th>
		<th>Gaji</th>
		 -->
		
		<th>Aksi &nbsp;<a class="btn btn-primary btn-xs" href="<?php echo base_url('Cashadvance/tambahkaryawan') ?>" role="button" title="New">
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
		<td><?php echo $row->id_karyawan; ?></td>
		<td><?php echo $row->nama_karyawan; ?></td>
		<!-- <td><?php echo $row->email; ?></td>
	 -->	
		<td><?php echo $row->jabatan; ?></td>
		<!-- <td><?php echo $row->id_department; ?></td>
		<td><?php echo $row->jenis_kelamin; ?></td>
		<td><?php echo $row->nomor_telpon; ?></td>
		<td><?php echo $row->gaji; ?></td>
 -->
		
		<td><a class="btn btn-primary btn-xs" role="button" title="Edit" href="<?php echo base_url('Cashadvance/editkaryawan/').$row->id_karyawan; ?>">
			<span class="glyphicon glyphicon-edit">Edit</span> </a>
			<a class="btn btn-danger btn-xs" href="<?php echo base_url('Cashadvance/deletkaryawan/').$row->id_karyawan; ?>" role="button" title="Delete"  title="delete dosen" onclick="return confirm('benar akan dihapus?');" >
			<span class="glyphicon glyphicon-remove"></span> Delete</a>
			<button data-id="<?php echo $row->id_karyawan; ?>" type="button" class="btn btn-info btn-xs btn_detil" ><span class="glyphicon glyphicon-th-large"></span>info</button></td>
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
						<td><?php echo $row->id_karyawan; ?></td>
						<td><?php echo $row->nama_karyawan; ?></td>
						<td><?php echo $row->email; ?></td>
					
						<td><?php echo $row->jabatan; ?></td>
						<td><?php echo $row->id_department; ?></td>
						<td><?php echo $row->jenis_kelamin; ?></td>
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
				<input type="text" id="nama" value="">
			</div></div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Email</label>
				<div class="col-sm-2">
				<input type="text" id="eml" value="">
			</div></div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jabatan</label>
				<div class="col-sm-2">
				<input type="text" id="jbt" value="">
			</div></div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Id Department</label>
				<div class="col-sm-2">
				<input type="text" id="dept" value="">
				
			</div></div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Jenis Kelamin</label>
				<div class="col-sm-2">
				<input type="text" id="jk" value="">
				
			</div></div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Telepon</label>
				<div class="col-sm-2">
				<input type="text" id="tel" value="">
				
			</div></div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Gaji</label>
				<div class="col-sm-2">
				<input type="text" id="gaji" value="">
				
			</div></div>
			
			
		</form>
		</div>


		<div class="col-sm-6">
			<img src="" id="foto">
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
</div>


</body>
<script type="text/javascript">
	
	$(document).ready(function(){

		$('#tbl_one').DataTable();

		$(document).on('click','.btn_detil',function(){
			id_karyawan=$(this).attr("data-id");
				// alert(id_karyawan);
				$.ajax({
						url:"<?php echo base_url('Cashadvance/get_karyawan/') ?>"+id_karyawan,
						method:"POST",
						dataType:"json",
						success:function(data){
							$('#id').val(data.id_karyawan);
							$('#nama').val(data.nama_karyawan);
							$('#eml').val(data.email);
							$('#jbt').val(data.jabatan);
							$('#dept').val(data.id_department);
							$('#jk').val(data.jenis_kelamin);
							$('#tel').val(data.nomor_telpon);
							$('#gaji').val(data.gaji);
							$('#foto').attr('src',);

							$('#infoModal').modal("show");
						},
						error:function(){

						}
					});
		})

		

	});
</script>
</html>

