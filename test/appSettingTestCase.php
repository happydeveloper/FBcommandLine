<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once "./bootstrap.php";

class appSettingTestCase extends TestCase
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
		$this->assertEquals($setting->createSetting(), "file create");
	}

	public function testJsonFileRead()
	{
		$setting = new appSetting();
		$this->assertEquals($setting->jsonFileRead(), "541305629256667");
	}

	public function testCreateAppSettingFile()
	{
		$createSettingFile = new appSetting();
		$createSettingFile->createAppSettingFile();
		$this->assertFileExists("setting.json");
	}
}
?>
