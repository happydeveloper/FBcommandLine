<!DOCTYPE html>
<html lang="en">
<?php
	require_once 'lib/facebook.php';
class Ot_stream
{
	//페이스북 객체 
	public $facebook;

	public $user;

	public $fql;

	public $result;

	public function __construct() 
	{

	$this->facebook = new Facebook(array(
		'appId' => '541305629256667',
		'secret' => '95492b0183156cd27d69b1308980ef26',
		'cookie' => true));

	$this->user = $this->facebook->getUser();
	
		if($this->user) 
		{

			try {
				$this->user_profile = $this->facebook->api('/me');
			} catch(FacebookApiException $e) {
				error_log($e);
				$this->user = null;
			}
		}
	}

	public function getUserState(){
		if($this->user) {
			return $logoutUrl = $this->facebook->getLogoutUrl();
		} else {
			return $loginUrl = $this->facebook->getLoginUrl();
		}
	}

	public function getStream($startDate, $endDate)
	{
		$startDateType = new Datetime($startDate);
		$endDateType   = new Datetime($endDate);

		if($this->user) {
			$this->fql = "SELECT post_id, created_time, permalink, message FROM stream WHERE source_id = 174499879257223 AND created_time < ".$endDateType->format('U')." AND created_time >= ".$startDateType->format('U')." LIMIT 50";
		
		$params = array('method' => 'fql.query', 'query' => $this->fql, );
			echo "<br /> ".$this->fql;
			$this->result =  $this->facebook->api($params);
		}
	}
}

?>	
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width-device-width">
    <title>fbCommandLine</title>
  </head>
  <body>

<?php
//OnLoad 초기 로드시 작업
	include_once 'include/nav.php';
$ot_stream = new Ot_stream();
if($ot_stream->user) {
	if(!empty($_POST['start']) && !empty($_POST['end'])){
		$ot_stream->getStream($_POST['start'], $_POST['end']);
	} else {
		$ot_stream->getStream('2010-12-31', '2011-01-01');
	}
}
?>

    <?php if ($ot_stream->user) : //$this->user): 사용자 객체가 있는지 여부 체크 ?>
      <a href="<?php echo 'common/logout.php'; ?>">Logout</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $ot_stream->facebook->getLoginUrl(); ?>">Login with Facebook</a>
      </div>
    <?php endif ?>
<form action="ot_stream.php" method="POST">
	<p><label>조회 시작일</label><input type="text" name="start" value="2013-11-15"/></p>
        <p><label>조회 종료일</label><input type="text" name="end"   value="2013-11-16"/></p>
 
        <input type="submit" />
</form>
    <?php

	if($ot_stream->user &&  $ot_stream->result != null) {

	foreach($ot_stream->result as $row){

			echo "<article>";
			foreach($row as $key=>$value){
				if($key == 'post_id') {
					echo "<span>".$value." 댓글 가져오기 </span>";
				}
				if($key == 'created_time') {
				        // $kor_time = new Datetime($value);
					echo "<span>".gmdate('Y-m-d TH:i:s', $value)."</span>";
					
				}

				if($key == 'permalink') {
					echo "<a href='". $value."' target='_blank' >".$key." 영구링크</a>";
				}
				if($key == 'message') {
					echo "<p class='message'>".$value."</p>";
				}
			}
 			echo "</article>";
	}

	}
	else {
		echo "<h2>명령줄</h2>";
	}
    ?>
  </body>

</html>
