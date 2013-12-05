<html>
<!DOCTYPE html>
<?php

if (($loader = require_once 'vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

?>	

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, width-device-width">
    <title> 페이스북 그룹댓  글 </title>
  </head>
<body>

<?php
	require_once 'classes/comment.php';
	include_once 'nav.php';
?>
	<p>댓글 가져오기</p>
	<?php
		$comment = new Comment();
		if($comment->user) {
			echo "<a href='common/logout.php'>나가기</a>";
		} else {
			echo "<br />";
			echo $comment->getUserState();
			echo "<br />";

			if(isset($_GET['post_id'])) {
			var_dump($comment->getComment($_GET['post_id'])); //POST변경 예정
			} else {
			}
		}
	?>
</body>
</html>
