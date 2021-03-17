<?php
session_start();
use \Core\View;
/**
 * Routing
 */
$router = new Core\Router();

// Add the routes

$router->respondWithController('GET', '/register', 'Register@index');
$router->respondWithController('POST', '/register', 'Register@index');

$router->respondWithController('GET', '/verify_email', 'verify@index');

$router->respond('GET', '/', function () {
    View::renderTemplate('index.html');
});

if (isset($_SESSION['username'])) {
    $router->respondWithController('GET', '/panel', 'Panel@index');
    $router->respondWithController('POST', '/panel', 'Panel@index');

    $router->respondWithController('GET', '/logout', 'Logout@index');
} else {
    $router->respondWithController('GET', '/login', 'Login@index');
    $router->respondWithController('POST', '/login', 'Login@index');    
}

//404 and other
$router->onHttpError(function ($code, $router) {
    switch ($code) {
        case 404:
            $router->response()->body(
                View::renderTemplate('404.html')
            );
            break;
        case 405:
            $router->response()->body(
                'You can\'t do that!'
            );
            break;
        default:
            $router->response()->body(
                'Oh no, a bad error happened that caused a '. $code
            );
    }
});;

// Dispatch the router
$router->dispatch();