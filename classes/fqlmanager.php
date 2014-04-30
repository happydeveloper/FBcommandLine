<?php
class fqlManager
{
	/**
	* @var cached reference to singleton instance
	*/
	protected static $fqlList;

	public static function getInstance()
	{
		if(null === static::$fqlList){
		static::$fqlList = new static;
			
		static::$fqlList = array();
		static::$fqlList['GROUPS_WALL'] = "SELECT created_time, permalink, message, actor_id, message_tags, like_info, comment_info, post_id FROM stream WHERE source_id = ";
		static::$fqlList['COMMENT'] = "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = '";
		static::$fqlList['MY_FRIENDS']= "SELECT uid, pic, pic_square, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = ";
		}
		
		return static::$fqlList;
	}

	public function __construct()
	{
	}

	public static function loadFql($key) 
	{
		if(isset(static::$fqlList[$key]))
		{
			return static::$fqlList[$key];
		}
		else
		{
			return "Can not load fqlString, may be do not setting FQLSTRING about CMD";
		}
	}
}
