<?php
require 'vendor/autoload.php';
require_once 'classes/codingeverybody.php';
require_once 'classes/library_my.php';

$Lib->cli();

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

$app->get('/locktest','pushStream');

$app->get('/dbinsert/:startYear','pushStream');

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
   
    $sql = "SELECT * FROM stream ORDER BY created_time desc LIMIT 10;";
    try {
        $db = getConnection();
        $stmt = $db->query($sql);
        $stream = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"stream": ' . json_encode($stream) . '}';
    } catch(PDOException $e) {
	$Lib->makelog($e->getMessage());
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function pushStream($startYear='2014'){
  		try {
		//DTO에 담아서 처리 함
		//하루 단위로 처리함
		
		require_once 'classes/codingeverybodyintodb.php';

 		$codingeverybody = new Codingeverybody();
		if($codingeverybody->user) {
			echo "<a href=\"<?php echo 'common\/logout.php'; ?>\">logout</a>";
			
	        $Lib->makelog($startYear."data pushed stream into db.");	
		for($i = 0; $i < 365; $i++)
		{			
			$baseDate = $startYear."-01-01";
			$loadDate = date('Y-m-d', strtotime($baseDate. ' + '.$i.' days'));
			echo $loadDate.'<br />';
                       	$codingeverybody->getStream($loadDate, addDate($loadDate));
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
					if($key == 'message_tags')
						$codingeverybodyintodb->tag =  json_encode($value); //!empty($value) ? var_dump($value) : "";
					if($key == 'actor_id')
						$codingeverybodyintodb->actor_id = $value;
					if($key == 'comment_info')
						$codingeverybodyintodb->comment_info = json_encode($value);
					if($key == 'like_info')
						$codingeverybodyintodb->like_info = json_encode($value);
				
				}
				$codingeverybodyintodb->source_id = "174499879257223";
				$codingeverybodyintodb->created = date("Y-m-d H:i:s");
				$codingeverybodyintodb->filter_key = "The filter key to fetch data with. This key should be retrieved by querying the stream_filter FQL table or with the special values 'others' or 'owner'.";
			
				$codingeverybodyintodb->insert();

				}
echo $loadDate.' 해당 날짜의 스트림 데이타베이스 넣기 완료 '.'<br />';


}		
			} else 	{
				$codingeverybodyintodb = new codingeverybodyintodb(getConnection());
				$codingeverybodyintodb->insert();
			}
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
			$Lib->makelog('{"error":{"test":'.$e->getMessage().'}}');
		}

	}
?>
