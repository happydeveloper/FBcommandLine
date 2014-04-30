<?php
class appSetting
{
	public function readSetting()
	{
		$dir = "/Applications/mampstack-5.4.25-0/apache2/htdocs/FacebookSearchKeeper";
		try{
		$json;
		$file = fopen($dir."/setting.json", 'r');
		while(!feof($file)) {
			$json += fgets($file);
		}
		fclose($file);
		echo $json;
		$obj = json_decode($json);
		return $obj->{'foo-var'};
		//var_dump($fh);
		} catch (Exception $e) {
			echo $e->getMessage().": Caugth Error";
		}
	}

}
?>
