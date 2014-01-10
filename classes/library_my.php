<?php #Libraray.php
class Dbmanager
{
	public function __construct($name = 'unkown')
	{
		$this->name = $name;
	}

	public function getConnection()
	{

	}

	public function grudTest()
	{

	}
}

class Library_my extends Dbmanager
{
	public function __construct($name = 'unknown')
	{
		$this->name = $name;
	}

	public function cli()
	{
		echo '\n cli excute';
		if (isset($argv)) {
 		   $argument1 = $argv[0];
		    $argument2 = $argv[1];
    
		    echo $argument1;
		    echo $argument2;

		    echo "\n object created";
		    exit();
		}
	}

	public function makelog($msg)
	{
		$logtime = date('Y-m-d H:i:s');
		$logfile = date('Ymd');
		$log_fp = @fopen("./log/log_{$logfile}.txt", "a+");
		@fwrite($log_fp,"[$logtime] : $msg\n");
		@fclose($log_fp);
	}

	public function addDate($YMD)
	{
		$date = date_create($YMD);
		date_add($date, date_interval_create_from_date_string('1 days'));
		return date_format($date, 'Y-m-d');
	}

}

$Lib = new Library_my();

?>
