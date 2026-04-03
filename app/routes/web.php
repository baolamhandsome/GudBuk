<?php
require_once './app/cores/router.php';

$router = new Router();

$router -> get('/', 'HomeController@index');

$router -> get('/login', 'AuthController@login');
$router -> post('/login', 'AuthController@login');

$router -> get('/register', 'AuthController@register');
$router -> post('/register', 'AuthController@register');   

$router -> get('/logout', 'AuthController@logout');

$router -> get('/profile', 'ProfileController@index');
$router -> post('/profile', 'ProfileController@index');

