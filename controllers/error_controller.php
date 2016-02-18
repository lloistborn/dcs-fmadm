<?php

class error_controller extends base_controller {

	public function index() {}

	public function error($message = 'no information about the error') {
		echo "<pre>".print_r($message, 1)."</pre>";
	}
}