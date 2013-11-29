<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim();

$app->get('/', function(){
    echo "Home Page";
}); 
 
$app->get('/testPage', function() use ($app) {
    $app->render('myfriends.php');
    //echo "Test";
});
 
$app->run();

?>
