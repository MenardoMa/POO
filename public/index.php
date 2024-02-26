<?php

require "../vendor/autoload.php";

use Routes\Router;

$routes = new Router($_GET['url']);

$routes->get('/', function(){ echo "Home"; });
$routes->get('/posts', function(){ echo "Posts"; });
$routes->get('/posts/:slug-:id', function($slug, $id){ echo "Afficher $slug : $id"; });
$routes->get('/posts/:id', function($id){ 

?>

<form action="" method="post">
    <input type="text" name="name">
    <input type="submit">
</form>

<?php


});
$routes->post('/posts/:id', function($id){ echo "Afficher num " .var_dump($_POST); });

$routes->run();
