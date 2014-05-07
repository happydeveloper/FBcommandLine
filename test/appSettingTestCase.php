<?php
class appSettingTestCase extends PHPUnit_Framework_TestCase
{
	public function testConstructor()
	{
		echo "appSettingTestCase\n";
		$app = new appSetting();
		$this->assertNotNull($app);
	}

	public function testReadSetting()
	{
		$setting = new appSetting();
		$setting->readSetting();
		//$this->assertEquals($setting->readSetting(), 12345);
	}

	public function testJsonFileRead()
	{
		$setting = new appSetting();
		$setting->jsonFileRead();
	}

	public function testCreateAppSettingFile()
	{
		$createSettingFile = new appSetting();
		$createSettingFile->createAppSettingFile();
		$this->assertFileExists("setting.json");
	}
}
?>
