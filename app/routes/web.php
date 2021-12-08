<?php
	
	$routes = [];

	$controller = '/UserController';

	$routes['user'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];

	$controller = '/AuthController';

	$routes['auth'] = [
		'login' => $controller.'/login',
		'register' => $controller.'/register',
		'logout' => $controller.'/logout',
	];

	$controller = '/AttachmentController';

	$routes['attachment'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];


	$controller = '/PatientRecordController';

	$routes['patient-record'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'update' => $controller.'/update',
		'phyical-examination' => $controller. '/phyicalExamination'
	];

	$controller = '/DashboardController';

	$routes['dashboard'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'update' => $controller.'/update',
		'phyical-examination' => $controller. '/phyicalExamination'
	];

	return $routes;
?>