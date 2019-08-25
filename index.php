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

/* Site Config */
require_once 'core/config.php';

if (!isset($SITE_URL)) {
	header("Location: install/index.php");
	exit();
}
if (!isset($SITE_URL) && $_GET['url'] == 'install/') {
	require 'install/index.php';
	exit();
}
/* Site Config */

session_start();

require_once 'config.php';
require CORE_DIR.'/app.php';
require CORE_DIR.'/model.php';
require CORE_DIR.'/view.php';
require CORE_DIR.'/controller.php';
require CORE_DIR.'/Session.php';
require CLASS_DIR.'/Gauntlet.php';
require CLASS_DIR.'/FilterClass.php';
require CLASS_DIR.'/mirarus_dns.php';

$Session = new Session();
$Gauntlet = new Gauntlet();

controller::helper($helper_config);

$routes = [
	################################################################################
	''									=> 'Main_Controller:index_Action',
	'main_page'							=> 'Main_Controller:index_Action',
	'login'								=> 'User_Controller:Login_index_Action',
	'signup'							=> 'User_Controller:Signup_index_Action',
	'logout'							=> 'User_Controller:logout_Action',
	'dns'								=> 'DNS_Controller:index_Action',
	'dns/create'						=> 'DNS_Controller:Create_index_Action',
	'support'							=> 'Support_Controller:index_Action',
	'support/create'					=> 'Support_Controller:Create_index_Action',
	'support/:param'					=> 'Support_Controller:View_index_Action',
	########################################
	'admin'								=> 'Admin_Controller:index_Action',
	'admin/main_page'					=> 'Admin_Controller:index_Action',
	'admin/login'						=> 'Admin_User_Controller:Login_index_Action',
	'admin/logout'						=> 'Admin_User_Controller:logout_Action',
	'admin/site_settings'				=> 'Admin_Site_Controller:Config_index_Action',
	'admin/dns_settings'				=> 'Admin_DNS_Controller:Config_index_Action',
	'admin/users'						=> 'Admin_User_Controller:User_index_Action',
	'admin/user/create'					=> 'Admin_User_Controller:User_Create_index_Action',
	'admin/user/:param'					=> 'Admin_User_Controller:User_Edit_İndex_Action',
	'admin/admins'						=> 'Admin_User_Controller:Admin_index_Action',
	'admin/admin/create'				=> 'Admin_User_Controller:Admin_Create_index_Action',
	'admin/admin/:param'				=> 'Admin_User_Controller:Admin_Edit_İndex_Action',
	'admin/dns'							=> 'Admin_DNS_Controller:index_Action',
	'admin/support'						=> 'Admin_Support_Controller:index_Action',
	'admin/support/:param'				=> 'Admin_Support_Controller:View_index_Action',
	########################################
	'operation/login'					=> 'Operation_Controller:Login_Action',
	'operation/signup'					=> 'Operation_Controller:Signup_Action',
	'operation/user_password'			=> 'Operation_Controller:User_Password_Action',
	'operation/dns_create'				=> 'Operation_Controller:DNS_Create_Action',
	'operation/dns_delete'				=> 'Operation_Controller:DNS_Delete_Action',
	'operation/support_create'			=> 'Operation_Controller:Support_Create_Action',
	'operation/support_close'			=> 'Operation_Controller:Support_Close_Action',
	'operation/support_replies'			=> 'Operation_Controller:Support_Replies_Action',
	'operation/admin/login'				=> 'Admin_Operation_Controller:Login_Action',
	'operation/admin/user_password'		=> 'Admin_Operation_Controller:User_Password_Action',
	'operation/admin/site_settings'		=> 'Admin_Operation_Controller:Site_Settings_Action',
	'operation/admin/dns_settings'		=> 'Admin_Operation_Controller:DNS_Settings_Action',
	'operation/admin/user_create'		=> 'Admin_Operation_Controller:User_Create_Action',
	'operation/admin/user_edit'			=> 'Admin_Operation_Controller:User_Edit_Action',
	'operation/admin/user_delete'		=> 'Admin_Operation_Controller:User_Delete_Action',
	'operation/admin/admin_create'		=> 'Admin_Operation_Controller:Admin_Create_Action',
	'operation/admin/admin_edit'		=> 'Admin_Operation_Controller:Admin_Edit_Action',
	'operation/admin/admin_delete'		=> 'Admin_Operation_Controller:Admin_Delete_Action',
	'operation/admin/dns_delete'		=> 'Admin_Operation_Controller:DNS_Delete_Action',
	'operation/admin/support_close'		=> 'Admin_Operation_Controller:Support_Close_Action',
	'operation/admin/support_replies'	=> 'Admin_Operation_Controller:Support_Replies_Action',
	################################################################################
];

$app = new app($routes);
$app->run();

?>