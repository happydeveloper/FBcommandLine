<?php
class appSetting
{
	public function readSetting()
	{
		try{
		$fh = fopen('setting.json', 'r');
		
		var_dump($fh);
		} catch (Exception $e) {
			echo $e->getMessage().": Caugth Error";
		}
	}

}
?>
