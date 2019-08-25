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

class Admin_Support_Controller extends controller
{

	public function index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Destek Talepleri';
		$data['url']		= 'admin/support';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Destek Talepleri </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Destek Talepleri</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$data['Support_Data_F']	= $this->model('support')->GetSupportAdmin($Admin_Data['username']);
		$this->Adminrender('support', $data);
	}

	public function View_index_Action($id)
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Destek Talebi Görüntüle';
		$data['url']		= 'admin/support/'.$id;
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Destek Bileti Görüntüle - #'.$id.' </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Admin Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Destek Talebi Görüntüle</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] = true;
		$Admin_Data				= $this->model('admin')->GetAdminByUsername($_SESSION['admin_username']);
		$data['username']		= $Admin_Data['username'];
		$data['User_Count']		= $this->model('user')->CountUserAdmin($Admin_Data['username']);
		$data['DNS_Count']		= $this->model('dns')->CountDNSAdmin($Admin_Data['username']);
		$data['Supports_Count']	= $this->model('support')->CountSupportAdmin($Admin_Data['username']);
		$Support_Control		= $this->model('support')->GetSupportAdminX($Admin_Data['username'], $id);
		$data['Support_Data']	= $this->model('support')->GetSupportByIDAdmin($Admin_Data['username'], $id);
		$data['Support_Replies_Data_F']	= $this->model('support')->GetSupportRepliesByUSERAdmin($Admin_Data['username'], $id);
		if ($Support_Control) {
			$this->Adminrender('support_view', $data);
		} else{
			redirect(SITE_URL.'/admin/support');
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