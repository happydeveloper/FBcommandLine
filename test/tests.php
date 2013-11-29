<?php

class ot_streamTestCase extends PHPUnit_Framework_TestCase 
{
	
	public function testConstructor() {

		if (!headers_sent()) session_start();

		$_SERVER['HTTP_HOST'] = 'ucloud.duru.pe.kr';
    		$_SERVER['REQUEST_URI'] = '/ot_stream.php';
    		$ot_stream = new Ot_stream();
		$this->assertNotEmpty($ot_stream);

		return $ot_stream;
  	}

	/**
	* @depends testConstructor
	*/	
	public function testGetUserState(ot_stream $stream){
		 $_SERVER['HTTP_HOST'] = 'ucloud.duru.pe.kr';
    		 $_SERVER['REQUEST_URI'] = '/ot_stream.php';
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
    		$_SERVER['REQUEST_URI'] = '/ot_stream.php';
    		$stream = new Ot_stream();
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
		//var_dump($result);
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
			array($fql, "GROUPS_WALL", "SELECT post_id, created_time, permalink, message FROM stream"), //성공케이스 - 그룹의 담벼락
			array($fql, "ME_WALL", "Can not load fqlString, may be do not setting FQLSTRING about CMD") //실패케이스
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

	
}
