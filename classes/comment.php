<?php
if (($loader = require_once __DIR__ . './../vendor/autoload.php') == null)  {
  die('Vendor directory not found, Please run composer install.');
}

$base = realpath(dirname(__FILE__) . '/..');
require_once "$base/classes/fqlmanager.php";

class Comment
{
	public $facebook;
	public $user;
	public $fql;
	public $result;

	public function __construct() {

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
		if($this->user) {
			return $logoutUrl = $this->facebook->getLogoutUrl();
		} else {
			return $loginUrl = $this->facebook->getLoginUrl();
		}
	}

	public function getComment($post_id)
	{
		if($this->user) {
			$this->fql = "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = '".$post_id."'";
			$params = array('method' => 'fql.query', 'query' => $this->fql, );
			return $this->result = $this->facebook->api($params);
		}
	}
}
