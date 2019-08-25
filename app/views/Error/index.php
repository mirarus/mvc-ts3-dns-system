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
	<title>404 - <?php echo SITE_NAME; ?></title>
	<meta content="Mirarus" name="author">
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?php echo VEADIR; ?>/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?php echo VEADIR; ?>/vendors/css/vendor.bundle.base.css">
	<!-- endinject -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo VEADIR; ?>/css/style.css">
	<!-- endinject -->
	<link rel="shortcut icon" href="<?php echo VEADIR; ?>/images/favicon.png" />
</head>

<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
				<div class="row flex-grow">
					<div class="col-lg-7 mx-auto text-white">
						<div class="row align-items-center d-flex flex-row">
							<div class="col-lg-6 text-lg-right pr-lg-4">
								<h1 class="display-1 mb-0">404</h1>
							</div>
							<div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
								<h2>SORRY!</h2>
								<h3 class="font-weight-light">Aradığınız sayfa bulunamadı.</h3>
							</div>
						</div>
						<div class="row mt-5">
							<div class="col-12 text-center mt-xl-2">
								<?php
								if (empty($_SESSION['_admin_login_']) && empty($_SESSION['admin_username']) && empty($_SESSION['_login_']) && empty($_SESSION['user_mail'])) {
									echo '<a class="text-white font-weight-medium" href="'.SITE_URL.'/main_page">Ana Sayfa\'ya Dön</a>';
								} else{
									if (@$_SESSION['_admin_login_'] && @$_SESSION['admin_username']) {
										echo '<a class="text-white font-weight-medium" href="'.SITE_URL.'/admin/main_page">Admin Paneli\'ne Dön</a><br><br>';
									} elseif (@$_SESSION['_login_'] && @$_SESSION['user_mail']) {
										echo '<a class="text-white font-weight-medium" href="'.SITE_URL.'/main_page">Ana Sayfa\'ya Dön</a>';
									}
								}
								?>
							</div>
						</div>
						<div class="row mt-5">
							<div class="col-12 mt-xl-2">
								<p class="text-white font-weight-medium text-center">Copyright &copy; 2019 <?php echo SITE_NAME; ?>, All rights reserved.</p>
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
	<script src="<?php echo VEADIR; ?>/vendors/js/vendor.bundle.base.js"></script>
	<script src="<?php echo VEADIR; ?>/vendors/js/vendor.bundle.addons.js"></script>
	<!-- endinject -->
	<!-- inject:js -->
	<script src="<?php echo VEADIR; ?>/js/off-canvas.js"></script>
	<script src="<?php echo VEADIR; ?>/js/misc.js"></script>
	<!-- endinject -->
</body>

</html>