<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function() use ($app) {
    $app->render('_index.php');
}); 
 
$app->get('/friends', function() use ($app) {
    $app->render('myfriends.php');
    //echo "Test";
});

$app->map('/groups', function() use ($app) {
	$app->render('ot_stream.php');
})->via('GET', 'POST'); 
$app->run();

?>
