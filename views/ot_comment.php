<?php
if (($loader = require_once __DIR__ . '/vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

$base = realpath(dirname(__FILE__));

require_once "$base/classes/comment.php";
?>

<html>
<head>
	<meta charset="utf-8" />
	<title>댓글 가져오기</title>
</head>
<body>
	<p>댓글 가져오기</p>
	<?php
		$comment = new Comment();
		echo "<br />";
		echo $comment->getUserState();
		echo "<br />";

		if(isset($_GET['post_id'])) {
		var_dump($comment->getComment($_GET['post_id'])); //POST변경 예정
		} else {
		var_dump($comment->getComment());
		}
	?>
</body>
</html>
