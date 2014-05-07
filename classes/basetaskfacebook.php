<?php
class baseTaskFacebook implements ISingleton
{
	//페이스북 객체
	public $facebook;
	
	//사용자 아이디 가져온다
	public $user;
	
	protected static $Sfacebook;

	public static function getInstance(){
		static::$Sfacebook = new Facebook(array(
		'appId' => '541305629256667',
		'secret' => '95492b0183156cd27d69b1308980ef26',
		'cookie' => true));
	}

	public function __construct() {
		
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

}

