<?php


function name($path, $params = [])
{
    $path = new Router();

    $path = $routes->url($name, $params);
    echo $path;
}

function redirect($path, $params = [])
{
    $path = $routes->url($name, $params);
    header(('location:'. $path));
}