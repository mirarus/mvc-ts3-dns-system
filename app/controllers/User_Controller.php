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

class User_Controller extends controller
{
	public function Login_index_Action()
	{
		$this->LoginAccessX();
		$data['Site_Title']			= $this->model('config')->SITECONFIG()['title'];
		$data['Site_Description']	= $this->model('config')->SITECONFIG()['description'];
		$data['Site_Keywords']		= $this->model('config')->SITECONFIG()['keywords'];
		$data['title'] = 'Giriş';
		$this->Mainrender('login', $data);
	}

	public function Signup_index_Action()
	{
		$this->LoginAccessx();
		$data['title'] = 'Kayıt';
		$this->Mainrender('signup', $data);
	}

	public function logout_Action()
	{
		$this->LoginAccess();
		unset($_SESSION['_login_']);
		unset($_SESSION['user_mail']);
		redirect(SITE_URL.'/main_page');
	}

	public function LoginAccessX()
	{
		$User_Data	= $this->model('user')->GetUserByMail(@$_SESSION['user_mail']);
		$this->model('user')->UpdateIP($User_Data['mail']);
		if (@$_SESSION['_login_'] && $_SESSION['user_mail'] && $User_Data['mail']) {
			redirect(SITE_URL.'/main_page');
		}
	}

	public function LoginAccess()
	{
		$User_Data	= $this->model('user')->GetUserByMail(@$_SESSION['user_mail']);
		$this->model('user')->UpdateIP($User_Data['mail']);
		if (@$_SESSION['_login_'] && $_SESSION['user_mail'] && $User_Data['mail']) {
			redirect(SITE_URL.'/main_page');
		}
	}
}

?>