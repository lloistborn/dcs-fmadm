<?php 
	define('SITE_PATH', realpath(dirname(__FILE__)).'/');

	require_once(SITE_PATH.'application/request.php');
	require_once(SITE_PATH.'application/registry.php');
	require_once(SITE_PATH.'application/router.php');
	require_once(SITE_PATH.'application/load.php');
	require_once(SITE_PATH.'application/base_model.php');
	require_once(SITE_PATH.'application/base_controller.php');
	require_once(SITE_PATH.'controllers/error_controller.php');

	// $registry = Registry::get_instance();
	// $registry->test = 'Hellllaaaaw';
	// echo '<pre>'.print_r($registry->test, 1).'</pre>';

	// $controller = new index_controller;
	// call_user_func(array($controller, 'index'));
	// echo '<pre>'.print_r($registry->myVar, 1).'</pre>';

	try {
		Router::route(new Request);
		
	} catch (Exception $e) {
		$controller = new error_controller;
		$controller->error($e->getMessage());
	}

