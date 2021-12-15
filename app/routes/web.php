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

	$controller = '/LaboratoryController';

	$routes['lab'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'update' => $controller.'/update',
		'view-public' => $controller.'/viewPublic',
		'send-to-mail' => $controller.'/sendToMail',
		'classify'  => $controller.'/classify'
	];

	$controller = '/LaboratoryRequestController';

	$routes['lab-request'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'update' => $controller.'/update',
		'phyical-examination' => $controller. '/phyicalExamination'
	];

	
	$controller = '/QueueController';

	$routes['queue'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show',
		'live'   => $controller.'/live',
		'new'    => $controller.'/new',
		'serve'  => $controller.'/serve',
		'skip'   => $controller.'/skip',
		'complete' => $controller.'/complete',
		'reset'   => $controller.'/reset'
	];


	$controller = '/HospitalController';

	$routes['hospital'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];

	$controller = '/AddressController';

	$routes['address'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show'
	];

	return $routes;
?>