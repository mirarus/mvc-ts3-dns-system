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

if (!function_exists('url')) {
	function url()
	{
		return SITE_URL.'/?url='.implode('/', func_get_args());
	}
}

if (!function_exists('redirect')) {
	function redirect($par, $time=0)
	{
		if ($time == 0) {
			header("Location: {$par}");
		} else{
			header("Refresh: {$time}; url={$par}");
		}
	}
}

if (!function_exists('refresh')) {
	function refresh($par, $time=0)
	{
		if($time == 0){
			echo "<meta http-equiv='refresh' content='URL={$par}'>";
		} else{
			echo "<meta http-equiv='refresh' content='{$time};URL={$par}'>";
		}
	}
}

if (!function_exists('alert')) {
	function alert($title, $content, $style, $close_btn, $icon)
	{
		if ($close_btn == 1) {
			if ($icon) {
				$alert = '<div class="alert icon-custom-alert alert-outline-'.$style.' alert-'.$style.'-shadow  alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close"></i></span></button> <i class="'.$icon.' alert-icon"></i><div class="alert-text"><strong>'.$title.'</strong> '.$content.'</div></div>';
			} else{
				$alert = '<div class="alert alert-outline-'.$style.' alert-'.$style.'-shadow alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="mdi mdi-close"></i></span></button> <strong>'.$title.'</strong> '.$content.'</div>';
			}
		} else{
			if ($icon) {
				$alert = '<div class="alert alert-fill-'.$style.'" role="alert"><i class="'.$icon.'"></i><strong>'.$title.'</strong> '.$content.'</div>';
			} else{
				$alert = '<div class="alert alert-fill-'.$style.'" role="alert"><strong>'.$title.'</strong> '.$content.'</div>';
			}
		}
		return $alert;
	}
}

if (!function_exists('admin_alert')) {
	function admin_alert($title, $content, $style, $close_btn, $icon)
	{
		if ($close_btn == 1) {
			if ($icon) {
				$alert = '<div class="alert alert-'.$style.' alert-dismissible fade show" role="alert"><i class="'.$icon.' alert-icon"></i><strong>'.$title.'</strong> '.$content.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
			} else{
				$alert = '<div class="alert alert-'.$style.' alert-dismissible fade show" role="alert"><strong>'.$title.'</strong> '.$content.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button></div>';
			}
		} else{
			if ($icon) {
				$alert = '<div class="alert alert-'.$style.' alert-dismissible fade show" role="alert"><i class="'.$icon.' alert-icon"></i><strong>'.$title.'</strong> '.$content.'</div>';
			} else{
				$alert = '<div class="alert alert-'.$style.' alert-dismissible fade show" role="alert"><strong>'.$title.'</strong> '.$content.'</div>';
			}
		}
		return $alert;
	}
}

if (!function_exists('GetIP')) {
	function GetIP()
	{
		if(getenv("HTTP_CLIENT_IP")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			if (strstr($ip, ',')) {
				$tmp = explode (',', $ip);
				$ip = trim($tmp[0]);
			}
		} else {
			$ip = getenv("REMOTE_ADDR");
		}
		return $ip;
	}
}

if (!function_exists('MainPageRedirect')) {
	function MainPageRedirect($PType)
	{
		if ($PType == 'main') {
			if ($_GET['url'] == '') {
				redirect(SITE_URL.'/main_page');
			} elseif ($_GET['url'] == '/') {
				redirect(SITE_URL.'/main_page');
			}
		} elseif ($PType == 'admin') {
			if ($_GET['url'] == 'admin') {
				redirect(SITE_URL.'/admin/main_page');
			} elseif ($_GET['url'] == 'admin/') {
				redirect(SITE_URL.'/admin/main_page');
			}
		}
	}
}

if (!function_exists('valid_email')) {
	function valid_email($email)
	{
		return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
	}
}

if (!function_exists('valid_ip_adress')) {
	function valid_ip_adress($ip_adress)
	{
		return (bool) filter_var($ip_adress, FILTER_VALIDATE_IP);
	}
}

?>