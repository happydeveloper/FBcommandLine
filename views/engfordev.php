    <?php
	require '_head.php';
    ?>
<?php
//OnLoad 초기 로드시 작업
	require_once 'classes/engfordev.php';
	include_once 'nav.php';
	$engfordev = new Engfordev();
	if($engfordev->user) {
		if(!empty($_POST['start']) && !empty($_POST['end'])){
			$engfordev->getStream($_POST['start'], $_POST['end']);
		} else {
			$engfordev->getStream('2011-01-23', '2011-05-30');
		}
	}
?>

    <?php if ($engfordev->user) : // 사용자 객체가 있는지 여부 체크 ?>
<div class="well">
      <a href="<?php echo 'common/logout.php'; ?>">얼굴책  나가기</a>

	<form action="./engfordev"  method="POST">
	<?php
	//날짜 셋팅
	$today = date('Y-m-d');
	$date = new DateTime($today);
	$date->add(new DateInterval('P1D'));

		echo "오늘   : ".$date->format('Y-m-d') . "<br />";
	if(!empty($_POST['start'])) {
		echo "검색일 : ".$_POST['start']."<br />";
	} else {
		echo "개발자영어 페이스북 첫 글 <br />";
	}
	?>

		<p><label>조회 시작일</label><input type="text" name="start" value="<?php echo date('Y-m-d') ?>" /></p>
        	<p><label>조회 종료일</label><input type="text" name="end"   value="<?php echo $date->format('Y-m-d') ?>"/></p>
 
        	<input type="submit" />
	</form>

    <?php else: ?>
      <div>
        <a href="<?php echo $engfordev->facebook->getLoginUrl(); ?>">얼굴책 로그인</a>
      </div>
    <?php endif ?>
</div>
<hr />
    <?php

	if($engfordev->user &&  $engfordev->result != null) {

	foreach($engfordev->result as $row){

			echo "<div class='post'> <article>";
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
		echo "<span>개발자영어</span>";
	}
    ?>
  <hr />
  <span>개발자영어</span>
  </body>

</html>
