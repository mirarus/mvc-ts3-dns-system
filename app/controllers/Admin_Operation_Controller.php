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

class Admin_Operation_Controller extends controller
{

	public function Login_Action()
	{
		$this->LoginAccessX();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {		
			$username = Gauntlet::filter($_REQUEST['username']);
			$password = Gauntlet::filter($_REQUEST['password']);
			if (isset($username) && isset($password) && !empty($username) && !empty($password)) {
				$Admin_Data	= $this->model('admin')->GetAdminByUsername($username);
				if ($Admin_Data) {
					if (password_verify(md5($_REQUEST['password']), $Admin_Data['password']) == true) {
						Session::set('_admin_login_', 'true');
						Session::set('admin_username', $Admin_Data['username']);
						echo admin_alert('', 'Bilgileriniz Doğru, Yönlendiriliyorsunuz!', 'success', 0, "mdi mdi-check-all");
						refresh(SITE_URL.'/admin/main_page', 2);
					} else{
						echo admin_alert('Hata!', 'Bu Bilgilere Sahip Bir Admin Yok!', 'warning', 0, "mdi mdi-alert");
					}
				} else{
					echo admin_alert('Hata!', 'Bu Bilgilere Sahip Bir Admin Yok!', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo admin_alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function User_Password_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$password	= Gauntlet::filter($_REQUEST['password']);
			if (isset($password) && !empty($password)) {
				$Update_Password	= $this->model('admin')->UpdatePassword($_SESSION['admin_username'], $password);
				if ($Update_Password) {
					echo 'Şifreniz Değiştirildi, Lütfen Bekleyiniz!';
				} else{
					echo 'Şifreniz Değiştirilirkek Bir Hata Oluştu!';
				}
			} else{
				echo 'Gerekli Alanları Doldurunuz!';
			}
		}
	}

	public function Site_Settings_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$title			= Gauntlet::filter($_REQUEST['title']);
			$description	= Gauntlet::filter($_REQUEST['description']);
			$keywords		= Gauntlet::filter($_REQUEST['keywords']);
			$footer			= Gauntlet::filter($_REQUEST['footer']);
			if (isset($title) && isset($description) && isset($keywords) && isset($footer) && !empty($title) && !empty($description) && !empty($keywords) && !empty($footer)) {
				$Site_Edit	= $this->model('config')->EditSite($_SESSION['admin_username'], 1, $title, $description, $keywords, $footer);
				if ($Site_Edit) {
					echo alert('', 'Site Ayarları Başarıyla Düzenlendi, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
					refresh(SITE_URL.'/admin/site_settings', 3);
				} else{
					echo alert('Hata!', 'Site Ayarları Düzenlenirken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function DNS_Settings_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$mail	= Gauntlet::filter($_REQUEST['mail']);
			$apikey	= Gauntlet::filter($_REQUEST['apikey']);
			$domain	= Gauntlet::filter($_REQUEST['domain']);
			if (isset($mail) && isset($apikey) && isset($domain) && !empty($mail) && !empty($apikey) && !empty($domain)) {
				$DNS_Edit	= $this->model('config')->EditDNS($_SESSION['admin_username'], 1, $mail, $apikey, $domain);
				if ($DNS_Edit) {
					echo alert('', 'DNS Ayarları Başarıyla Düzenlendi, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
					refresh(SITE_URL.'/admin/dns_settings', 3);
				} else{
					echo alert('Hata!', 'DNS Ayarları Düzenlenirken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function User_Create_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$mail = Gauntlet::filter($_REQUEST['mail']);
			$password = Gauntlet::filter($_REQUEST['password']);
			if (isset($mail) && isset($password) && !empty($mail) && !empty($password)) {
				if (valid_email($mail) == true) {
					if ($this->model('user')->GetUserByMail($mail)) {
						echo alert('Hata!', 'Bu Bilgilere Sahip Bir Üye Bulunuyor!', 'warning', 0, "mdi mdi-alert");
					} else{
						$User_Data	= $this->model('user')->CreateUser($mail, $password);
						if ($User_Data) {
							echo alert('', 'Üye Başarıyla Oluşturuldu, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
							refresh(SITE_URL.'/admin/users', 3);
						} else{
							echo alert('Hata!', 'Üye Oluşturulurken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
						}
					}
				} else{
					echo alert('Hata!', 'Geçersiz Mail Adresi Girdiniz!', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function User_Edit_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id			= Gauntlet::filter($_REQUEST['id']);
			$mail		= Gauntlet::filter($_REQUEST['mail']);
			$password	= Gauntlet::filter($_REQUEST['password']);
			if (isset($id) && isset($mail) && !empty($id) && !empty($mail)) {
				if (valid_email($mail) == true) {
					$User_Control	= $this->model('user')->GetUserAdminX($_SESSION['admin_username'], $id);
					if ($User_Control) {
						if (isset($password) && !empty($password)) {
							$Edit_User = $this->model('user')->EditUserAdmin($_SESSION['admin_username'], $id, $mail, $password);
						} else{
							$Edit_User = $this->model('user')->EditUserAdmin($_SESSION['admin_username'], $id, $mail, $User_Control['password']);
						}
						if ($Edit_User) {
							echo alert('', 'Üye Başarıyla Düzenlendi, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
							refresh(SITE_URL.'/admin/users', 3);
						} else{
							echo alert('Hata!', 'Üye Düzenlenirken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
						}
					} else{
						echo alert('Hata!', 'Üye Bulunamadı!', 'warning', 0, "mdi mdi-alert");
					}
				} else{
					echo alert('Hata!', 'Geçersiz Mail Adresi Girdiniz!', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function User_Delete_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id	= Gauntlet::filter($_REQUEST['id']);
			if (isset($id) && !empty($id)) {
				$User_Control	= $this->model('user')->GetUserAdminX($_SESSION['admin_username'], $id);
				if ($User_Control) {
					$User_Delete	= $this->model('user')->DeleteUserAdmin($_SESSION['admin_username'], $id);
					if ($User_Delete) {
						echo 'Üye Başarıyla Silindi, Lütfen Bekleyiniz!';
					} else{
						echo 'Üye Silinirken Bir Hata Oluştu!';
					}
				} else{
					echo 'Üye Bulunamadı!';
				}
			} else{
				echo 'Gerekli Alanları Doldurunuz!';
			}
		}
	}

	public function Admin_Create_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$username = Gauntlet::filter($_REQUEST['username']);
			$password = Gauntlet::filter($_REQUEST['password']);
			if (isset($username) && isset($password) && !empty($username) && !empty($password)) {
				if ($this->model('admin')->GetAdminByUsername($username)) {
					echo alert('Hata!', 'Bu Bilgilere Sahip Bir Admin Bulunuyor!', 'warning', 0, "mdi mdi-alert");
				} else{
					$Admin_Data	= $this->model('admin')->CreateAdmin($_SESSION['admin_username'], $username, $password);
					if ($Admin_Data) {
						echo alert('', 'Admin Başarıyla Oluşturuldu, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
						refresh(SITE_URL.'/admin/admins', 3);
					} else{
						echo alert('Hata!', 'Admin Oluşturulurken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
					}
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function Admin_Edit_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id			= Gauntlet::filter($_REQUEST['id']);
			$username	= Gauntlet::filter($_REQUEST['username']);
			$password	= Gauntlet::filter($_REQUEST['password']);
			if (isset($id) && isset($username) && !empty($id) && !empty($username)) {
				$Admin_Control	= $this->model('admin')->GetAdminX($_SESSION['admin_username'], $id);
				if ($Admin_Control) {
					if (isset($password) && !empty($password)) {
						$Edit_Admin = $this->model('admin')->EditAdmin($_SESSION['admin_username'], $id, $username, $password);							
					} else{
						$Edit_Admin = $this->model('admin')->EditAdmin($_SESSION['admin_username'], $id, $username, $Admin_Control['password']);
					}
					if ($Edit_Admin) {
						echo alert('', 'Admin Başarıyla Düzenlendi, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
						refresh(SITE_URL.'/admin/admins', 3);
					} else{
						echo alert('Hata!', 'Admin Düzenlenirken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
					}
				} else{
					echo alert('Hata!', 'Admin Bulunamadı!', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function Admin_Delete_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id	= Gauntlet::filter($_REQUEST['id']);
			if (isset($id) && !empty($id)) {
				$Admin_Control	= $this->model('admin')->GetAdminX($_SESSION['admin_username'], $id);
				if ($Admin_Control) {
					$Admin_Delete	= $this->model('admin')->DeleteAdmin($_SESSION['admin_username'], $id);
					if ($Admin_Delete) {
						echo 'Admin Başarıyla Silindi, Lütfen Bekleyiniz!';
					} else{
						echo 'Admin Silinirken Bir Hata Oluştu!';
					}
				} else{
					echo 'Admin Bulunamadı!';
				}
			} else{
				echo 'Gerekli Alanları Doldurunuz!';
			}
		}
	}

	public function DNS_Delete_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id	= Gauntlet::filter($_REQUEST['id']);
			if (isset($id) && !empty($id)) {
				$DNS_Data = $this->model('dns')->GetDNSByID($id);					
				if ($DNS_Data) {
					$Dns_Configs = $this->model('config')->DNSCONFIG();
					foreach ($Dns_Configs as $Dns_Config){
						$dns_config['mail']		= $Dns_Config['mail'];
						$dns_config['apikey']	= $Dns_Config['apikey'];
					}
					$Mirarus_Dns	= new mirarus_dns($dns_config['mail'],$dns_config['apikey']);
					$Mirarus_Dns_identifier	= $Mirarus_Dns->identifier($DNS_Data['domain']);
					$DNS_Delete	= $this->model('dns')->DeleteDNSAdmin($_SESSION['admin_username'], $id);
					$Mirarus_Dns_SRV_Record_ID_F	= $Mirarus_Dns->get_dns_record_id_srv($Mirarus_Dns_identifier, '_ts3._udp.'.$DNS_Data['dns']);
					$Mirarus_Dns_SRV_Record_DELETE	= $Mirarus_Dns->delete_dns_record($Mirarus_Dns_identifier, $Mirarus_Dns_SRV_Record_ID_F);
					$Mirarus_Dns_A_Record_ID_F		= $Mirarus_Dns->get_dns_record_id_a($Mirarus_Dns_identifier, $DNS_Data['dns']);
					$Mirarus_Dns_A_Record_DELETE	= $Mirarus_Dns->delete_dns_record($Mirarus_Dns_identifier, $Mirarus_Dns_A_Record_ID_F);
					if ($DNS_Delete && $Mirarus_Dns_SRV_Record_DELETE && $Mirarus_Dns_SRV_Record_DELETE->success == 1 && $Mirarus_Dns_A_Record_DELETE && $Mirarus_Dns_A_Record_DELETE->success == 1) {
						echo 'DNS Başarıyla Silindi, Lütfen Bekleyiniz!';
					} else{
						echo 'DNS Silinirken Bir Hata Oluştu!';
					}
				} else{
					echo 'Bu Bilgilere Sahip Bir DNS Kaydı Bulunmuyor!';
				}
			} else{
				echo 'Gerekli Alanları Doldurunuz!';
			}
		}
	}

	public function Support_Close_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id	= Gauntlet::filter($_REQUEST['id']);
			if (isset($id) && !empty($id)) {
				$Support_Close	= $this->model('support')->UpdateSupportStatusAdmin($_SESSION['admin_username'], $id, 4);
				if ($Support_Close) {
					echo 'Destek Talebi Başarıyla Kapatıldı';
				} else{
					echo 'Destek Talebi Oluşturulurken Bir Hata Oluştu!';
				}
			} else{
				echo 'Gerekli Alanları Doldurunuz!';
			}
		}
	}

	public function Support_Replies_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/admin/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$content	= Gauntlet::filter($_REQUEST['content']);
			$id			= Gauntlet::filter($_REQUEST['id']);
			if (isset($id) & isset($content) && !empty($content) && !empty($id)) {
				$Support_Replies	= $this->model('support')->RepliesSupportAdmin($_SESSION['admin_username'], $id, $content, 2);
				if ($Support_Replies) {
					echo alert('', 'Destek Mesajı Gönderildi, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
					refresh(SITE_URL.'/admin/support/'.$id, 3);
				} else{
					echo alert('Hata!', 'Destek Mesajı Gönderilirken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
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