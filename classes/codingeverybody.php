<?php
if(false) //개발중일때는 직접실행 허용 //상수로 허용
{
	exit('No direct script access allowed');
}

if (($loader = require_once __DIR__ . './../vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

$base = realpath(dirname(__FILE__) . '/..');
require_once "$base/classes/fqlmanager.php";

class Codingeverybody
{
	const APP_ID = '541305629256667';
	const SECRET = '95492b0183156cd27d69b1308980ef26';

	//페이스북 객체 
	public $facebook;
	public $user;
	public $fql;
	public $result;
	public $groupid = 174499879257223;

	public function __construct() 
	{
		$this->facebook = new Facebook(array(
			'appId'  => self::APP_ID,
			'secret' => self::SECRET,
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

	public function getStream($startDate, $endDate)
	{
		$fqlmanager = new fqlManager();
		$startDateType = new Datetime($startDate);
		$endDateType   = new Datetime($endDate);
		if($this->user) {
			$this->fql = $fqlmanager->loadFql("GROUPS_WALL").$this->groupid." AND created_time < ".$endDateType->format('U')." AND created_time >= ".$startDateType->format('U')." LIMIT 300";
		$params = array('method' => 'fql.query', 'query' => $this->fql, );
		$this->result =  $this->facebook->api($params);
		}
	}
}
