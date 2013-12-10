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

class Student extends Person
{
	public function __construct($name = 'unknow', $surname = 'unknow', $id = 0, $topic = 'IT')
	{
		parent::__construct($name, $surname);
		$this->id = $id;
		$this->topic = $topic;
	}

	public function identify()
	{
		echo "<p>My stdent id is <stroing>$this->id</strong>";
		echo "and I am studying <strong>$this->topic</strong></p>";
	}
}

$b = new Student('DURU' , 'hapDev', 15020, 'PHP');

$b->identify();

$b->introduce();

?>
