<?php
class fqlmanagerTestCase extends PHPUnit_Framework_TestCase
{
	public function testTureIsTure()
	{
		$foo = true;
		$this->assertTrue($foo);
	}

	public function testGetInstance()
	{
		$obj = fqlManager::getInstance();
		$this->assertEquals($obj, fqlManager::getInstance());
	}

	/**
	* @dataProvider provider
	*/
	public function testLoadFql($key, $fqlVal)
	{
		$obj = fqlManager::getInstance();
		$this->assertEquals(fqlManager::loadFql($key), $fqlVal);
	}

	
	/**
	* @depends testLoadFql
	*/
	public function provider()
	{
		return array(
			array('GROUPS_WALL', "SELECT created_time, permalink, message, actor_id, message_tags, like_info, comment_info, post_id FROM stream WHERE source_id = "),
			array('COMMENT', "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = '"),
			array('MY_FRIENDS', "SELECT uid, pic, pic_square, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = ")
		);
	}
}
?>
