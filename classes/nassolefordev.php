<?php
require 'bootstrap.php';

class Nassolefordev extends baseTaskFacebook
{
	public $fql;
	public $result;
	public $groupid = 157076174344216; 

	public function __construct() 
	{
		parent::__construct();
	}


	public function getStream()
	{
/*
		fqlManager::getInstance();
		$startDateType = new Datetime($startDate);
		$endDateType   = new Datetime($endDate);
		if($this->user) {
			$this->fql = fqlManager::loadFql("GROUPS_WALL").$this->groupid." AND created_time < ".$endDateType->format('U')." AND created_time >= ".$startDateType->format('U')." LIMIT 50";
		$params = array('method' => 'fql.query', 'query' => $this->fql, );
*/
		$this->result =  $this->facebook->api('929225043759185_937615956253427?fields=likes{name,link}');
		//}
	}
}
