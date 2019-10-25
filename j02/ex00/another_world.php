#!/usr/bin/php
<?php
    if ($argc < 2)
        exit();
    echo trim(preg_replace("/[ \r\t]+/", " ", $argv[1]))."\n";
?>
