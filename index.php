<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


require 'vendor/autoload.php';

$config = include("config/config.php");

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

if ( $container['settings'][develop] ) {
  $dotenv = Dotenv\Dotenv::create(__DIR__);
  $dotenv->load();
}


//using twig for view
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('views/', [
        'cache' => false,
        'auto_reload' => true
    ]);

    // Instantiate and add Slim specific extension
    $router = $container->get('router');
    $uri = \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));

    return $view;
};
//using monolog for logs
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler('logs/app.log');
    $logger->pushHandler($file_handler);
    return $logger;
};

require 'routes/twitter.php';
// Run app
$app->run();
