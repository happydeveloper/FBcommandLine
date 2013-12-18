<?php
class fqlManager
{
	public $fqlList;

	public function __construct()
	{
		$this->fqlList = array();
		$this->fqlList['GROUPS_WALL'] = "SELECT post_id, created_time, permalink, message, actor_id, message_tags, like_info, comment_info FROM stream WHERE source_id = ";
		//$this->fqlList['GROUPS_WALL'] = "SELECT post_id, created_time, permalink, message FROM stream WHERE source_id = ";
		$this->fqlList['COMMENT'] = "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = ";
		$this->fqlList['MY_FRIENDS']= "SELECT uid, pic, pic_square, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = ";
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
