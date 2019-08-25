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

class Operation_Controller extends controller
{

	public function Login_Action()
	{
		$this->LoginAccessX();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {		
			$mail = Gauntlet::filter($_REQUEST['mail']);
			$password = Gauntlet::filter($_REQUEST['password']);
			if (isset($mail) && isset($password) && !empty($mail) && !empty($password)) {
				if (valid_email($mail) == true) {
					$User_Data	= $this->model('user')->GetUserByMail($mail);
					if ($User_Data) {
						if (password_verify(md5($_REQUEST['password']), $User_Data['password']) == true) {
							$this->model('user')->UpdateIP($User_Data['mail']);
							Session::set('_login_', 'true');
							Session::set('user_mail', $User_Data['mail']);
							echo alert('', 'Bilgileriniz Doğru, Yönlendiriliyorsunuz!', 'success', 0, "mdi mdi-check-all");
							refresh(SITE_URL.'/main_page', 2);
						} else{
							echo alert('Hata!', 'Bu Bilgilere Sahip Bir Üye Yok!', 'warning', 0, "mdi mdi-alert");
						}
					} else{
						echo alert('Hata!', 'Bu Bilgilere Sahip Bir Üye Yok!', 'warning', 0, "mdi mdi-alert");
					}
				} else{
					echo alert('Hata!', 'Geçersiz Mail Adresi Girdiniz!', 'danger', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function Signup_Action()
	{
		$this->LoginAccessX();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/main_page');
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
							$this->model('user')->UpdateIP($User_Data['mail']);
							Session::set('_login_', 'true');
							Session::set('user_mail', $User_Data['mail']);
							echo alert('', 'Kayıt İşlemi Başarılı!', 'success', 0, "mdi mdi-check-all");
							echo alert('', 'Hesabınıza Giriş Yapılıyor, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
							refresh(SITE_URL.'/main_page', 3);
						} else{
							echo alert('Hata!', 'Hesap Oluşturulurken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
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

	public function User_Password_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$password	= Gauntlet::filter($_REQUEST['password']);
			if (isset($password) && !empty($password)) {
				$Update_Password	= $this->model('user')->UpdatePassword($_SESSION['user_mail'], $password);
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

	public function DNS_Create_Action()
	{
		$this->LoginAccess();
		$this->model('user')->UpdateIP($_SESSION['user_mail']);
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$name	= Gauntlet::filter($_REQUEST['name']);
			$domain	= Gauntlet::filter($_REQUEST['domain']);
			$ip		= Gauntlet::filter($_REQUEST['ip']);
			$port	= Gauntlet::filter($_REQUEST['port']);
			$dns		= (strtolower($name).'.'.$domain);
			if (isset($name) && isset($domain) && isset($ip) && isset($port) && !empty($name) && !empty($domain) && !empty($ip) && !empty($port)) {
				if (preg_match("/^[a-zA-Z0-9]*$/",$name)) {
					if ($name != "ftp" || $name != "www" || $name != "A" || $name != "a" || $name != "w" || $name != "W" || $name != "ts3" || $name != "TS3") {
						if (valid_ip_adress($ip) == true) {
							$Dns_Configs = $this->model('config')->DNSCONFIG();
							foreach ($Dns_Configs as $Dns_Config){
								$dns_config['mail']		= $Dns_Config['mail'];
								$dns_config['apikey']	= $Dns_Config['apikey'];
							}
							$Mirarus_Dns	= new mirarus_dns($dns_config['mail'],$dns_config['apikey']);
							$Mirarus_Dns_identifier	= $Mirarus_Dns->identifier($domain);
							$Mirarus_Dns_A_Record_ID_F		= $Mirarus_Dns->get_dns_record_id_a($Mirarus_Dns_identifier, $dns);
							$Mirarus_Dns_SRV_Record_ID_F	= $Mirarus_Dns->get_dns_record_id_srv($Mirarus_Dns_identifier, '_ts3._udp.'.$dns);
							if ($this->model('dns')->GetDNSByDNS($dns) && $Mirarus_Dns_A_Record_ID_F && $Mirarus_Dns_SRV_Record_ID_F) {
								echo alert('Hata!', 'Bu Bilgilere Sahip Bir DNS Kaydı Bulunuyor!', 'warning', 0, "mdi mdi-alert");
							} else{
								$Mirarus_Dns_A_Record	= $Mirarus_Dns->create_a_record($Mirarus_Dns_identifier,$name,$ip);
								$Mirarus_Dns_SRV_Record	= $Mirarus_Dns->create_srv_record($Mirarus_Dns_identifier,$name,$port,$domain);
								if ($Mirarus_Dns_A_Record && $Mirarus_Dns_SRV_Record) {
									$DNS_Create	= $this->model('dns')->CreateDNS($_SESSION['user_mail'], $dns, $name, $domain, $ip, $port);
									if ($DNS_Create) {
										echo alert('', 'DNS Başarıyla Oluşturuldu, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
										refresh(SITE_URL.'/dns', 3);
									} else{
										echo alert('Hata!', 'DNS Oluşturulurken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
									}
								} else{
									echo alert('Hata!', 'DNS Oluşturulurken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
								}
							}
						} else{
							echo alert('Hata!', 'Geçersiz Ip Adresi Girdiniz!', 'warning', 0, "mdi mdi-alert");
						}
					} else{
						echo alert('Hata!', 'Bu Dns Adı Kullanılamaz, Lütfen Farklı Bir Dns Adı Deneyin.', 'warning', 0, "mdi mdi-alert");
					}
				} else{
					echo alert('Hata!', 'Lütfen Özel veya Türkçe Karakter Girmeyiniz.', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function DNS_Delete_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/main_page');
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
					$DNS_Delete	= $this->model('dns')->DeleteDNS($_SESSION['user_mail'], $id);
					$Mirarus_Dns_SRV_Record_ID_F	= $Mirarus_Dns->get_dns_record_id_srv($Mirarus_Dns_identifier, '_ts3._udp.'.$DNS_Data['dns']);
					$Mirarus_Dns_SRV_Record_DELETE	= $Mirarus_Dns->delete_dns_record($Mirarus_Dns_identifier, $Mirarus_Dns_SRV_Record_ID_F);
					$Mirarus_Dns_A_Record_ID_F		= $Mirarus_Dns->get_dns_record_id_a($Mirarus_Dns_identifier, $DNS_Data['dns']);
					$Mirarus_Dns_A_Record_DELETE	= $Mirarus_Dns->delete_dns_record($Mirarus_Dns_identifier, $Mirarus_Dns_A_Record_ID_F);
					if ($DNS_Delete && $Mirarus_Dns_SRV_Record_DELETE && $Mirarus_Dns_SRV_Record_DELETE->success == 1 && $Mirarus_Dns_A_Record_DELETE && $Mirarus_Dns_A_Record_DELETE->success == 1) {
						echo 'DNS Başarıyla Silindi, Lütfen Bekleyiniz!';
						refresh(SITE_URL.'/dns', 3);
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

	public function Support_Create_Action()
	{
		$this->LoginAccess();
		$this->model('user')->UpdateIP($_SESSION['user_mail']);
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$title		= Gauntlet::filter($_REQUEST['title']);
			$content	= Gauntlet::filter($_REQUEST['content']);
			if (isset($title) && isset($content) && !empty($title) && !empty($content)) {
				$Support_Create	= $this->model('support')->CreateSupport($_SESSION['user_mail'], $title, $content, 1);
				if ($Support_Create) {
					echo alert('', 'Destek Talebi Başarıyla Oluşturuldu, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
					refresh(SITE_URL.'/support', 3);
				} else{
					echo alert('Hata!', 'Destek Talebi Oluşturulurken Bir Hata Oluştu!', 'warning', 0, "mdi mdi-alert");
				}
			} else{
				echo alert('Hata!', 'Gerekli Alanları Doldurunuz!', 'warning', 0, "mdi mdi-alert");
			}
		}
	}

	public function Support_Close_Action()
	{
		$this->LoginAccess();
		$_REQUEST = FilterClass::filterXSS($_REQUEST);
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			redirect(SITE_URL.'/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$id	= Gauntlet::filter($_REQUEST['id']);
			if (isset($id) && !empty($id)) {
				$Support_Close	= $this->model('support')->UpdateSupportStatus($_SESSION['user_mail'], $id, 4);
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
			redirect(SITE_URL.'/main_page');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$content	= Gauntlet::filter($_REQUEST['content']);
			$id			= Gauntlet::filter($_REQUEST['id']);
			if (isset($id) & isset($content) && !empty($content) && !empty($id)) {
				$Support_Replies	= $this->model('support')->RepliesSupport($_SESSION['user_mail'], $id, $content, 3);
				if ($Support_Replies) {
					echo alert('', 'Destek Mesajı Gönderildi, Lütfen Bekleyiniz!', 'success', 0, "mdi mdi-check-all");
					refresh(SITE_URL.'/support/'.$id, 3);
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
		if (empty($_SESSION['_login_']) || empty($_SESSION['user_mail']) || empty($User_Data['mail'])) {
			redirect(SITE_URL.'/login');
		}
	}
}

?>