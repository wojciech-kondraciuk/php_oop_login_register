<?php
session_start();

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes

$router->respondWithController('GET', '/register', 'Register@index');
$router->respondWithController('POST', '/register', 'Register@index');

$router->respondWithController('GET', '/verify_email', 'verify@index');



if (isset($_SESSION['username'])) {
    $router->respondWithController('GET', '/panel', 'Panel@index');
} else {
    $router->respondWithController('GET', '/login', 'Login@index');
    $router->respondWithController('POST', '/login', 'Login@index');    
}


// Dispatch the router
$router->dispatch();