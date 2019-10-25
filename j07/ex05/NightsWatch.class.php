<?php

Class NightsWatch
{
	public $fight_club = [];
	public function recruit($person) {
		$this->fight_club[] = $person;
	}
	public function fight() {
		foreach ($this->fight_club as $fighter) {
			if (method_exists(get_class($fighter), 'fight'))
				$fighter->fight();
		}
	}
}
?>
