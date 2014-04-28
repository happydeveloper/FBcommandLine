<?php
require 'bootstrap.php';

class Measure implements iMeasureCnt 
{
	//private	$postTotalCnt;
	//private $commentTotalCnt;
	//private $likeTotalCnt;

	//private $writedTime;
	//private $searchedTime;
	
	//private $postParticipant;
	//private $commentParticipant;
	//private $best_activitor;

	//private $best_like_cnt_post;
	//private $best_comment_cnt_post;

	//private	$databaseCheckIn;
	private $vars = array();

	public function setVariable($name, $val)
	{
		$this->vars[$name] = $val;
	}

    	public function getVariable($name)
	{
		return $this->vars[$name];
	}
}
?>
