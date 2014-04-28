<?php
require 'bootstrap.php';

class Codingeverybody extends baseTaskFacebook
{
	//group
	public $fql;
	public $result;
	public $groupid = 174499879257223;
	
	public $searchTime;

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
		$searchTime = "UTC:".time();
	}

	public function getStreamText()
	{

	}

	public function filter()
	{
		if($this->user)
		{
			
		}
	else
		{
			$this->getUserState();
		}
	}
}
