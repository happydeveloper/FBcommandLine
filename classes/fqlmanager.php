<?php
class fqlManager
{
	public $fqlList;

	public function __construct()
	{
		$this->fqlList = array();
		$this->fqlList['GROUPS_WALL'] = "SELECT post_id, created_time, permalink, message FROM stream";
		$this->fqlList['COMMENT'] = "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = ";
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
