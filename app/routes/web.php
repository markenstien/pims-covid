<?php
	
	$routes = [];

	$controller = '/MailerController';

	$routes['mailer'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'send'   => $controller.'/send'
	];

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
		'complete' => $controller.'/complete',
		'start' => $controller.'/start'
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


	$controller = '/DeploymentController';

	$routes['deployment'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'download' => $controller.'/download',
		'show'   => $controller.'/show',
		'release' => $controller.'/release'
	];

	$controller = '/ClassificationController';

	$routes['classification'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'duplicate' => $controller .'/duplicate'
	];


	$controller = '/ClassificationItemController';
	$routes['classification-item'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
	];


	$controller = '/ClassificationCriteriaController';
	$routes['criteria'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
	];

	$controller = '/ClassificationRemarksController';
	$routes['remarks'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
	];

	
	$controller = '/FormBuilderController';
	$routes['form'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'add-item' => $controller.'/addItem',
		'edit-item' => $controller. '/editItem',
		'delete-item' => $controller. '/deleteItem',
		'respond'   => '/FormController'.'/respond'
	];


	$controller = '/ClassificationRespondController';

	$routes['classification-respond'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show',
		'add-item' => $controller.'/addItem',
		'respond'  => $controller.'/respond'
	];

	return $routes;
?>