<?php

/**
* Callbacks class
*/
class Callbacks extends Callbacks_Core
{

	function is_installed($params = array())
	{
		$current_version = '1.0';
		if (is_file(BASE_PATH . '../core/config.php')) {
			include_once '../core/config.php';
			if (isset($BaseURL)) {
				$this->error = 'Sistem zaten kurulu gibi görünüyor.';
				return true;
			}
		} elseif (SITE_VERSION <= $current_version) {
			$this->error = 'Zaten uygulamanın en son sürümünü kullanıyorsunuz.';
			return true;
		}
		return true;
	}

	function install($params = array())
	{
		$dbconf = array(
			'db_host' => $_SESSION['params']['db_hostname'],
			'db_name' => $_SESSION['params']['db_name'],
			'db_user' => $_SESSION['params']['db_username'],
			'db_pass' => $_SESSION['params']['db_password'],
			'db_encoding' => 'utf8'
		);
		if (!$this->db_init($dbconf)) {
			return false;
		}
		$replace     = array(
			'{:db_prefix}' => 'my_',
			'{:db_engine}' => in_array('innodb', $this->db_engines) ? 'InnoDB' : 'MyISAM',
			'{:db_charset}' => $this->db_version >= '4.1' ? 'DEFAULT CHARSET=utf8' : '',
			'{:website}' => $_SESSION['params']['virtual_path']
		);
		$tpl         = file_get_contents('includes/configfile.tpl');
		$search      = array(
			'<%dbhost%>',
			'<%dbdatabase%>',
			'<%dbuser%>',
			'<%dbpass%>',
			'<%baseurl%>',
			'<%sitename%>'
		);
		$replace     = array(
			addslashes($_SESSION['params']['db_hostname']),
			addslashes($_SESSION['params']['db_name']),
			addslashes($_SESSION['params']['db_username']),
			addslashes($_SESSION['params']['db_password']),
			addslashes($_SESSION['params']['virtual_path']),
			addslashes($_SESSION['params']['website_name'])
		);
		$config_file = str_replace($search, $replace, $tpl);
		file_put_contents(rtrim($_SESSION['params']['system_path'], '/') . '/core/config.php', $config_file);
		$sql    = file_get_contents('sql/database.sql');
		if ($this->db_import_sql($sql)) {
			return true;
			$this->db_close();
		} else {
			return false;
			$this->db_close();
		}
		unlink('sql/' . $filename . '.sql');
	}

	function setup_admin($params = array())
	{
		$dbconf = array(
			'db_host' => $_SESSION['params']['db_hostname'],
			'db_name' => $_SESSION['params']['db_name'],
			'db_user' => $_SESSION['params']['db_username'],
			'db_pass' => $_SESSION['params']['db_password'],
			'db_encoding' => 'utf8',
		);
		if ( !($db = $this->db_init($dbconf)) ) {
			return false;
		}

		$admin_create = $this->db_query("INSERT INTO admins (username, password, time) VALUES('".$this->db_escape($_SESSION['params']['username'])."', '".password_hash(md5($this->db_escape($_SESSION['params']['user_password'])), PASSWORD_DEFAULT, ['cost' => 12])."', '".time()."')");

		$this->db_close();
		if ($admin_create) {
			return true;
		} else {
			return false;
		}
	}

}