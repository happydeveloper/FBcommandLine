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
		$this->result =  $this->facebook->api('929225043759185_937615956253427?fields=likes.limit(100){id,name,username,link}');
	}
}
