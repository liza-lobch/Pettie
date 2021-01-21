<?php

    class Router
    {
        private $routes;
        
        public function __construct() {
			include_once('./config/routes.php');
			$this->routes = $routes;
		}
        
        public function run() {
			// 1) Получаем url, который ввел пользователь. 
			// 2) Находим соответствие url пользователя и controller/action; 
			// 3) Вызываем этот action 
            
            //echo '<pre>';
            //print_r($_SERVER);
            //echo '</pre>';
            
			$userUrl = explode('?', $_SERVER['REQUEST_URI'])[0];
            
			foreach ($this->routes as $controller => $patterns) {
				foreach ($patterns as $pattern => $parametrizedAction) {
					$pattern = ROOT . $pattern;
                    // $pattern = "/pettie/items/index" => $userUrl
					if (preg_match("~$pattern~", $userUrl)) {
						$controllerObj = new $controller; 
                        // books/view/2 => 2
                        // разбить массив по слэшам и забрать последнее значение
						$parametrizedAction = preg_replace("~$pattern~", $parametrizedAction, $userUrl); // убрать знак доллара
						$parameters = explode('/', $parametrizedAction); 
                        //print_r($parameters);  // название view и $1
						$action = array_shift($parameters); // массив без первого компонента
						call_user_func(array($controllerObj, $action), $parameters);
						exit();
					}
				}
			}
            // TODO: Отобразить страницу с ошибкой => ErrorsController -> index() - отобразить страницу 404
            call_user_func(array("ErrorsController", "index"), "error");
            exit();
        }
    }