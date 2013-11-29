<?php
class fqlManager
{
	public $fqlList;

	public function __construct()
	{
		$this->fqlList = array();
		$this->fqlList['GROUPS_WALL'] = "SELECT post_id, created_time, permalink, message FROM stream";
	}

	public function loadFql($key) 
	{
		if(isset($this->fqlList[$key]))
		{
			return $this->fqlList[$key];
		}
		else
		{
			return "Can not load fqlString, may be do not setting FQLSTRING about CMD";
		}
	}
}
