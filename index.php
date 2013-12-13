<?php

require 'vendor/autoload.php';

$app = new \Slim\Slim();
$app->config(array(
    'debug' => true,
    'templates.path' => 'views'
));

$app->get('/', function() use ($app) {
    $app->render('_index.php');
}); 
 
$app->get('/friends', function() use ($app) {
    $app->render('myfriends.php');
    //echo "Test";
});

$app->map('/codingeverybody', function() use ($app) {
	$app->render('codingeverybody.php');
})->via('GET', 'POST'); 

$app->map('/engfordev', function() use ($app) {
	$app->render('engfordev.php');
})->via('GET', 'POST');

$app->map('/comment', function() use($app) {
	$app->render('ot_comment.php');
})->via('GET', 'POST');

$app->get('/dbtest', 'getStream');

$app->get('/dbinsertTest','pushStream');
$app->run();

function getConnection()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "1111";
	$dbname = "fb_archive";
	//$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   	return $dbh;
}

function getStream() {
    $sql = "select * from stream";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $stream = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"stream": ' . json_encode($stream) . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

	function pushStream() {
	  	//$request = Slim::getInstance()->request();
 	 	//$stream = json_decode($request->getBody());
  		$sql = "insert into stream(message, message_tags, permalink, source_id, created_time, created, post_id, filter_key) values ('message', 'message_tag', 'permalik', 'source_id', NOW(), NOW(), 'post_id', 'filter_key');";
  		try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
	/*	$stmt->bindParam("message", $wine->name);
		$stmt->bindParam("message_tags", $wine->grapes);
		$stmt->bindParam("permalink", $wine->country);
		$stmt->bindParam("source_id", $wine->region);
		$stmt->bindParam("created_time", $wine->year);
		$stmt->bindParam("created", 
	*/	
		$stmt->execute();
		$stmt->id = $db->lastInsertId();
		$db = null;
		//	echo json_encode($stream);
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

?>
