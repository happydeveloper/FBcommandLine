<?php
require 'bootstrap.php';

class Grouplist extends baseTaskFacebook
{
	public $fql;
	public $result;
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getGroup($key)
	{
		if($this->user){
		
		}
		$this->fql = "SELECT * FROM groups WHERE id = '".$key."'";

		$param = array('method' => 'fql.query', 'query' => $this->fql, );

		$this->result = $this->facebook->api($params);
		return $this->result;
	}
}
