<?php

$myFile = 'lab.txt';

$text = file_get_contents($myFile);

$shift = 1;

$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZA';

$newAlphabet = substr($alphabet, $shift).substr($alphabet, 8, $shift);

$modifiedtext = strtr($text, $alphabet, $newAlphabet);

file_put_contents($myFile, $modifiedtext);

echo "Characters Replaced";

?>
