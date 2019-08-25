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

class Admin_User_Controller extends controller
{
	public function Login_index_Action()
	{
		$this->LoginAccessX();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['title'] = 'Giriş';
		$this->Adminrender('login', $data);
	}

	public function logout_Action()
	{
		$this->LoginAccess();
		unset($_SESSION['_admin_login_']);
		unset($_SESSION['admin_username']);
		redirect(SITE_URL.'/admin/main_page');
	}

	public function User_index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Üyeler';
		$data['url']		= 'admin/users';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Üyeler </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Üyeler</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['Site_Control']	= $this->model('config')->SITECONFIG();
		$data['User_Data_F']	= $this->model('user')->GetUserAdmin($Admin_Data['username']);
		$this->Adminrender('users', $data);
	}

	public function User_Create_index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Üye Oluştur';
		$data['url']		= 'admin/user/create';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Üye Oluştur </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Üye Oluştur</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['Site_Control']	= $this->model('config')->SITECONFIG();
		$this->Adminrender('user_create', $data);
	}

	public function User_Edit_İndex_Action($id)
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Üye Düzenle';
		$data['url']		= 'admin/user/'.$id;
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Üye Düzenle </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Üye Düzenle</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] = true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['Site_Control']	= $this->model('config')->SITECONFIG();
		$data['User_Control']	= $this->model('user')->GetUserAdminX($Admin_Data['username'], $id);
		if ($data['User_Control']) {
			$this->Adminrender('user_edit', $data);
		} else{
			redirect(SITE_URL.'/admin/users');
		}
	}

	public function Admin_index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Adminler';
		$data['url']		= 'admin/admins';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Adminler </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Adminler</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['Site_Control']	= $this->model('config')->SITECONFIG();
		$data['Admin_Data_F']	= $this->model('admin')->GetAdmin($Admin_Data['username']);
		$this->Adminrender('admins', $data);
	}

	public function Admin_Create_index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Admin Oluştur';
		$data['url']		= 'admin/admin/create';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Admin Oluştur </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Admin Oluştur</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['Site_Control']	= $this->model('config')->SITECONFIG();
		$this->Adminrender('admin_create', $data);
	}

	public function Admin_Edit_İndex_Action($id)
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Admin Düzenle';
		$data['url']		= 'admin/admin/'.$id;
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Admin Düzenle </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Admin Düzenle</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] = true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['Site_Control']	= $this->model('config')->SITECONFIG();
		$data['Admin_Control']	= $this->model('admin')->GetAdminX($Admin_Data['username'], $id);
		if ($data['Admin_Control']) {
			$this->Adminrender('admin_edit', $data);
		} else{
			redirect(SITE_URL.'/admin/admins');
		}
	}

	public function LoginAccessX()
	{
		$Admin_Data	= $this->model('admin')->GetAdminByUsername(@$_SESSION['admin_username']);
		if (@$_SESSION['_admin_login_'] && $_SESSION['admin_username'] && $Admin_Data['username']) {
			redirect(SITE_URL.'/admin/main_page');
		}
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