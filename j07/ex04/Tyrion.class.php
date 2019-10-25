<?php

Class Tyrion extends Lannister
{
	public function sleepWith($person) {
		$person_name = new ReflectionClass($person);
		if ($person_name->getName() == "Sansa")
			echo "Let's do this." . PHP_EOL;
		else
			echo "Not even if I'm drunk !" . PHP_EOL;
	}
}
?>
