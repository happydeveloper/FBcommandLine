<?php

class StreamFactoryTestCase extends PHPUnit_Framework_TestCase
{
	public function testTureIsTrue()
	{
		$foo = true;
		$this->assertTrue($foo);
	}

	/**
	* @dataProvider provider
	*/
	public function testCreate($id, $nickname)
	{
		$groupStream = streamFactory::create($id, $nickname);
		$this->assertNotNull($groupStream);
	}
	/**
	* @depends testCreate
	*/
	public function provider()
	{
		return array(
			array('174499879257223', 'codingeverybody'),
			array('157076174344216', 'Engfordev')
		);
	}


}
?>
