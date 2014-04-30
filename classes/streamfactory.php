<?php
require_once 'stream.php';

class streamFactory
{
	public static function create($groupid, $nickname)
	{
		return new Stream($groupid, $nickname);
	}
}
?>
