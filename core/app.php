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

class app
{

	public $controller, $action, $params, $routes;

	public function __construct(array $routes)
	{
		$url = isset($_GET['url']) && !empty($_GET['url']) ? trim($_GET['url'], '/') : 'default/index';
		$url = explode('/', $url);

		$this->controller = isset($url[0]) ? $url[0].'Controller' : 'Main_Controller';
		$this->action = isset($url[1]) ? $url[1].'Action' : 'index_Action';

		array_shift($url);
		array_shift($url);

		$this->params = $url;
		$this->routes = $routes;
	}

	public function run()
	{
		if (file_exists($file = CDIR."/{$this->controller}.php")) {
			require_once $file;
			if (class_exists($this->controller)) {
				$controller = new $this->controller;
				if (method_exists($controller, $this->action)) {
					call_user_func_array([$controller, $this->action], $this->params);
				} else{
					return $this->startRouter();
				}
			} else{
				return $this->startRouter();
			}
		} else{
			return $this->startRouter();
		}
	}

	protected function startRouter()
	{
		if (!empty($this->routes) && is_array($this->routes)) {
			$url = rtrim(@$_GET['url'], '/');
			$notFound = false;
			foreach ($this->routes as $path => $controllerAction) {
				list($controller, $action) = explode(':', $controllerAction);
				$path = str_replace(':param', '([^/]+)', $path);
				if (preg_match("@^$path$@ixs", $url, $params)) {
					if (file_exists($file = CDIR."/{$controller}.php")) {
						require_once $file;
						if (class_exists($controller)) {
							$class = new $controller;
							if (method_exists($class, $action)) {
								array_shift($params);
								return call_user_func_array([$class, $action], array_values($params));
							} else{
								$notFound = true;
							}
						} else{
							$notFound = true;
						}
					} else{
						$notFound = true;
					}
				} else{
					$notFound = true;
				}
			}
			if ($notFound) {
				http_response_code(404);
				include VEDIR.'/index.php';
				exit;
			}
		}
	}
}

?>