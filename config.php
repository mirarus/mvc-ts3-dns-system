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

############ TIMEZONE CONFIG DEGIN ############
date_default_timezone_set('Europe/Istanbul');
############ TIMEZONE CONFIG END ############

############ DIR CONFIG DEGIN ############
define('ROOT_DIR', __DIR__); // Değiştirmeyin!
define('APP_DIR', ROOT_DIR.'/app'); // Değiştirmeyin!
define('CORE_DIR', ROOT_DIR.'/core'); // Değiştirmeyin!
define('CLASS_DIR', APP_DIR.'/class'); // Değiştirmeyin!
define('CDIR', APP_DIR.'/controllers'); // Değiştirmeyin!
define('MDIR', APP_DIR.'/models'); // Değiştirmeyin!
define('VDIR', APP_DIR.'/views'); // Değiştirmeyin!
define('HDIR', APP_DIR.'/helpers'); // Değiştirmeyin!
define('VMDIR', APP_DIR.'/views/Main'); // Değiştirmeyin!
define('VADIR', APP_DIR.'/views/Admin'); // Değiştirmeyin!
define('VEDIR', APP_DIR.'/views/Error'); // Değiştirmeyin!
define('VMADIR', SITE_URL.'/app/views/Main/Template'); // Değiştirmeyin!
define('VAADIR', SITE_URL.'/app/views/Admin/Template'); // Değiştirmeyin!
define('VEADIR', SITE_URL.'/app/views/Error/Assets'); // Değiştirmeyin!
############ DIR CONFIG END ############

############ HELPER CONFIG BEGIN ############
$helper_config = array('general_helper'); // Değiştirmeyin!
############ HELPER CONFIG END ############

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>