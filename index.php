<?php

require 'vendor/autoload.php';

require_once 'classes/codingeverybody.php';

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

function addDate($YMD)
{
$date = date_create($YMD);
date_add($date, date_interval_create_from_date_string('1 days'));
return  date_format($date, 'Y-m-d');
}

function pushStream() {
  		try {
		//DTO에 담아서 처리 함
		//하루 단위로 처리함
		
		require_once 'classes/codingeverybodyintodb.php';

 		$codingeverybody = new Codingeverybody();
		if($codingeverybody->user) {
			echo "<a href=\"<?php echo 'common\/logout.php'; ?>\">logout</a>";
                       	$codingeverybody->getStream('2010-12-31', addDate('2010-12-31'));
				foreach($codingeverybody->result as $row){	
				$codingeverybodyintodb = new codingeverybodyintodb(getConnection());
				foreach($row as $key=>$value){	
					if($key == 'post_id') 
                                        	$codingeverybodyintodb->post_id = $value;
                                	if($key == 'created_time')
                                        	$codingeverybodyintodb->create_time = date('Y-m-d H:i:s', $value);
                                	if($key == 'permalink') 
                                        	$codingeverybodyintodb->permalink = $value;
                                	if($key == 'message') 
                                        	$codingeverybodyintodb->message =$value;
				}
				$codingeverybodyintodb->tag = "페이스북 태그";
				$codingeverybodyintodb->source_id = "생활코딩";
				$codingeverybodyintodb->created = date("Y-m-d H:i:s");
				$codingeverybodyintodb->filter_key = "필터키";
			
				$codingeverybodyintodb->insert();

				}
		
			} else 	{
				$codingeverybodyintodb = new codingeverybodyintodb(getConnection());
				$codingeverybodyintodb->insert();
			}
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
?>
