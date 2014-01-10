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

class Library extends Dbmanager
{
	public function __construct($name = 'unknown')
	{
		$this->name = $name;
	}

	public function cli()
	{

	}

	public function makelog()
	{
	
	}

	public function addDate($YMD)
	{

	}

}

$Lib = new Library();

?>
