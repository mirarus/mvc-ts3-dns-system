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

class user extends model
{

	public function GetUserByID($id)
	{
		return $this->fetch("SELECT * FROM users WHERE id=?", [$id]);
	}

	public function GetUserByMail($mail)
	{
		return $this->fetch("SELECT * FROM users WHERE mail=?", [$mail]);
	}

	public function SelectUser($mail, $password)
	{
		return $this->fetch("SELECT * FROM users WHERE mail=? AND password=?", [$mail, $password]);
	}

	public function CreateUser($mail, $password)
	{
		return $this->query('INSERT INTO users (mail, password, time) VALUES (?, ?, ?)', [$mail, password_hash(md5($password), PASSWORD_DEFAULT, ['cost' => 12]), time()]);
	}

	public function GetUserByIDS($id)
	{
		return $this->fetchAll("SELECT * FROM users WHERE id=?", [$id]);
	}

	public function UpdateIP($mail)
	{
		$User_Data = $this->GetUserByMail($mail);
		if ($User_Data) {
			return $this->query('UPDATE users SET login_ip=? WHERE id=?', [GetIP(), $User_Data['id']]);
		}
	}

	public function UpdatePassword($mail, $password)
	{
		$User_Data = $this->GetUserByMail($mail);
		if ($User_Data) {
			return $this->query('UPDATE users SET password=? WHERE id=?', [password_hash(md5($password), PASSWORD_DEFAULT, ['cost' => 12]), $User_Data['id']]);
		}
	}

	public function CountUserAdmin($username)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			$Count = $this->fetch("SELECT COUNT(*) FROM users");
			return $Count['COUNT(*)'];
		}
	}

	public function GetUserAdmin($username)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetchAll("SELECT * FROM users ORDER BY id");
		}
	}

	public function GetUserAdminX($username, $id)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetch("SELECT * FROM users WHERE id=?", [$id]);
		}
	}

	public function EditUserAdmin($username, $id, $mail, $password)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('UPDATE users SET mail=?, password=? WHERE id=?', [$mail, password_hash(md5($password), PASSWORD_DEFAULT, ['cost' => 12]), $id]);
		}
	}

	public function DeleteUserAdmin($username, $id)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('DELETE FROM users WHERE id=?', [$id]);
		}
	}
}

?>