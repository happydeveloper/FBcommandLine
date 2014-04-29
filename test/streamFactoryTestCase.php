<?php

class StreamFactoryTestCase extends PHPUnit_Framework_TestCase
{
	public function testTureIsTrue()
	{
		$foo = true;
		$this->assertTrue($foo);
	}

	public function testCreate()
	{
		$groupStream = streamFactory::create('174499879257223', 'codingeverybody');
		$this->assertNotNull($groupStream);
	}


}
?>
