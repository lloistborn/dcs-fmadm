<?php
	abstract class base_controller{

		protected $_registry;

		protected $load;

		public function __construct() {
			$this->_registry = Registry::get_instance();
			$this->load = new Load;
		}

		public final function __get($key) {
			if($return = $this->_registry->$key) {
				return $return;
			}

			return false; 
		}
	}
?>