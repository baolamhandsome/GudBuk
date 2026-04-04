<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	// CONTROLLER
	// baseController should be first before requiring any controller
	require_once __DIR__ . '/app/controllers/baseController.php';
	require_once __DIR__ . '/app/controllers/CartController.php';
	require_once __DIR__ . '/app/controllers/userController.php';
	// MODELS
	// dbcore should be loaded first as well
	require_once __DIR__ . '/app/models/dbcore.php';
	require_once __DIR__ . '/app/models/cart.php';
	require_once __DIR__ . '/app/models/user.php';
	// ROUTER
	require_once __DIR__ . '/app/routes/web.php';

	$web = new Web();
	$web->run();
?>
