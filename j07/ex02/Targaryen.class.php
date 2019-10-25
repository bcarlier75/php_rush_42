<?php

Class Targaryen
{
	public function getBurned() {
		if ($this->resistsFire() == true)
			return "emerges naked but unharmed";
		else
			return "burns alive";
	}

	public function resistsFire() {
		return false;
	}
}
?>
