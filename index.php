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

function pushStream() {
  		try {
		//DTO에 담아서 처리 함
		//하루 단위로 처리함
 		$codingeverybody = new Codingeverybody();
		if($codingeverybody->user) {
                	if(!empty($_POST['start']) && !empty($_POST['end'])){
                        	$codingeverybody->getStream($_POST['start'], $_POST['end']);
                	} else {
                        	$codingeverybody->getStream('2010-12-31', '2011-01-01');
                	}
        	}
		$db;
		$sql;

		$message;
		$tag;
		$permalink;
		$source_id;
		$create_time;
		$created;
		$post_id;
		$filter_key;

		if ($codingeverybody->user) {
		echo "<a href=\"<?php echo 'common\/logout.php'; ?>\">logout</a>";
		global $message;
		global $tag;
		global $permalink;
		global $source_id;
		global $create_time;
		global $created;
		global $post_id;
		global $filter_key;


		foreach($codingeverybody->result as $row){	
			foreach($row as $key=>$value){	
				if($key == 'post_id') {
                                        $post_id = $value;
                                }
                                if($key == 'created_time') {
                                        $create_time = date('Y-m-d H:i:s', $value);
                                }
                                if($key == 'permalink') {
                                        $permalink = $value;
                                }
                                if($key == 'message') {
                                        $message =$value;
                                }
			}
		//$message = "페이스북";
		$tag = "페이스북 태그";
		$source_id = "생활코딩";
		$created = date("Y-m-d H:i:s");
		$filter_key = "필터키";


		$db = getConnection();
  		$sql = "insert into stream(message, message_tags, permalink, source_id, created_time, created, post_id, filter_key) values (:message, :message_tag, :permalink, :source_id, :created_time, :created, :post_id, :filter_key);";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':message', $message, PDO::PARAM_STR);
		$stmt->bindParam(":message_tag", $tag, PDO::PARAM_STR);
		$stmt->bindParam(":permalink", $permalink, PDO::PARAM_STR);
		$stmt->bindParam(":source_id", $source_id, PDO::PARAM_STR);
		$stmt->bindParam(":created_time", $create_time, PDO::PARAM_STR);
		$stmt->bindParam(":created", $created, PDO::PARAM_STR);
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
		$stmt->bindParam(":filter_key",$filter_key, PDO::PARAM_STR);
		$stmt->execute();
		$stmt->id = $db->lastInsertId();
		$db = null;
		}
		
		}
		else {
		global $message;	
		global $tag;	
		global $permalink;	
		global $sourc_id;	
		global $create_time;	
		global $created;	
		global $post_id;	
		global $filter_key;
		global $sql;		

		$message = "message into database 한글 입력 테스트";
		$tag = "tag into datatabse 태그 입력";
		$permalink = "peramlink into databases";
		$source_id = "source_id";
		$create_time = date("Y-m-d H:i:s");
		$created = date("Y-m-d H:i:s");
		$post_id = "post_id into database";
		$filter_key = "filter into database";


		$db = getConnection();
  		$sql = "insert into stream(message, message_tags, permalink, source_id, created_time, created, post_id, filter_key) values (:message, :message_tag, :permalink, :source_id, :created_time, :created, :post_id, :filter_key);";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':message', $message, PDO::PARAM_STR);
		$stmt->bindParam(":message_tag", $tag, PDO::PARAM_STR);
		$stmt->bindParam(":permalink", $permalink, PDO::PARAM_STR);
		$stmt->bindParam(":source_id", $source_id, PDO::PARAM_STR);
		$stmt->bindParam(":created_time", $create_time, PDO::PARAM_STR);
		$stmt->bindParam(":created", $created, PDO::PARAM_STR);
		$stmt->bindParam(":post_id", $post_id, PDO::PARAM_STR);
		$stmt->bindParam(":filter_key",$filter_key, PDO::PARAM_STR);
		$stmt->execute();
		$stmt->id = $db->lastInsertId();
		$db = null;
		}
		//	echo json_encode($stream);
		} catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}
?>
