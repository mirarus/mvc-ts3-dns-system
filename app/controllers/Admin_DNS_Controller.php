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

class Admin_DNS_Controller extends controller
{

	public function Config_index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'DNS Ayarları';
		$data['url']		= 'admin/dns_settings';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> DNS Ayarları </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">DNS Ayarları</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['DNS_Control']	= $this->model('config')->DNSCONFIGX();
		$this->Adminrender('dns_settings', $data);
	}

	public function index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Oluşturulan DNS\'ler';
		$data['url']		= 'admin/dns';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> DNS\'ler </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Oluşturulan DNS\'ler</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['DNS_Data_F']		= $this->model('dns')->GetDNSAdmin($Admin_Data['username']);
		$this->Adminrender('dns', $data);
	}

	public function LoginAccess()
	{
		$Admin_Data	= $this->model('admin')->GetAdminByUsername(@$_SESSION['admin_username']);
		if (empty($_SESSION['_admin_login_']) || empty($_SESSION['admin_username']) || empty($Admin_Data['username'])) {
			redirect(SITE_URL.'/admin/login');
		}
	}
}

?>