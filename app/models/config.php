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

class config extends model
{

	public function DNSCONFIG()
	{
		return $this->fetchAll("SELECT * FROM dns_config");
	}

	public function SITECONFIG()
	{
		return $this->fetch("SELECT * FROM site_config");
	}

	public function DNSCONFIGX()
	{
		return $this->fetch("SELECT * FROM dns_config");
	}

	public function EditSite($username, $id, $title, $description, $keywords, $footer)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			return $this->query('UPDATE site_config SET title=?, description=?, keywords=?, footer=?, time=? WHERE id=?', [$title, $description, $keywords, $footer, time(), $id]);
		}
	}

	public function EditDNS($username, $id, $mail, $apikey, $domain)
	{
		$Admin_Data = controller::model('admin')->GetAdminByUsername($username);
		if ($Admin_Data) {
			$Config_Control = $this->fetch("SELECT * FROM dns_config");
			if ($Config_Control) {
				return $this->query('UPDATE dns_config SET mail=?, apikey=?, domain=?, time=? WHERE id=?', [$mail, $apikey, $domain, time(), $id]);
			} else{
				return $this->query('INSERT INTO dns_config (mail, apikey, domain, time) VALUES (?, ?, ?, ?)', [$mail, $apikey, $domain, time()]);
			}
		}
	}
}

?>