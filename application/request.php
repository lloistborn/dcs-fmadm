<?php

	class Request {
		private $_controller;
		private $_method;
		private $_args;

		public function __construct() {
			if ($_SERVER['HTTP_HOST'] == 'localhost') {
				$parts = explode('/', $_SERVER['REQUEST_URI']);
				$parts = array_filter($parts);	
				
				array_shift($parts);
			}
			else {
				$parts = explode('/', $_SERVER['REQUEST_URI']);
				$parts = array_filter($parts);	
			}

			$this->_controller = ($c = array_shift($parts))? $c: 'index';
			$this->_method = ($c = array_shift($parts))? $c: 'index';
			$this->_args = (isset($parts[0])) ? $parts : array();
		}

		public function get_controller() {
			return $this->_controller;
		}

		public function get_method() {
			return $this->_method;
		}

		public function get_args() {
			return $this->_args;
		}
	}