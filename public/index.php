<?php


require "../vendor/autoload.php";

use Router\Routes;

$routes = new Routes($_GET['url']);


$routes->get('/', function(){ echo "Page home"; } );
$routes->get('/posts', function(){ echo "Page poste"; } );
$routes->get('/posts/:slug-:id', function($slug, $id){ echo "Affiche $slug : $id "; } );
$routes->get('/posts/:id', function($id){ 

?>

    <form action="" method="post">
        <input type="text" name="name">
        <button type="submit">Envoyer</button>
    </form>

<?php


} );
$routes->post('/posts/:id', function($id){ echo "Poster l'article " .$id . "<pre>".print_r($_POST).";</pre>"; } );


$routes->run();