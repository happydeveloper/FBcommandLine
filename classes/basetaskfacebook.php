<?php
class baseTaskFacebook
{
	//페이스북 객체
	public $facebook;
	
	//사용자 아이디 가져온다
	public $user;


	public function __construct() {
		
	$this->facebook = new Facebook(array(
		'appId' => '541305629256667',
		'secret' => '95492b0183156cd27d69b1308980ef26',
		'cookie' => true));

	$this->user = $this->facebook->getUser();
	}


	public function getUserState(){
		if($this->user) {
			return $logoutUrl = $this->facebook->getLogoutUrl();
		} else {
			return $loginUrl = $this->facebook->getLoginUrl();
		}
	}

}

