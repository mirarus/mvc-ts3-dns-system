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
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<li class="mb-5"></li>
		<!-- Menu -->
		<?php echo $_GET['url'] == 'admin/main_page' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
		<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/main_page'">
			<span class="menu-title">Ana Sayfa</span>
			<i class="mdi mdi-home menu-icon"></i>
		</a>
		<?php echo '</li>'; ?>
		<!-- Menu -->
		<!-- Menu -->
		<li class="nav-item sidebar-actions">
			<div class="border-bottom">
				<p class="text-secondary">Ayarlar</p>
			</div>
			<!-- Menu -->
			<?php echo $_GET['url'] == 'admin/site_settings' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/site_settings'">
				<span class="menu-title">Site Ayarları</span>
				<i class="mdi mdi-settings menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
			<!-- Menu -->
			<?php echo $_GET['url'] == 'admin/dns_settings' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/dns_settings'">
				<span class="menu-title">DNS Ayarları</span>
				<i class="mdi mdi-settings menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
		</li>
		<!-- Menu -->
		<!-- Menu -->
		<li class="nav-item sidebar-actions">
			<div class="border-bottom">
				<p class="text-secondary">Üye</p>
			</div>
			<!-- Menu -->
			<?php echo $_GET['url'] == 'admin/users' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/users'">
				<span class="menu-title">Üyeler</span>
				<i class="mdi mdi-account-multiple menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
			<!-- Menu -->
			<?php echo $_GET['url'] == 'admin/user/create' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/user/create'">
				<span class="menu-title">Üye Oluştur</span>
				<i class="mdi mdi-account-plus menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
		</li>
		<!-- Menu -->
		<!-- Menu -->
		<li class="nav-item sidebar-actions">
			<div class="border-bottom">
				<p class="text-secondary">Admin</p>
			</div>
			<!-- Menu -->
			<?php echo $_GET['url'] == 'admin/admins' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/admins'">
				<span class="menu-title">Adminler</span>
				<i class="mdi mdi-account-multiple menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
			<!-- Menu -->
			<?php echo $_GET['url'] == 'admin/admin/create' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/admin/create'">
				<span class="menu-title">Admin Oluştur</span>
				<i class="mdi mdi-account-plus menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
		</li>
		<!-- Menu -->
		<!-- Menu -->
		<li class="nav-item sidebar-actions">
			<div class="border-bottom">
				<p class="text-secondary">DNS Sistemi</p>
			</div>
			<!-- Menu -->
			<?php echo $_GET['url'] == 'admin/dns' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/dns'">
				<span class="menu-title">DNS'ler</span>
				<i class="mdi mdi-buffer menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
		</li>
		<!-- Menu -->
		<!-- Menu -->
		<li class="nav-item sidebar-actions">
			<div class="border-bottom">
				<p class="text-secondary">Destek Sistemi</p>
			</div>
			<!-- Menu -->
			<?php echo $_GET['url'] == 'admin/support' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/admin/support'">
				<span class="menu-title">Destek Talepleri</span>
				<i class="fa fa-support menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
		</li>
		<!-- Menu -->
		
	</ul>
</nav>
<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">