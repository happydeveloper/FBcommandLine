<?php 
	require '_head.php';
?>
<?php
//OnLoad 초기 로드시 작업
	require_once 'classes/codingeverybody.php';
	include_once 'nav.php';
	require_once 'classes/comment.php';
	$comment = new Comment();
	$codingeverybody = new Codingeverybody();
	if($codingeverybody->user) {
		if(!empty($_POST['start']) && !empty($_POST['end'])){ 
//사용자입력 보안 처리
			$codingeverybody->getStream(mysql_real_escape_string($_POST['start']), mysql_real_escape_string($_POST['end']));
		} else {
			$codingeverybody->getStream('2010-12-31', '2011-01-01');
		}
	}
?>

    <?php if ($codingeverybody->user) : // 사용자 객체가 있는지 여부 체크 ?>
<div class="well">
      <a href="<?php echo 'common/logout.php'; ?>">얼굴북 나가기</a>

    <!-- -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  <script>
  $(function() {
      var clareCalendar = {
								monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
       dayNamesMin: ['일','월','화','수','목','금','토'],
								dateFormat: 'yy-mm-dd',
								changeMonth: true, 
								changeYear: true,
								showMonthAfterYear: true
							};
      
    $( "#start" ).datepicker(clareCalendar);
      $( "#end" ).datepicker(clareCalendar);
  });
  </script>
    <!-- -->
    
	<form action="./codingeverybody"  method="POST">
	<?php
	//날짜 셋팅
	$today = date('Y-m-d');
	$date = new DateTime($today);
	$date->add(new DateInterval('P1D'));

		echo "오늘   : ".$date->format('Y-m-d') . "<br />";
	if(!empty($_POST['start'])) {
		echo "검색일 : ".$_POST['start']."<br />";
	} else {
		echo "생활코딩 페이스북 첫 글 <br />";
	}
	?>

		<p><label>조회 시작일</label><input type="text" name="start" id="start" value="<?php echo date('Y-m-d') ?>" /></p>
        	<p><label>조회 종료일</label><input type="text" name="end"   id="end" value="<?php echo $date->format('Y-m-d') ?>"/></p>
 
        	<input class="btn btn-primary" type="submit" />
	</form>

    <?php else: ?>
      <div>
        <a href="<?php echo $codingeverybody->facebook->getLoginUrl(); ?>">얼굴책 로그인</a>
      </div>
    <?php endif ?>
</div>

<hr />
    <?php
	date_default_timezone_set('Asia/Seoul');
	if($codingeverybody->user &&  $codingeverybody->result != null) {

	foreach($codingeverybody->result as $row){

			echo "<div class='post'> <article>";
			foreach($row as $key=>$value){
				if($key == 'created_time') {
				        // $kor_time = new Datetime($value);
					echo "<span>".date('Y-m-d H:i:s', $value)."</span>";
					
				}

				if($key == 'permalink') {
					echo "<div class='permalink'><a href='". $value."' target='_blank' >".$key." 영구링크</a></div>";
				}
				if($key == 'message') {
					echo "<div class='message'>".$value."</div>";
				}
				
				if($key == 'post_id') {
					//echo "<span>".$value." 댓글 가져오기 </span>";
					if($comment) {
					 $comment->getCommentText($value);	
					}
				}
			}
			echo "<div class='later'>나중에 보기</div>";
			echo "<div class='tags'>태그 달기 </div>";
 			echo "</article> 
			</div>";
	}

	}
	else {
		echo "<span>생활코딩</span>";
	}
    ?>
  <hr />
  <span>생활코딩</span>
</body>

</html>
