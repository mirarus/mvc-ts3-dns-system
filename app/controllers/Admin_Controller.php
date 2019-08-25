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

class Admin_Controller extends controller
{

	public function index_Action()
	{	
		MainPageRedirect('admin');
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Ana Sayfa';
		$data['url']		= 'main_page';
		$data['menubxar']	= '
		<div class="page-header">
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
		$data['top_bar'] 		= true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername(@$_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['DNS_Data_F']		= $this->model('dns')->GetDNSAdmin(@$Admin_Data['username']);
		$data['Support_Data_F']	= $this->model('support')->GetSupportAdmin(@$Admin_Data['username']);
		$this->Adminrender('main_page', $data);
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