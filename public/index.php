<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use Routes\Router;
use App\Exception\RouteException;

$router = new Router($_GET['url']);

define('VIEWS', dirname(__DIR__).DIRECTORY_SEPARATOR);
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);


$router->get('', "App\http\Controller\BlogController@index");
$router->get('/posts', "App\http\Controller\BlogController@post");
$router->get('/posts/{id}', "App\http\Controller\BlogController@show")->where('{id}', '[0-9]+');
$router->get('/tags/{id}', "App\http\Controller\BlogController@tag")->where('{id}', '[0-9]+');

$router->get('/admin/posts', "App\http\Controller\Admin\PostController@index");
$router->post('/admin/posts/delete/{id}', "App\http\Controller\Admin\PostController@destroy");
$router->get('/admin/posts/edit/{id}', "App\http\Controller\Admin\PostController@edit");
$router->post('/admin/posts/edit/{id}', "App\http\Controller\Admin\PostController@update");
$router->post('/admin/posts/edit/{id}', "App\http\Controller\Admin\PostController@update");

$router->get('/admin/posts/create', "App\http\Controller\Admin\PostController@create");
$router->post('/admin/posts/create', "App\http\Controller\Admin\PostController@createPost");

try {
    $router->run();
} catch (RouteException $e) {
    return $e->notFound("404");
}
