<?php
require 'bootstrap.php';

class Comment extends baseTaskFacebook
{
	public $fql;
	public $result;

	public function __construct() 
	{
		parent::__construct();
	}

	public function getComment($post_id)
	{
		if($this->user) {
			$this->fql = "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = '".$post_id."'";
			$params = array('method' => 'fql.query', 'query' => $this->fql, );
			return $this->result = $this->facebook->api($params);
		}
	}
}
