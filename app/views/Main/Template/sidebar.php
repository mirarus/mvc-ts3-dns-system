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
		<?php echo $_GET['url'] == 'main_page' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
		<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/main_page'">
			<span class="menu-title">Ana Sayfa</span>
			<i class="mdi mdi-home menu-icon"></i>
		</a>
		<?php echo '</li>'; ?>
		<!-- Menu -->
		<!-- Menu -->
		<li class="nav-item sidebar-actions">
			<div class="border-bottom">
				<p class="text-secondary">DNS Sistemi</p>
			</div>
			<!-- Menu -->
			<?php echo $_GET['url'] == 'dns' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/dns'">
				<span class="menu-title">DNS</span>
				<i class="mdi mdi-buffer menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
			<!-- Menu -->
			<?php echo $_GET['url'] == 'dns/create' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/dns/create'">
				<span class="menu-title">DNS Oluştur</span>
				<i class="mdi mdi-plus-circle-outline menu-icon"></i>
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
			<?php echo $_GET['url'] == 'support' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/support'">
				<span class="menu-title">Destek Taleplerim</span>
				<i class="fa fa-support menu-icon"></i>
			</a>
			<?php echo '</li>'; ?>
			<!-- Menu -->
			<!-- Menu -->
			<?php echo $_GET['url'] == 'support/create' ? '<li class="nav-item active">' : '<li class="nav-item">'; ?>
			<a class="nav-link" href="#" onclick="window.location.href='<?php echo SITE_URL; ?>/support/create'">
				<span class="menu-title">Destek Talebi Oluştur</span>
				<i class="fa fa-ticket menu-icon"></i>
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