<?php
	class Router {
		public static function route(Request $request) {
			$controller = $request->get_controller().'_controller';
			$method = $request->get_method();
			$args = $request->get_args();

			$controller_file = SITE_PATH.'controllers/'.$controller.'.php';

			if(is_readable($controller_file)) {
				require_once($controller_file);

				$controller = new $controller;
				$method = (is_callable(array($controller, $method))) ? $method : 'index';
				// echo "<pre>".print_r('yey', 1)."</pre>";
				// echo "<pre>".print_r($method, 1)."</pre>";

				if(!empty($args)) {
					call_user_func_array(array($controller, $method), $args);

				}
				else {
					call_user_func(array($controller, $method));
				}
				return;
			}
			throw new Exception("404 - the page <strong>".$request->get_controller()."</strong> not found", 1);
			
		}
	}