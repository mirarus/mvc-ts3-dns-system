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
?>
<?php

/**
 * User: Mirarus - Ali Güçlü
 * Date: 07/12/2018
 * TeamSpeak Dns Classı, CloudFlare V4 Uyumlu
 *
 * @author Mirarus - Ali Güçlü
 * @copyright Copyright (c) 2018, Mirarus
 * @link https://mirarus.com
 */

class mirarus_dns
{

	const TIMEOUT = 5;
	private $URL = 'https://api.cloudflare.com/client/v4/';
	private $auth_email;
	private $auth_key;
	private static $VALID_DNS_TYPES = array('A', 'AAAA', 'CNAME', 'TXT', 'SRV', 'LOC', 'MX', 'NS', 'SPF');
	

	public function __construct()
	{
		$num_args = func_num_args();
		if ($num_args == 2){
			$parameters = func_get_args();
			$this->auth_email = $parameters[0];
			$this->auth_key = $parameters[1];
		}else{
		}
	}

	public function identifier($domain)
	{
		$result = $this->get_zone($domain);
		if (isset($result->result) && count($result->result) == 1)
			return $result->result[0]->id;

		return false;
	}

	public function get_zone($name)
	{
		$data = [
			'name'      => "".$name."",
			'status'    => 'active',
			'page'      => 1,
			'match'     => 'all'
		];
		return $this->get('zones',$data);
	}

	public function get_zones()
	{
		return $this->get('zones',[]);
	}

	public function get_dns_record_id_a($identifier,$domain = '')
	{

		$data = [
			'type'=> 'A',
			"name"=>"".$domain."",
			'per_page'=>  20,
			'order'=>'type',
			'match'=>'all'
		];
		$response = $this->get('zones/'.$identifier.'/dns_records',$data);
		if ($response && count($response->result) == 1){
			return  $response->result[0]->id;
		}
		return "dns kimliği alınamadı";
	}

	public function get_dns_record_id_srv($identifier,$name = '')
	{

		$data = [
			'type'=> 'SRV',
			"name"=>"".$name."",
			'per_page'=>  20,
			'order'=>'type',
			'match'=>'all'
		];
		$response = $this->get('zones/'.$identifier.'/dns_records',$data);
		if ($response && count($response->result) == 1){
			return  $response->result[0]->id;
		}
		return "dns kimliği alınamadı";
	}

	public function delete_dns_record($identifier,$dns_record_id)
	{

		return $this->delete('zones/'.$identifier.'/dns_records/'.$dns_record_id,[]);
	}

	public function create_a_record($identifier,$dnsname,$ip)
	{
		$data = [
			'type' => 'A',
			"name"=>"".$dnsname."",
			'content'   =>  $ip,
			'proxiable' => true,
			'proxied' => false,
		];
		return $this->post('zones/'.$identifier.'/dns_records',$data);
	}

	public function create_srv_record($identifier,$dnsname,$port,$domain)
	{
		$data = [
			'type' => 'SRV',
			'data' => array(
				"name"=>"".$dnsname."",
				"ttl"=>120,
				"service"=>"_ts3",
				"proto"=>"_udp",
				"weight"=>5,
				"port"=>intval($port),
				"priority"=>0,
				"target"=>"".$dnsname.'.'.$domain.""
			)
		];
		return $this->post('zones/'.$identifier.'/dns_records',$data);
	}

	private function delete($endpoint,$data)
	{
		return $this->http_request($endpoint,$data,'delete');
	}

	private function post($endpoint,$data)
	{
		return $this->http_request($endpoint,$data,'post');
	}

	private function get($endpoint,$data)
	{
		return $this->http_request($endpoint,$data,'get');
	}

	private function put($endpoint,$data)
	{
		return $this->http_request($endpoint,$data,'put');
	}

	private function patch($endpoint,$data)
	{
		return $this->http_request($endpoint,$data,'patch');
	}

	private function http_request($endpoint,$data, $method)
	{

		$url = $this->URL.$endpoint;
		$headers = ["X-Auth-Email: {$this->auth_email}", "X-Auth-Key: {$this->auth_key}"];
		$headers[] = 'Content-type: application/json';

		$json_data = json_encode($data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, true);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_TIMEOUT, self::TIMEOUT);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		if ($method === 'post')
			curl_setopt($ch, CURLOPT_POST, true);

		if ($method === 'put')
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

		if ($method === 'delete')
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

		if ($method === 'patch')
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');

		if (!isset($method) || $method == 'get')
			$url .= '?'.http_build_query($data);
		else
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL, $url);


		$http_response = curl_exec($ch);
		$error       = curl_error($ch);
		$http_code   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);


		if ($http_code != 200) {
			return json_decode($http_response);
		} else {
			return json_decode($http_response);
		}
	}
}