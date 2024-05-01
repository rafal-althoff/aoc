<?php

$input = trim(file_get_contents('input.txt'));

$x = $y = 0;
$locations = ["$x.$y"];
foreach (str_split($input) as $i) {
    if ($i == '^') {
        $y +=1;
    }
    if ($i == 'v') {
        $y -=1;
    }
    if ($i == '>') {
        $x +=1;
    }
    if ($i == '<') {
        $x -=1;
    }
    $locations[] = "$x.$y";
}
echo count(array_unique($locations)) . PHP_EOL;
