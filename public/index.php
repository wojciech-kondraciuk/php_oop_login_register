<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */
$activePage = basename($_SERVER['REDIRECT_URL'] ?? null, ".php");

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Enviroment setup
 */

use Dotenv\Dotenv;
// Import .env variables and add them the enviroment
$dotenv = new Dotenv(__DIR__."/../");
$dotenv->load();

/**
 * Loging
 */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$stream = new StreamHandler('logs/main.log', Logger::DEBUG);
// Create a logger for the debugging-related stuff
$logger = new Logger('debug');
$logger->pushHandler($stream);

/**
 * Error and Exception handling
 */

// Whoops error handling
$whoops = new Whoops\Run();
// Set Whoops as the default error and exception handler used by PHP:
$whoops->register();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());

require_once('../App/Routes.php');

/*
$loader = new \Twig\Loader\FilesystemLoader('../App/views');
$twig = new \Twig\Environment($loader);

$template = $twig->load('components/nav.html');

echo $template->render(['the' => 'variables']);
*/