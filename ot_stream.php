<!DOCTYPE html>
<html lang="en">
<?php
	require_once 'lib/facebook.php';
class Ot_stream
{
	//페이스북 객체 
	public $facebook;

	public $user;

	public $user_profile;

	public $fql;

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
		/*if(!empty($_POST['start']) && !empty($_POST['end'])) {
			$previousDate = new Datetime($_POST['start']);
			$currentDate  = new Datetime($_POST['end']);
		}else {
			$previousDate = new Datetime('2010-12-31'); //생활코딩이 처음 시작
			$currentDate  = new Datetime('2011-01-01');
		}*/

		$startDateType = new Datetime($startDate);
		$endDateType   = new Datetime($endDate);

		if($this->user) {
			$this->fql = "SELECT created_time, permalink, message FROM stream WHERE source_id = 174499879257223 AND created_time < ".$startDateType->format('U')." AND created_time >= ".$endDateType->format('U')." LIMIT 50";
			$param = array('method' => 'fql.query', 'query' => $this->fql, );
			return $this->facebook->api($params);
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
	include_once 'include/nav.php';
?>

    <?php if (true) : //$this->user): 사용자 객체가 있는지 여부 체크 ?>
      <a href="<?php echo 'common/logout.php'; ?>">Logout</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>
<form action="ot_stream.php" method="POST">
	<p><label>시작일</label><input type="text" name="start" value="2013-11-15"/></p>
        <p><label>종료일</label><input type="text" name="end"   value="2013-11-16"/></p>
 
        <input type="submit" />
</form>
    <?php

	if(false) {

	foreach($result as $row){

			echo "<article>";
			foreach($row as $key=>$value){

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
