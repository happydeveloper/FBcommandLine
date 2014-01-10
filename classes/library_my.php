<?php #Libraray.php
class Dbmanager
{
	public function __construct($name = 'unkown')
	{
		$this->name = $name;
	}

	public function getConnection()
	{
		$dbhost = "localhost";
        	$dbuser = "root";
        	$dbpass = "1111";
        	$dbname = "fb_archive";
        	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", $dbuser, $dbpass,
                    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

        	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           	return $dbh;
	}

	public function grudTest()
	{

    		$sql = "SELECT * FROM stream ORDER BY created_time desc LIMIT 10;";
    		try {
        		$db = $this->getConnection();
        		$stmt = $db->query($sql);
        		$stream = $stmt->fetchAll(PDO::FETCH_OBJ);
        		$db = null;
        		echo '{"stream": ' . json_encode($stream) . '}';
    		} catch(PDOException $e) {
        		echo '{"error":{"text":'. $e->getMessage() .'}}';
    		}
	}
}

class Library_my extends Dbmanager
{
	public function __construct($name = 'unknown')
	{
		parent::__construct($name = 'dbmanage');
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
