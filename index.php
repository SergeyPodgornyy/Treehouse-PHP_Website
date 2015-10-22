<?php

//require autoload to include all of composers libraries
require __DIR__ . '/vendor/autoload.php';

//use Kiev time to log errors and warnings
date_default_timezone_set('Europe/Kiev');

//------ create a new instance of monolog
// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;

// $log = new Logger('name');
// $log->pushHandler(new StreamHandler('app.log', Logger::WARNING));
// $log->addWarning('Foo');

$app = new \Slim\Slim( array(
	'view' => new \Slim\Views\Twig()
));   //new slim object instance

$view = $app->view();
$view->parserOptions = array(
    'debug' => true
);
$view->parserExtensions = array(
    new \Slim\Views\TwigExtension()
);

//define a HTTP GET route
$app->get('/', function () use($app){
    $app->render('about.twig');
});

$app->get('/contact', function () use($app){
    $app->render('contact.twig');
});

//Run the slim application
$app->run();

//echo "<br>Hello World";
