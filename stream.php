<?php
class Stream extends baseTaskFacebook
{
	private $fql;
	private $groupid;
	
	private $result;
	private $searchTime;

	public function __construct($groupid, $nickname)
	{
		parent::__construct();
		$this->groupid = $groupid;
	}

	public function __getStream()
	{
		return "mock";
	}
}
?>
