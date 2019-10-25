<?php

Class Jaime extends Lannister
{
	public function sleepWith($person) {
		$person_name = new ReflectionClass($person);
		if ($person_name->getName() == "Tyrion")
			echo "Not even if I'm drunk !" . PHP_EOL;
		else if ($person_name->getName() == "Sansa")
			echo "Let's do this." . PHP_EOL;
		else if ($person_name->getName() == "Cersei") {
			echo "With pleasure, but only in a tower in Winterfell, then." . PHP_EOL;
			
		}
	}
}
?>
