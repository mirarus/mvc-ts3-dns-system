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

class dns extends model
{

	public function GetDNSByID($id)
	{
		return $this->fetch("SELECT * FROM dns WHERE id=?", [$id]);
	}

	public function GetDNSByDNS($dns)
	{
		return $this->fetch("SELECT * FROM dns WHERE dns=?", [$dns]);
	}

	public function GetDNSByUMAIL($mail)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->fetchAll("SELECT * FROM dns WHERE u_id=?", [$User_Data['id']]);
		}
	}

	public function GetDNSByUSER($mail, $id)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->fetch("SELECT * FROM dns WHERE id=? AND u_id=?", [$id, $User_Data['id']]);
		}
	}

	public function GetDNSByUSERAll($mail, $id)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->fetchAll("SELECT * FROM dns WHERE id=? AND u_id=?", [$id, $User_Data['id']]);
		}
	}

	public function CreateDNS($mail, $dns, $name, $domain, $ip, $port)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->query('INSERT INTO dns (u_id, dns, name, domain, ip, port, time) VALUES (?, ?, ?, ?, ?, ?, ?)', [$User_Data['id'], $dns, $name, $domain, $ip, $port, time()]);
		}
	}

	public function DeleteDNS($mail, $id)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			return $this->query('DELETE FROM dns WHERE id=? AND u_id=?', [$id, $User_Data['id']]);
		}
	}

	public function CountDNS($mail)
	{
		$User_Data = controller::model('user')->GetUserByMail($mail);
		if ($User_Data) {
			$Count = $this->fetch("SELECT COUNT(*) FROM dns WHERE u_id=?", [$User_Data['id']]);
			return $Count['COUNT(*)'];
		}
	}

	public function CountDNSAdmin($username)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			$Count = $this->fetch("SELECT COUNT(*) FROM dns");
			return $Count['COUNT(*)'];
		}
	}

	public function GetDNSAdmin($username)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetchAll("SELECT * FROM dns");
		}
	}

	public function GetDNSAdminX($username, $id)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->fetch("SELECT * FROM dns WHERE id=?", [$id]);
		}
	}

	public function DeleteDNSAdmin($username, $id)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('DELETE FROM dns WHERE id=?', [$id]);
		}
	}
}

?>