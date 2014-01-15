<?php 
	require '_head.php';
?>
<?php
//OnLoad 초기 로드시 작업
	require_once 'classes/codingeverybody.php';
	include_once 'nav.php';
	$codingeverybody = new Codingeverybody();
	if($codingeverybody->user) {
		if(!empty($_POST['start']) && !empty($_POST['end'])){
			$codingeverybody->getStream($_POST['start'], $_POST['end']);
		} else {
			$codingeverybody->getStream('2010-12-31', '2011-01-01');
		}
	}
?>

    <?php if ($codingeverybody->user) : // 사용자 객체가 있는지 여부 체크 ?>
<div class="well">
      <a href="<?php echo 'common/logout.php'; ?>">얼굴북 나가기</a>


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

		<p><label>조회 시작일</label><input type="text" name="start" value="<?php echo date('Y-m-d') ?>" /></p>
        	<p><label>조회 종료일</label><input type="text" name="end"   value="<?php echo $date->format('Y-m-d') ?>"/></p>
 
        	<input class="btn btn-primary" type="submit" />
	</form>

    <?php else: ?>
      <div>
        <a href="<?php echo $codingeverybody->facebook->getLoginUrl(); ?>">얼굴책 로그인</a>
      </div>
    <?php endif ?>
</div>
<!-- 달력 컨트롤 --!>
<div class="container">
    <div class="col-md-10">
        <div class='well'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker({langague:'ko'});
            });
        </script>
    </div>
</div>
    <script type="text/javascript" src="http://eonasdan.github.io/bootstrap-datetimepicker/scripts/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://eonasdan.github.io/bootstrap-datetimepicker/scripts/moment-2.4.0.js"></script>
    <script type="text/javascript" src="http://eonasdan.github.io/bootstrap-datetimepicker/scripts/bootstrap-datetimepicker.js"></script>
   <script type="text/javascript" src="http://eonasdan.github.io/bootstrap-datetimepicker/scripts/locales/bootstrap-datetimepicker.ko.js"></script>
    <script>
        $(function(){
            var $window = $(window), $body   = $(document.body);
            $body.scrollspy({
                target: '.bs-sidebar'
            });
    });
    </script>
<!-- 달력컨트롤 끝 --!>

<hr />

    <?php

	if($codingeverybody->user &&  $codingeverybody->result != null) {

	foreach($codingeverybody->result as $row){

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
		echo "<span>생활코딩</span>";
	}
    ?>
  <hr />
  <span>생활코딩</span>
</body>

</html>
