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
	<title><?php echo isset($title) ? $title.' - '.$Site_Title : $Site_Title; ?></title>
	<meta name="description" content="<?php echo $Site_Description; ?>">
	<meta name="keywords" content="<?php echo $Site_Keywords; ?>" />
	<meta content="Mirarus" name="author">
	<!-- plugins:css -->
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/vendors/css/vendor.bundle.base.min.css">
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/vendors/css/vendor.bundle.addons.min.css">
	<!-- endinject -->
	<!-- plugin css for this page -->
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
	<!-- End plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo VMADIR; ?>/assets/css/style.min.css">
	<!-- endinject -->
	<link rel="shortcut icon" href="<?php echo VMADIR; ?>/assets/images/favicon.png" />
</head>
<body>
	<div class="container-scroller">
		<!-- partial:navbar -->
		<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
				<a class="navbar-brand brand-logo" href="<?php echo SITE_URL; ?>">
					<?php echo '<h4>'.$Site_Title.'</h4>'; ?>
				</a>
				<a class="navbar-brand brand-logo-mini" href="<?php echo SITE_URL; ?>">
					<?php echo '<h3>DNS</h3>'; ?>
				</a>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-stretch">
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
					<span class="mdi mdi-menu"></span>
				</button>
				<ul class="navbar-nav navbar-nav-right">
					<?php if (@$_SESSION['_admin_login_'] && @$_SESSION['admin_username']) { ?>
						<li class="nav-item d-none d-lg-block">
							<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin'">
								<p style="font-size: 18px;cursor: pointer;" class="mb-1 text-black">Admin Paneline Git</p>
							</a>
						</li>
					<?php } ?>
					<li class="nav-item nav-profile dropdown">
						<a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
							<div class="nav-profile-text">
								<p style="font-size: 20px" class="mb-1 text-black"><?php echo $mail ?></p>
							</div>
						</a>
						<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
							<?php $pw_url = explode('url=', $_SERVER['QUERY_STRING'])['1']; ?>
							<a class="dropdown-item" href="#" onclick="PasswordChange('<?php echo SITE_URL.'/'.$pw_url; ?>', '<?php echo SITE_URL; ?>');">
								<i class="mdi mdi-account-key mr-2 text-primary"></i>
								Şifre Değiştir
							</a>
							<a class="dropdown-item" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/logout'">
								<i class="mdi mdi-logout mr-2 text-primary"></i>
								Çıkış Yap
							</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<?php require VMDIR.'/Template/sidebar.php'; ?>

			<!-- Page Title Header Starts-->
			<?php $mbar = '<div class="page-header">
			<h3 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-white mr-2">
			<i class="mdi mdi-home"></i>                 
			</span>
			Ana Sayfa
			</h3>
			<nav aria-label="breadcrumb">
			<ul class="breadcrumb">
			<li class="breadcrumb-item active" aria-current="page">
			<span></span>Ana Sayfa
			</li>
			</ul>
			</nav>
			</div>';
			echo isset($menubar) ? $menubar : $mbar; ?>

			<!-- Page Title Header Ends-->
			<?php if ($top_bar) { ?>
				<div class="row">
					<div class="col-md-6 stretch-card grid-margin" style="height: 50%;min-height: 50%;max-height: 50%;">
						<div class="card bg-gradient-danger card-img-holder text-white">
							<div class="card-body">
								<img src="<?php echo VMADIR; ?>/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>
								<h4 class="font-weight-normal mb-3">Oluşturduğum DNS'ler
									<i class="mdi mdi-chart-line mdi-24px float-right"></i>
								</h4>
								<h2><?php echo $DNS_Count.' Adet'; ?></h2>
							</div>
						</div>
					</div>
					<div class="col-md-6 stretch-card grid-margin" style="height: 50%;min-height: 50%;max-height: 50%;">
						<div class="card bg-gradient-info card-img-holder text-white">
							<div class="card-body">
								<img src="<?php echo VMADIR; ?>/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image"/>                  
								<h4 class="font-weight-normal mb-3">Destek Taleplerim
									<i class="fa fa-support mdi-24px float-right"></i>
								</h4>
								<h2><?php echo $Supports_Count.' Adet'; ?></h2>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
