<?php


class ot_streamTestCase extends PHPUnit_Framework_TestCase 
{
	
	public function testConstructor() {

		$_SERVER['HTTP_HOST'] = 'ucloud.duru.pe.kr';
    		$_SERVER['REQUEST_URI'] = '/ot_stream.php';
    		$ot_stream = new ot_stream();
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
	* @depends testConstructor
	*/
	public function testGetStream(ot_stream $stream) {
		$this->assertNotNull($stream);
	}
}
