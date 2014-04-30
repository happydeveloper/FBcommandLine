<?php
class appSetting
{
	public function readSetting()
	{
		try{
		$fileName = "setting.json";

		$json_array = array(
			'input' => 'test',
			'input2' => 'test2'
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

	public function jsonFileRead()
	{
	
		$string = file_get_contents('setting.json');
		echo $string;
		$jsonRs = json_decode($string, true);

		var_dump($jsonRs);


		$obj = json_decode($string);
		print $obj->{'input'}; // 12345
	}

}
?>
