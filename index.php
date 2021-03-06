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
})->name('home');

$app->get('/contact', function () use($app){
    $app->render('contact.twig');
})->name('contact');

$app->post('/contact', function () use($app){
    //var_dump($app->request->post());

    $name = $app->request->post('name');
    $email = $app->request->post('email');
    $msg = $app->request->post('msg');

    if(!empty($name) && !empty($email) && !empty($msg)){
    	$cleanName = filter_var($name, FILTER_SANITIZE_STRING);
    	$cleanEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    	$cleanMsg = filter_var($msg, FILTER_SANITIZE_STRING);
    } else {
    	// message the user that there was a problem
    	$app->redirect('./contact');
    }

    $transport = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');
    $mailer = \Swift_Mailer::newInstance($transport);

    $message = \Swift_Message::newInstance();
    $message->setSubject('Email from our test website');
    $message->setFrom(array($cleanEmail=>$cleanName));
    $message->setTo(array('sergey@localhost'));
    $message->setBody($cleanMsg);

    $result = $mailer->send($message);

    if($result>0){
    	//sent a message that says thank you
    	$app->redirect('./');
    } else {
    	//send a message to the user that the message failed to send
    	//log that there was an error
    	$app->redirect('./contact');
    }

});

//Run the slim application
$app->run();

//echo "<br>Hello World";
