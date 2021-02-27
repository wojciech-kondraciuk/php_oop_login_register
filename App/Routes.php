<?php

/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
//$router->respondWithController('GET', '/[:name]', 'Home@index');

$router->respondWithController('GET', '/about', 'About@index');
$router->respondWithController('GET', '/register', 'Register@index');
$router->respondWithController('POST', '/register', 'Register@index');

$router->respondWithController('GET', '/send', 'Mail@index');

// Dispatch the router
$router->dispatch();