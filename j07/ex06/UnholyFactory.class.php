<?php

Class UnholyFactory
{
	public $fight_club = [];
	public function absorb($smthing) {
		$type = new ReflectionClass($smthing);
		if ($type->getParentClass() && $type->getMethod('fight')) {
			$name = $smthing->getName();
			if (array_key_exists($name, $this->fight_club))
				print "(Factory already absorbed a fighter of type " . $name . ")" . PHP_EOL;
			else {
				print "(Factory absorbed a fighter of type " . $name . ")" . PHP_EOL;
				$this->fight_club[$name] = $smthing;
			}
		}
		else
			print "(Factory can't absorb this, it's not a fighter)" . PHP_EOL;
	}
	public function fabricate($fighter) {
		if (array_key_exists($fighter, $this->fight_club)) {
			print "(Factory fabricates a fighter of type " . $fighter . ")" . PHP_EOL;
			return (clone $this->fight_club[$fighter]);
		} else {
			print "(Factory hasn't absorbed any fighter of type " . $fighter . ")" . PHP_EOL;
			return (null);
		}
	}
}
?>
