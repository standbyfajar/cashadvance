<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="icon" href="<?php echo base_url('image/era.jpg') ?>" type="image/ico" />
	
		  <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.css') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/css/bootstrap.min.css') ?>">
<script src="<?php echo base_url('bootstrap/js/jquery-3.1.1.min.js') ?>"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/build/js/sweet.js')?>"></script>
	<script src="<?php echo base_url('assets/build/js/sweetalert.min.js')?>"></script>
	<script src="<?php echo base_url('assets/build/js/sweetalert-dev.js')?>"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
</head>
<!-- <script >
	function myFunction()
		{
			alert("Thanks for login");
		}
</script> -->
<body>

<div class="container" style="margin-top:  150px; width: 30%;">

		<div class="panel panel-info">
		<div class="panel-heading"><center><b>Please Sign In</b></center></div>
		<div class="panel-body">
		<br>
		<?php if (isset($pesan)) {?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert"> X </button>
				<h4>Warning !</h4>
				<?php echo $pesan; ?>
			</div>
		<?php } ?>
		
			
	<form class="form-vertical" method="POST" name="formPILIH" action="<?php echo base_url('Login/login') ?>" >
		<div class="form-group">
			<label for="user_nama" class="control-label">Username:</label>
				<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input type="text" name="user_nama" class="form-control" id="user_nama" placeholder="user name" autofocus required>
			</div>
		</div>

		<div class="form-group">
			<label for="kata_kunci" class="control-label">Password :</label>
				<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<input type="password" name="kata_kunci" class="form-control" id="kata-kunci" placeholder="password" required>
			</div>
				<a href="#">Forgot Password ?</a>
			
		</div>
				<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> LOGIN</button>
				</div>
	</form>	
				
			</div>
		</div>
	
</div>
<script type="text/javascript">
	$("form").submit(function(e){
     e.preventDefault();
     // alert('a');
     // return false;
     $.ajax({
		url:'<?php echo base_url('Login/login') ?>',
		type:'post',
		dataType: 'json',
		data: $(this).serialize(),
		success:function(dt){
			if(dt.login=='berhasil') {
				swal({
			  title: "Notification",
			  text: "Login sukses",
			  icon: "success",
			  button:'OK'
			 
			}).then(function(){

				window.location = '<?=base_url('Cashadvance')?>'
				})
			} else {
				swal('Notification','Login Failed, Something Wrong :(','error',{button: 'OK',});
				
			}
		}
	})
  });
	
</script>
</body>
</html>