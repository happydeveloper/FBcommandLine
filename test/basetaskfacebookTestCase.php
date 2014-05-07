<?php
class basetaskfacebookTestCase extends PHPUnit_Framework_TestCase
{
	public function testTureIsTure()
	{
		echo "basetaskFacebookTest\n";
		$foo = true;
		$this->assertTrue($foo);
	}

	public function testGetInstance()
	{
		$obj = basetaskfacebook::getInstance();

		$this->assertEquals($obj, basetaskfacebook::getInstance());
	}
}
?>
