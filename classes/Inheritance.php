<?php #Inheritance.php

class Person
{
	public $numberOfLegs = 2;

	public function __construct($name = 'unknown', $surname = 'unknown')
	{
		$this->name = $name;
		$this->surname = $surname;
	} // end cunstructor

	public function introduce()
	{
		echo "<p>Hello, my full name is <strong> 
			$this->name $this->surname</strong>.</p>";
	}// end introduce
}
/>
