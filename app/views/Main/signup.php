<?php
/*
	Mirarus MVC Dns System for everyone
	Copyright (C) 2019 by Mirarus

	This program is free software
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
		
	for help look https://mirarus.com/mvc-ts3-dns-system
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo isset($title) ? $title.' - '.SITE_NAME : SITE_NAME ?></title>
	<meta content="Mirarus" name="author">
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/vendors/css/vendor.bundle.base.min.css">
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/vendors/css/vendor.bundle.addons.min.css">
	<!-- endinject -->
	<!-- plugin css for this page -->
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/css/style.min.css">
	<!-- endinject -->
	<link rel="shortcut icon" href="<?php echo VMADIR; ?>/assets/images/favicon.png" />
</head>

<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth">
				<div class="row w-100">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left p-5">
							<div class="brand-logo">
								<?php if (file_exists(VMDIR.'/Template/assets/images/logo.svg')) {
									echo '<img src="'.VMADIR.'/assets/images/logo.svg">';
								} else{
									echo '<h3>'.SITE_NAME.'</h3>';
								} ?>
							</div>
							<h4>Hoşgeldin!</h4>
							<h6 class="font-weight-light">Dns Oluşturabilmek İçin Kayıt Olmalısın.</h6>
							<div id="SignUpAlert" ></div>
							<form class="pt-3" action="" onsubmit="return false;">
								<div class="form-group">
									<input type="email" class="form-control form-control-lg" id="mail" autocomplete="off" placeholder="Mail Adresi">
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-lg" id="password" autocomplete="off" placeholder="Şifre">
								</div>
								<div class="mt-3">
									<button onclick="SignUp();" id="SignUpBtn" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">
										KAYIT OL
									</button>
								</div>
							</form>
							<div class="text-center mt-4 font-weight-light">
								Hesabınız Varmı? <a href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/login'" class="text-primary">Giriş Yap</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- content-wrapper ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->
	<!-- plugins:js -->
	<script src="<?php echo VMADIR; ?>/assets/vendors/js/vendor.bundle.base.min.js"></script>
	<script src="<?php echo VMADIR; ?>/assets/vendors/js/vendor.bundle.addons.js"></script>
	<!-- endinject -->
	<!-- inject:js -->
	<script src="<?php echo VMADIR; ?>/assets/js/off-canvas.js"></script>
	<script src="<?php echo VMADIR; ?>/assets/js/misc.js"></script>
	<!-- endinject -->
	<!-- Custom js for this page-->
	<script src="<?php echo VMADIR; ?>/assets/js/user.js"></script>
	<!-- End custom js for this page-->
</body>

</html>