#!/usr/bin/php
<?php
echo "Entrez un nombre: ";
while($input = fgets(STDIN))
{
	$input = trim($input);
	if (is_numeric($input))
	{
		if(($pos = strpos($input, '.')) == true)
		{
			$whole = substr($input, 0, $pos);
			$decimal = substr($input, $pos + 1);
			if($decimal != 0)
			{
				echo "Le chiffre $input est Impair\n";
				echo "Entrez un nombre: ";
				continue;
			}
		}
		else
			$whole = $input;
		if(strcmp($whole, "-") == 0 || strcmp($whole, "+") == 0)
			echo "Le chiffre $input est Pair\n";
		else if ((substr($whole, -1) % 2) == 0)
			echo "Le chiffre $input est Pair\n";
		else
			echo "Le chiffre $input est Impair\n";
	}
	else
		echo "'$input' n'est pas un chiffre\n";
	echo "Entrez un nombre: ";
}
?>
