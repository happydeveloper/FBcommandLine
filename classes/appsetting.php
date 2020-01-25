<?php
class appSetting
{
	public function createAppSettingFile()
	{
		
		try{
			$fileName = "setting.json";

			$json_array = array(
				'appId' => '541305629256667',
				'secret' => '95492b0183156cd27d69b1308980ef26'
				);

			if(file_exists($fileName)) {
				unlink($fileName);
			}

			$file = fopen($fileName, 'a');

			fwrite($file, json_encode($json_array));
		
			fclose($file);
		
		} catch (Exception $e) {
			echo $e->getMessage().": Caugth Error";
		}
	}

	public function createSetting()
	{
		try{
		$fileName = "setting.json";

		$json_array = array(
			'appId' => '541305629256667',
			'secret' => '95492b0183156cd27d69b1308980ef26'
			);

		if(file_exists($fileName)) {
			unlink($fileName);
		}

		$file = fopen($fileName, 'a');

		fwrite($file, json_encode($json_array));
		
		fclose($file);

		return  "file create";
		
		} catch (Exception $e) {
			echo $e->getMessage().": Caugth Error";
		}
	}

	public function jsonFileRead()
	{
	
		$string = file_get_contents('setting.json');
		echo $string;
		$jsonRs = json_decode($string, true);

		var_dump($jsonRs);

		$obj = json_decode($string);
		var_dump($obj);
		return $obj->{'appId'}; // 12345
	}

}
?>
