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

class admin extends model
{

	public function GetAdminByID($id)
	{
		return $this->fetch("SELECT * FROM admins WHERE id=?", [$id]);
	}

	public function GetAdminByUsername($username)
	{
		return $this->fetch("SELECT * FROM admins WHERE username=?", [$username]);
	}

	public function CountAdmin($username)
	{
		$Admin_Data = $this->GetAdminByUsername($username);
		if ($Admin_Data) {
			$Count = $this->fetch("SELECT COUNT(*) FROM admins");
			return $Count['COUNT(*)'];
		}
	}

	public function SelectAdmin($username, $password)
	{
		return $this->fetch("SELECT * FROM admins WHERE username=? AND password=?", [$username, $password]);
	}

	public function CreateAdmin($username, $usernamex, $password)
	{
		$Admin_Data = $this->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('INSERT INTO admins (username, password, time) VALUES (?, ?, ?)', [$usernamex, password_hash(md5($password), PASSWORD_DEFAULT, ['cost' => 12]), time()]);
		}
	}

	public function GetAdmin($username)
	{
		$Admin_Data = $this->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetchAll("SELECT * FROM admins ORDER BY id");
		}
	}

	public function GetAdminX($username, $id)
	{
		$Admin_Data = $this->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetch("SELECT * FROM admins WHERE id=?", [$id]);
		}
	}

	public function UpdatePassword($username, $password)
	{
		$Admin_Data = $this->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('UPDATE admins SET password=? WHERE id=?', [password_hash(md5($password), PASSWORD_DEFAULT, ['cost' => 12]), $Admin_Data['id']]);
		}
	}

	public function EditAdmin($username, $id, $usernamex, $password)
	{
		$Admin_Data = $this->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('UPDATE admins SET username=?, password=? WHERE id=?', [$usernamex, password_hash(md5($password), PASSWORD_DEFAULT, ['cost' => 12]), $id]);
		}
	}

	public function DeleteAdmin($username, $id)
	{
		$Admin_Data = $this->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('DELETE FROM admins WHERE id=?', [$id]);
		}
	}
}

?>