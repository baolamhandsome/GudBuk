<?php

class Web {

	private $router;

	public function __construct() {
		require_once './app/cores/router.php';

		$this->router = new Router();

		$this->router -> get('/', 'HomeController@index');

		$this->router -> get('/login', 'AuthController@login');
		$this->router -> post('/login', 'AuthController@login');

		$this->router -> get('/register', 'AuthController@register');
		$this->router -> post('/register', 'AuthController@register');   

		$this->router -> get('/logout', 'AuthController@logout');

		$this->router -> get('/profile', 'ProfileController@index');
		$this->router -> post('/profile', 'ProfileController@index');

		$this->router -> get('/cart', 'CartController@index');
	}
	
	public function run() {
		$method = $_SERVER['REQUEST_METHOD'];
		$url = strtok($_SERVER['REQUEST_URI'], '?');		
		$basePath = '/GudBuk';
		if (str_starts_with($url, $basePath)) $url = substr($url, strlen($basePath));
		$this->router->processURL($method, $url);
	}
}
