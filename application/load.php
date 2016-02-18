<?php
	class Load {
		public function model($name) {
			$model = $name.'_model';
			$model_path = SITE_PATH.'models/'.$model.'.php';

			if(is_readable($model_path)) {
				require_once($model_path);
 
				if(class_exists($model)) {
					$registry = Registry::get_instance();
					$registry->$name = new $model;
					return true;
					// return new $model;
				}	
				else {
					return false;
				}
			}

			throw new Exception("Error Processing Request in Model", 1);
			
		}

		public function view($name, array $vars = null) {
			$file = SITE_PATH.'views/'.$name.'_view.php';

			if(is_readable($file)) {
				if(isset($vars)) {
					extract($vars);
				}

				require($file);
				return true;
			}

			throw new Exception("Error Processing Request in View", 1);
		}
	}