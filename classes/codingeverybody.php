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
require_once "$base/classes/basetaskfacebook.php";

class Codingeverybody extends baseTaskFacebook
{
	//group
	public $fql;
	public $result;
	public $groupid = 174499879257223;

	public function __construct() 
	{
		parent::__construct();
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
