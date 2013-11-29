<!DOCTYPE html>
<html lang="en">
<?php

if (($loader = require_once 'vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

?>	
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width-device-width">
    <title> 페이스북 그룹 글 </title>
  </head>
  <body>

<?php
//OnLoad 초기 로드시 작업
	require_once 'classes/ot_stream.php';
	include_once 'nav.php';
	$ot_stream = new Ot_stream();
	if($ot_stream->user) {
		if(!empty($_POST['start']) && !empty($_POST['end'])){
			$ot_stream->getStream($_POST['start'], $_POST['end']);
		} else {
			$ot_stream->getStream('2010-12-31', '2011-01-01');
		}
	}
?>

    <?php if ($ot_stream->user) : // 사용자 객체가 있는지 여부 체크 ?>
      <a href="<?php echo 'common/logout.php'; ?>">얼굴북 나가기</a>
    <?php else: ?>
      <div>
        <a href="<?php echo $ot_stream->facebook->getLoginUrl(); ?>">얼굴책 로그인</a>
      </div>
    <?php endif ?>
<form action="./groups"  method="POST">
<?php
//날짜 셋팅
$today = date('Y-m-d');
$date = new DateTime($today);
$date->add(new DateInterval('P1D'));
echo $date->format('Y-m-d') . "\n";

?>
	<p><label>조회 시작일</label><input type="text" name="start" value="<?php echo date('Y-m-d') ?>" /></p>
        <p><label>조회 종료일</label><input type="text" name="end"   value="<?php echo $date->format('Y-m-d') ?>"/></p>
 
        <input type="submit" />
</form>
    <?php

	if($ot_stream->user &&  $ot_stream->result != null) {

	foreach($ot_stream->result as $row){

			echo "<div> <article>";
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
 			echo "</article> </div>";
	}

	}
	else {
		echo "<h2>명령줄</h2>";
	}
    ?>
  </body>

</html>
