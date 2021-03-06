<?php

class codingeverybodyTestCase extends PHPUnit_Framework_TestCase 
{
	
	//====== codingeverybody.php

	public function testConstructor() {

		if (!headers_sent()) session_start();

		$_SERVER['HTTP_HOST'] = 'ucloud.duru.pe.kr';
    		$_SERVER['REQUEST_URI'] = '/codingeverybody.php';
    		$codingeverybody = new Codingeverybody();
		$this->assertNotEmpty($codingeverybody);

		return $codingeverybody;
  	}

	/**
	* @depends testConstructor
	*/	
	public function testGetUserState(codingeverybody $stream){
		 $_SERVER['HTTP_HOST'] = 'ucloud.duru.pe.kr';
    		 $_SERVER['REQUEST_URI'] = '/codingeverybody.php';
    		 $login_url = parse_url($stream->getUserState());
    		 $this->assertEquals($login_url['scheme'], 'https');
    		 $this->assertEquals($login_url['host'], 'www.facebook.com');
    		 $this->assertEquals($login_url['path'], '/dialog/oauth');
	}


	/**
	* @dataProvider provider
	*/
	public function testGetStream($startDate, $endDate) {
		//생성자
		$_SERVER['HTTP_HOST'] = 'ucloud.duru.pe.kr';
    		$_SERVER['REQUEST_URI'] = '/codingeverybody.php';
    		$stream = new Codingeverybody();
		$this->assertNotEmpty($stream);

		
		//결과를 저장시킴
		$result;		
		$startDateType = new Datetime($startDate);
		$endDateType   = new Datetime($endDate);

		if($stream) {
			$stream->fql = "SELECT post_id, created_time, permalink, message FROM stream WHERE source_id = 174499879257223 AND created_time < ".$endDateType->format('U')." AND created_time >= ".$startDateType->format('U')." LIMIT 50";
		
		$params = array('method' => 'fql.query', 'query' => $stream->fql, );
		$result =  $stream->facebook->api($params);
		}
		var_dump($result);
		$this->assertNotNull($result);
	}

	/**
	* @depends testConstructor
	*/
	public function provider()
	{
		return array(
			array('2013-11-21', '2013-11-22'),
			array('2013-11-25', '2013-11-26'),
			array('2013-11-26', '2013-11-27'),
			array('2013-11-27', '2013-11-28') //유효하지 않는 날짜 테스트
		);
	}


	//====== fqlmanager.php

	/**
	* FQL를 관리하는 클래스 - 코드의 유연성을 위해 하드 코딩 피함 - 나중에 FQL이 수정될 수 있음을 생각
        */
	public function testFqlManager()
	{
		$fql = new fqlManager();
		$this->assertNotEmpty($fql);
		return $fql;	
	}
	
	/**
	* FQL이 추가될때마다 테스트 리스트를 넣어서 체크
	* @depends testFqlManager
	*/
	public function providerFqlCall()
	{
		$fql = new fqlmanager();
		return array(
			array($fql, "GROUPS_WALL", "SELECT post_id, created_time, permalink, message FROM stream WHERE source_id = "), //성공케이스 - 그룹의 담벼락
			array($fql, "ME_WALL", "Can not load fqlString, may be do not setting FQLSTRING about CMD"), //실패케이스
			array($fql, "COMMENT", "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = "),
			array($fql, "MY_FRIENDS", "SELECT uid, pic, pic_square, name FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = ")

		);
	}

	/**
	* FQL 명령어를 불러오기
	* @dataProvider providerFqlCall
	*/
	public function testFqlMangerLoadCommand($fql, $cmd, $expectedMessage)
	{
		$this->assertNotNull($fql);
		$actual = $fql->loadFql($cmd);
		$expected = $expectedMessage;
		$this->assertEquals($actual, $expected);
	}

	//====== basefacebook.php

	/**
	* baseFacebook 클래스생성  테스트 -  페이스북 API를 이용하여 트랜잭션 할때 기본적인 작업을 담당
	*/
	public function testBaseTaskFacebook()
	{
		$basefacebook = new baseTaskFacebook();
		$this->assertNotEmpty($basefacebook);
		return $basefacebook;
	}

	/**
	* @depends testBaseTaskFacebook
	* 페이스북 객체가 생성 되었는지 확인
	*/
	public function testBaseTaskFacebook_verify_facebook_object(baseTaskFacebook $basefacebook)
	{
		$this->assertNotNull($basefacebook->facebook);
		$this->assertNotNull($basefacebook->user);
	}

	/**
	* @depends testBaseTaskFacebook
	* 로그인 URL 가져오기
	*/	
	public function testBaseTaskFacebookGetState(baseTaskFacebook $basefacebook)
	{

		 $_SERVER['HTTP_HOST'] = 'ucloud.duru.pe.kr';
    		 $_SERVER['REQUEST_URI'] = '/codingeverybody.php';
    		 $login_url = parse_url($basefacebook->getUserState());
    		 $this->assertEquals($login_url['scheme'], 'https');
    		 $this->assertEquals($login_url['host'], 'www.facebook.com');
		
		 //var_dump($login_url);
	} 

	/**
	* comment 클래스 생성 테스트
	*/
	public function testComment()
	{
		$comment = new Comment();
		$this->assertNotNull($comment->facebook);
		$this->assertNotNull($comment->user);
		return $comment;
	}

	/**
	* @dataProvider post_idProvider 
	*/
	public function testCommentGetComment($post_id)
	{
    		$comment = new Comment();

		$this->assertNotEmpty($comment);
		//결과를 저장시킴
		$result;		

		if($comment) {
		$comment->fql = "SELECT fromid, username, text, time, post_id FROM comment WHERE post_id = '".$post_id."'";
		$params = array('method' => 'fql.query', 'query' => $comment->fql, );
		$result =  $comment->facebook->api($params);
		}
		var_dump($result);
		$this->assertNotNull($result);
	}

	public function post_idProvider()
	{
		return array(
			array('174499879257223_677832208923985'),
      			array('174499879257223_677808422259697'),
      			array('174499879257223_677809988926207'),
      			array('174499879257223_677624362278103'),
      			array('174499879257223_677830205590852'),
      			array('174499879257223_677330778974128'),
      			array('174499879257223_677826072257932'),
      			array('174499879257223_677686678938538'),
      			array('174499879257223_677785002262039'),
      			array('174499879257223_677441018963104')
		);
	}

	/**
	/* Dbmanager 클래스 테스트
	*/
        public function testDbmanager()
	{
		$testdbmanager = new Dbmanager('connection1');
		$testdbmanager1 = new Dbmanager('connection2');
		$testdbmanager2 = new Dbmanager('connection3');
		$this->assertEquals($testdbmanager->name, 'connection1');
		$this->assertEquals($testdbmanager1->name, 'connection2');
		$this->assertEquals($testdbmanager2->name, 'connection3');
	}

	/**
	* Library_my 클래스 테스트
	*/
	public function testLibrary_my()
	{

	}
	/**
	* codingverybodyintodb 클래스 테스트
	*/
	public function testCodingeverbodyintodb()
	{
	//	$dbintoTest = new codingeverybodyintodb();

	}
}
