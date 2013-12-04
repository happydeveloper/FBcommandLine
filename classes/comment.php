<?php
/**
* input-> source_id
* output -> comment
*/

if (($loader = require_once __DIR__ . './../vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

$base = realpath(dirname(__FILE__) . '/..');
require_once "$base/classes/fqlmanager.php";

class Comment
{
	
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
		if($this->user) {
				try {
					$this->user_profile = $this->facebook->api('/me');
				} catch (FacebookApiException $e) {
					error_log($e);
					$this->user = null;
				}
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

	public function getComment($post_id=0){

		$fqlmanager = new fqlManager();

		if($this->user) {
			$this->fql = $fqlmanager->loadFql("COMMENT")."'".$post_id."'";
			$params = array('method' => 'fql.query', 'query' => $this->fql, );
			return $this->facebook->api($params);
		}	
	}

}

?>

