<?php
/**
* input-> source_id
* output -> comment
*/

require_once "lib/facebook.php";

class ot_comment
{
	//페이스북 객체
	public $facebook;
	
	//사용자 아이디 가져온다
	public $user;

	//사용자 프로필
	public $user_profile;

	//FQL 쿼리
	public $fql;


	public function __construct($source_id) {

	$this->facebook = new Facebook(array(
		'appId' => '541305629256667',
		'secret' => '95492b0183156cd27d69b1308980ef26',
		'cookie' => true));

	$this->user = $this->facebook->getUser();
	var_dump($this->user);
	if($this->user) {
			try {
				$this->user_profile = $this->facebook->api('/me');
			} catch (FacebookApiException $e) {
				error_log($e);
				$this->user = null;
			}
		}	
	}

	public function getComment(){
		echo 'call comment';
		if($this->user) {
			$this->fql = "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id in (SELECT post_id FROM stream WHERE source_id='174499879257223' LIMIT 10)";
			$params = array('method' => 'fql.query', 'query' => $this->fql, );
			return $this->facebook->api($params);
		}	
	}

	public function getUserState(){
		echo 'user 상태 여부 가져오기';
		if($this->user) {
			return $logoutUrl = $this->facebook->getLogoutUrl();
		} else {
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
		//$comment->getComment();
		echo $comment->getUserState();

		var_dump($comment->getComment());
	?>
</body>
</html>
