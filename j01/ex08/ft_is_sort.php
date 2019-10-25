<?php
function ft_is_sort($tab)
{
	$sorted = $tab;
	sort($sorted, SORT_STRING);
    if ($tab == $sorted || $tab == array_reverse($sorted))
        return (TRUE);
    else
        return (FALSE);
}
?>
