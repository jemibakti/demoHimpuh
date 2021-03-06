<!DOCTYPE html>
<html lang="en">
<head>
	<title>Himpuh Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>asset/newLogin/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/newLogin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/newLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/newLogin/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/newLogin/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/newLogin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/newLogin/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/newLogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/newLogin/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url(); ?>asset/newLogin/images/img-01.jpg');">
		
			<div class="wrap-login100 p-t-190 p-b-30">
				<?php if($this->session->flashdata('gagal')){ ?>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<?php echo $this->session->flashdata('gagal'); ?>
					</div>
				<?php }?>
				<form class="login100-form validate-form" method="post" action="<?php echo site_url('login/cek_login')?>">
					<div class="login100-form-avatar">
						<img src="<?php echo base_url(); ?>asset/newLogin/images/avatar-01.jpg" alt="AVATAR">
					</div>
					
					<span class="login100-form-title p-t-20 p-b-45">
						Himpuh
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Username Tidak Boleh Kosong">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate = "Password Tidak Boleh Kosong">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="<?php echo base_url(); ?>asset/newLogin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>asset/newLogin/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>asset/newLogin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>asset/newLogin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>asset/newLogin/js/main.js"></script>

</body>
</html>