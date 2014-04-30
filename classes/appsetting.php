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
		
		$obj = json_decode($json);

		echo $obj->{'input'};
		return $obj->{'input'};
		//var_dump($fh);
		} catch (Exception $e) {
			echo $e->getMessage().": Caugth Error";
		}
	}

	public function jsonFileRead()
	{
	
		$string = file_get_contents('/Applications/mampstack-5.4.25-0/apache2/htdocs/FacebookSearchKeeper/setting.json');
		echo "json file read";
		//$json = json_decode(file_get_contents($file), true);
		$jsonRs = json_decode($string, true);
		
		var_dump($jsonRs);
	}

}
?>
