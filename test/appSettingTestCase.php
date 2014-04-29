<?php
class appSettingTestCase extends PHPUnit_Framework_TestCase
{
	public function testConstructor()
	{
		$app = new appSetting();
		$this->assertNotNull($app);
	}
}
?>
