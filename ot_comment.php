<?php
/**
* input-> source_id
* output -> comment
*/

require_once "lib/facebook.php";

class ot_comment
{
	//페이스북 객체
	protected $facebook;
	
	//사용자 아이디 가져온다
	protected $user;

	public function __construct($source_id) {

	$facebook = new Facebook(array(
		'appId' => '541305629256667',
		'secret' => '95492b0183156cd27d69b1308980ef26',
		'cookie' => true));

	$user = $facebook->getUser();

	}

	public function getComment(){
		echo 'comment_barabra';
	}

	public function getUserState(){
		if($this->user) {
			return $logoutUrl = $this->facebook->getLogoutUrl();
		}else {
			return $loginUrl = $this->facebook->getLoginUrl();
		}
	}
}
?>

<html>
<head>
	<meta charset="utf-8" />
	<title>comment_댓글</title>
</head>
<body>
	<p>댓글 가져오기</p>
	<?php
		$comment = new ot_comment('10332');
		$comment->getComment();
	?>
	<?php
		echo $comment->getUserState();
	?>
</body>
</html>
