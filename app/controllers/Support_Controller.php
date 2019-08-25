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

class Support_Controller extends controller
{

	public function index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Destek Taleplerim';
		$data['url']		= 'support';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Oluşturulan Destek Taleplerim </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">DNS Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Destek Taleplerim</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$User_Data				= $this->model('user')->GetUserByMail($_SESSION['user_mail']);
		$data['mail']			= $User_Data['mail'];
		$data['DNS_Count']		= $this->model('dns')->CountDNS($User_Data['mail']);
		$data['Supports_Count']	= $this->model('support')->CountSupport($User_Data['mail']);
		$data['Support_Data_F']	= $this->model('support')->GetSupportByUMAIL($User_Data['mail']);
		$this->Mainrender('support', $data);
	}

	public function Create_index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Destek Talebi Oluştur';
		$data['url']		= 'support/create';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Destek Bileti Oluştur </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">DNS Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Destek Talebi Oluştur</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] = true;
		$User_Data		= $this->model('user')->GetUserByMail($_SESSION['user_mail']);
		$data['mail']	= $User_Data['mail'];
		$data['DNS_Count']		= $this->model('dns')->CountDNS($User_Data['mail']);
		$data['Supports_Count']	= $this->model('support')->CountSupport($User_Data['mail']);
		$this->Mainrender('support_create', $data);
	}

	public function View_index_Action($id)
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Destek Talebi Görüntüle';
		$data['url']		= 'support/'.$id;
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> Destek Bileti Görüntüle - #'.$id.' </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">DNS Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Destek Talebi Görüntüle</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] = true;
		$User_Data		= $this->model('user')->GetUserByMail($_SESSION['user_mail']);
		$data['mail']	= $User_Data['mail'];
		$data['DNS_Count']	= $this->model('dns')->CountDNS($User_Data['mail']);
		$data['Supports_Count']	= $this->model('support')->CountSupport($User_Data['mail']);
		$Support_Control	= $this->model('support')->GetSupportByUSER($User_Data['mail'], $id);
		$data['Support_Data']	= $this->model('support')->GetSupportByID($User_Data['mail'], $id);
		$data['Support_Replies_Data_F']	= $this->model('support')->GetSupportRepliesByUSER($User_Data['mail'], $id);
		if ($Support_Control) {
			$this->Mainrender('support_view', $data);
		} else{
			redirect(SITE_URL.'/support');
		}
	}

	public function LoginAccess()
	{
		$User_Data	= $this->model('user')->GetUserByMail($_SESSION['user_mail']);
		$this->model('user')->UpdateIP($User_Data['mail']);
		if (empty($_SESSION['_login_']) || empty($_SESSION['user_mail']) || empty($User_Data['mail'])) {
			redirect(SITE_URL.'/login');
		}
	}
}

?>