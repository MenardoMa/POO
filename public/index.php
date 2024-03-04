<?php

require "../vendor/autoload.php";

use Routes\Router;

$routes = new Router($_GET['url']);

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR. 'views'. DIRECTORY_SEPARATOR);
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);



$routes->get('/', 'App\Controller\BlogController@index');
$routes->get('/posts', 'App\Controller\BlogController@show');
$routes->get('/posts/{slug}-{id}', 'App\Controller\BlogController@read')

->where('{id}', '[0-9]+')
->where('{slug}', '[a-zA-Z\-]+')->name('posts');

$routes->run();

