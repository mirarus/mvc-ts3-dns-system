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

class controller
{

	public function Mainrender($file, array $params = [])
	{
		return view::Mainrender($file, $params);
	}

	public function Adminrender($file, array $params = [])
	{
		return view::Adminrender($file, $params);
	}

	public static function model($model)
	{
		if (file_exists($file = MDIR."/{$model}.php")) {
			require_once $file;

			if (class_exists($model)) {
				return new $model;
			} else{
				exit("Model dosyasında sınıf tanımlı değil: $model");
			}
		} else{
			exit("Model dosyası bulunamadı: {$model}.php");
		}
	}

	public static function helper(array $helper)
	{
		foreach ($helper as $hf) {
			if (file_exists($file = HDIR."/{$hf}.php")) {
				require_once $file;
			} else{
				exit("Helper dosyası bulunamadı: {$hf}.php");
			}
		}
	}
}

?>