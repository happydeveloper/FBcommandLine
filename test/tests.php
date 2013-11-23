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
		$this->assertNotNull($stream);
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
			array('2013-11-21', '2013-11-22')
		);
	}
}
