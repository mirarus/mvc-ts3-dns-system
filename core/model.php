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

class model
{

	public $db;

	public function __construct()
	{
		global $db_config;
		
		try {
			$this->db = new PDO('mysql:host='.$db_config['db_host'].';dbname='.$db_config['db_name'].';charset=utf8', $db_config['db_username'], $db_config['db_password']);
		} catch(PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function GETDB()
	{
		return $this->db;
	}

	public function fetch($query, array $params = [])
	{
		$sth = $this->db->prepare($query);
		$sth->execute($params);
		return $sth->fetch();
	}

	public function fetchAll($query, array $params = [])
	{
		$sth = $this->db->prepare($query);
		$sth->execute($params);
		return $sth->fetchAll();
	}

	public function fetchAllRC($query, array $params = [])
	{
		$sth = $this->db->prepare($query);
		$sth->execute($params);
		$sth->fetchAll();
		return $sth->rowCount();
	}

	public function query($query, array $params = [])
	{
		$sth = $this->db->prepare($query);
		return $sth->execute($params);
	}

	public function query2($sql)
	{
		return $this->query($sql);
	}

	public function lastInsertId()
	{
		return $this->db->lastInsertId();
	}
}

?>