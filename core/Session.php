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
	
class Session
{
	
	public static function exists($name)
	{
		return (isset($_SESSION[$name])) ? true : false;
	}

	public static function get($name)
	{
		return @$_SESSION[$name];
	}

	public static function set($name, $value)
	{
		return $_SESSION[$name] = $value;
	}

	public static function delete($name)
	{
		if (self::exists($name)) {
			unset($_SESSION[$name]);
		}
	}

	public static function setA(array $array)
	{
		if (!empty($array) && is_array($array)) {
			foreach ($array as $name => $value) {
				return $_SESSION[$name] = $value;
			}
		}
	}

	public static function uagent_no_version()
	{
		$uagent = $_SERVER['HTTP_USER_AGENT'];
		$regx = '/\/[a-zA-Z0-9.]+/';
		$newString = preg_replace($regx, '', $uagent);
		return $newString;
	}
}

?>