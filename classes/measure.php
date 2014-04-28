<?php
class Measure implements iMeasureCnt {
	$postTotalCnt;
	$commentTotalCnt;
	$writedTime;
	$searchedTime;
	$postParticipant;
	$commentParticipant;
	$likeTotalCnt;
	$best_activitor;
	$best_like_cnt_post;
	$best_comment_cnt_post;
	$databaseCheckIn;

	public getCount()
	{
		$this->postTotalCnt = 100;
		return $this->postTotalCnt;
	}
}
?>
