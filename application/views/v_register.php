<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Registrasi</title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url() . 'asset/masuk/vendor/fontawesome-free/css/all.min.css' ?>" rel="stylesheet"
		  type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		  rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url() . 'asset/masuk/css/sb-admin-2.min.css" rel="stylesheet' ?>">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

	<!-- Sidebar -->

	<!-- End of Sidebar -->

	<!-- Content Wrapper -->
	<!-- Nav Item - Alerts -->
	<!--===============================================================================================-->
	<link rel="icon" type="izmage/png" href="<?php echo base_url() . 'asset/login/images/icons/favicon.ico' ?>"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url() . 'asset/login/vendor/bootstrap/css/bootstrap.min.css' ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url() . 'asset/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css' ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url() . 'asset/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css' ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'asset/login/vendor/animate/animate.css' ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url() . 'asset/login/vendor/css-hamburgers/hamburgers.min.css' ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url() . 'asset/login/vendor/animsition/css/animsition.min.css' ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url() . 'asset/login/vendor/select2/select2.min.css' ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url() . 'asset/login/vendor/daterangepicker/daterangepicker.css' ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'asset/login/css/util.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'asset/login/css/main.css' ?>">
	<!--===============================================================================================-->

	<!-- End of Topbar -->

	<!-- Begin Page Content -->
	<div class="container-fluid">
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
					<center><h1>Registrasi Anggota</h1></center>
					<form action="<?= base_url() ?>index.php/Login/register_aksi" method="POST"
						  enctype="multipart/form-data">
						<table style="margin: 20px auto;">
							<tbody>
							<tr>
								<td>Nama Lengkap</td>
								<td><input type="text" name="nama" class="form-control form-control-user"></td>
							</tr>
							<tr>
								<td>Username</td>
								<td><input type="text" name="username" class="form-control form-control-user"></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input type="password" name="password" class="form-control form-control-user"></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td>
									<input type="radio" name="jenis_kelamin" value="Laki-laki">Laki-laki
									<input type="radio" name="jenis_kelamin" value="Perempuan">Perempuan
								</td>
							</tr>
							<tr>
								<td>Email</td>
								<td><input type="email" name="email" class="form-control form-control-user"></td>
							</tr>
							<tr>
								<td>No Hp</td>
								<td><input type="number" name="no_hp" class="form-control form-control-user"></td>
							</tr>
							<tr>
								<td>NIK</td>
								<td><input type="text" name="nik" class="form-control form-control-user"></td>
							</tr>
							<tr>
								<td>KTP</td>
								<td><input type="file" name="ktp" class="form-control form-control-user" required="">
								</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td><textarea name="alamat" value="alamat" style="width: 100%"
											  class="form-control form-control-user"></textarea></td>
							</tr>
							<tr>
								<td colspan="2" align="center"><br>
									<input type="submit" name="submit" value="Register" style="width: 100%">
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<a href="<?= base_url() ?>index.php/Login">Sudah punya akun? Login</a>
								</td>
							</tr>
							</tbody>
						</table>
					</form>
					<center>
						<?php
						echo $this->session->flashdata('pesan');
						?></center>
				</div>
			</div>
		</div>

		<!--===============================================================================================-->
		<script src="<?php echo base_url() . 'asset/login/vendor/jquery/jquery-3.2.1.min.js' ?>"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url() . 'asset/login/vendor/animsition/js/animsition.min.js' ?>"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url() . 'asset/login/vendor/bootstrap/js/popper.js' ?>"></script>
		<script src="<?php echo base_url() . 'asset/login/vendor/bootstrap/js/bootstrap.min.js' ?>"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url() . 'asset/login/vendor/select2/select2.min.js' ?>"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url() . 'asset/login/vendor/daterangepicker/moment.min.js' ?>"></script>
		<script src="<?php echo base_url() . 'asset/login/vendor/daterangepicker/daterangepicker.js' ?>"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url() . 'asset/login/vendor/countdowntime/countdowntime.js' ?>"></script>
		<!--===============================================================================================-->
		<script src="<?php echo base_url() . 'asset/login/js/main.js' ?>"></script>

		<!-- Footer -->
		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
				<div class="copyright text-center my-auto">
					<span>Copyright &copy; Koperasi </span>
				</div>
			</div>
		</footer>
		<!-- End of Footer -->

	</div>
	<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="<?= site_url('Admin/logout') ?>">Logout</a>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() . 'asset/vendor/jquery/jquery.min.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/vendor/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() . 'asset/vendor/jquery-easing/jquery.easing.min.js' ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() . 'asset/js/sb-admin-2.min.js' ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url() . 'asset/vendor/chart.js/Chart.min.js' ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url() . 'asset/js/demo/chart-area-demo.js' ?>"></script>
<script src="<?php echo base_url() . 'asset/js/demo/chart-pie-demo.js' ?>"></script>
</body>
</html>
