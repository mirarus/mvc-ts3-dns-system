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

class DNS_Controller extends controller
{

	public function index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'Oluşturulan DNS\'ler';
		$data['url']		= 'dns';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> DNS\'ler </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">DNS Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">Oluşturulan DNS\'ler</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] 		= true;
		$User_Data				= $this->model('user')->GetUserByMail($_SESSION['user_mail']);
		$data['mail']			= $User_Data['mail'];
		$data['DNS_Data_F']		= $this->model('dns')->GetDNSByUMAIL($User_Data['mail']);
		$data['DNS_Count']		= $this->model('dns')->CountDNS($User_Data['mail']);
		$data['Supports_Count']	= $this->model('support')->CountSupport($User_Data['mail']);
		$this->Mainrender('dns', $data);
	}

	public function Create_index_Action()
	{	
		$this->LoginAccess();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['Site_Footer']		= $this->model('config')->SITECONFIG()['footer'];
		$data['title']		= 'DNS Oluştur';
		$data['url']		= 'dns/create';
		$data['menubar']	= '
		<div class="page-header">
		<h3 class="page-title"> DNS Oluştur </h3>
		<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">DNS Paneli</a></li>
		<li class="breadcrumb-item active" aria-current="page">DNS Oluştur</li>
		</ol>
		</nav>
		</div>';
		$data['top_bar'] = true;
		$User_Data		= $this->model('user')->GetUserByMail($_SESSION['user_mail']);
		$data['mail']	= $User_Data['mail'];
		$Dns_Configs 	= $this->model('config')->DNSCONFIG();
		foreach ($Dns_Configs as $Dns_Config){
			$data['dns_domains']	= explode('|', $Dns_Config['domain']);
		}
		$data['DNS_Count']		= $this->model('dns')->CountDNS($User_Data['mail']);
		$data['Supports_Count']	= $this->model('support')->CountSupport($User_Data['mail']);
		$this->Mainrender('dns_create', $data);
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