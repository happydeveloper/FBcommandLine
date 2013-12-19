<?php 
/*
* 페이스북에서 그룹의 포스트를 가져와서 데이타베이스에서 넣을 글들을 필터링한다.
*/

//의존성이 있는 클래스
require_once 'classes/codingeverybody.php';
require_once 'classes/codingeverybodyintodb.php';

class Codingeverybodyfilter
{
	public $codingeverybody;

	public function __construct()
	{
		$this->codingeverybody = new Codingeverybody();
	}

	public function filter()
	{
		if($this->codingeverybody->user)
		{
			
		}
		else
		{
			$this->codingeverybody->getUserState();
		}
	}
}
?>
