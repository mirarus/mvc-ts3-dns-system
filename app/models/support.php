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

class support extends model
{

	public function GetSupportByID($mail, $id)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->fetch("SELECT * FROM supports WHERE id=?", [$id]);
		}
	}

	public function GetSupportByUMAIL($mail)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->fetchAll("SELECT * FROM supports WHERE u_id=?", [$User_Data['id']]);
		}
	}

	public function GetSupportByUSER($mail, $id)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->fetchAll("SELECT * FROM supports WHERE id=? AND u_id=?", [$id, $User_Data['id']]);
		}
	}

	public function GetSupportRepliesByUSER($mail, $id)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->fetchAll("SELECT * FROM support_replies WHERE t_id=?", [$id]);
		}
	}

	public function CreateSupport($mail, $title, $content, $status)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			$Support_Create_One = $this->query('INSERT INTO supports (u_id, title, status, time) VALUES (?, ?, ?, ?)', [$User_Data['id'], $title, $status, time()]);
			$t_id = $this->lastInsertId();
			$Support_Create_Two = $this->query('INSERT INTO support_replies (u_id, t_id, content, time) VALUES (?, ?, ?, ?)', [$User_Data['id'], $t_id, $content, time()]);
			if ($Support_Create_One && $Support_Create_Two) {
				return true;
			} else{
				return false;
			}
		}
	}

	public function RepliesSupport($mail, $id, $content, $status)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			$Support_Create_Replies = $this->query('INSERT INTO support_replies (u_id, t_id, content, time) VALUES (?, ?, ?, ?)', [$User_Data['id'], $id, $content, time()]);
			$Support_Update_One = $this->query('UPDATE supports SET status=? WHERE id=?', [$status, $id]);
			if ($Support_Create_Replies && $Support_Update_One) {
				return true;
			} else{
				return false;
			}
		}
	}

	public function UpdateSupportStatus($mail, $id, $status)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->query('UPDATE supports SET status=? WHERE id=? AND u_id=?', [$status, $id, $User_Data['id']]);
		}
	}

	public function DeleteSupport($mail, $id)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			$Support_Delete_One = $this->query('DELETE FROM supports WHERE id=? AND u_id=?', [$id, $User_Data['id']]);
			$Support_Delete_Two = $this->query('DELETE FROM support_replies WHERE t_id=? AND u_id=?', [$id, $User_Data['id']]);
			if ($Support_Delete_One && $Support_Delete_Two) {
				return true;
			} else{
				return false;
			}
		}
	}

	public function CountSupport($mail)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			$Count = $this->fetch("SELECT COUNT(*) FROM supports WHERE u_id=?", [$User_Data['id']]);
			return $Count['COUNT(*)'];
		}
	}

	public function CountSupportAdmin($username)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			$Count = $this->fetch("SELECT COUNT(*) FROM supports");
			return $Count['COUNT(*)'];
		}
	}

	public function GetSupportAdmin($username)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetchAll("SELECT * FROM supports");
		}
	}

	public function GetSupportAdminX($username, $id)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetchAll("SELECT * FROM supports WHERE id=?", [$id]);
		}
	}

	public function GetSupportByIDAdmin($username, $id)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetch("SELECT * FROM supports WHERE id=?", [$id]);
		}
	}

	public function GetSupportRepliesByUSERAdmin($username, $id)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetchAll("SELECT * FROM support_replies WHERE t_id=?", [$id]);
		}
	}

	public function RepliesSupportAdmin($username, $id, $content, $status)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			$Support_Create_Replies = $this->query('INSERT INTO support_replies (u_id, admin, t_id, content, time) VALUES (?, ?, ?, ?, ?)', [$Admin_Data['id'], 1, $id, $content, time()]);
			$Support_Update_One = $this->query('UPDATE supports SET status=? WHERE id=?', [$status, $id]);
			if ($Support_Create_Replies && $Support_Update_One) {
				return true;
			} else{
				return false;
			}
		}
	}

	public function UpdateSupportStatusAdmin($username, $id, $status)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('UPDATE supports SET status=? WHERE id=?', [$status, $id]);
		}
	}
}

?>