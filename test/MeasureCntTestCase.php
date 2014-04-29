<?php

class MeasureCntTestCase extends PHPUnit_Framework_TestCase
{
	public function testTrueIsTrue()
	{
		$foo = true;
		$this->assertTrue($foo);
	}

	public function testConstructor()
	{
		$measure = new Measure();
		$this->assertNotNull($measure);
	}

	public function testSetvariable() 
	{
		$measure = new Measure();
		for($i = 0; $i < 100; $i++){	
		$measure->setVariable("postTotalCnt",$i);
		$measure->setVariable("commentTotalCnt",$i);
		$this->assertEquals($i,$measure->getVariable("postTotalCnt"));
		$this->assertEquals($i,$measure->getVariable("commentTotalCnt"));
		}
	}

	public function testGetVariable()
	{
		$measure = new Measure();
		
	}	
}
