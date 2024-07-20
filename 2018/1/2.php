<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);

$visitedFrequencies = [0 => 1];
$currentFrequency = 0;
for ($i = 0; $i < count($input); $i++) {
    $currentFrequency += (int) $input[$i];
    echo $input[$i] . PHP_EOL . $currentFrequency . PHP_EOL;

    if (array_key_exists($currentFrequency, $visitedFrequencies)) {
        echo $currentFrequency . PHP_EOL;
        break;
    }
    $visitedFrequencies[$currentFrequency] = 1;
    if (($i + 1) === count($input)) {
        $i = -1 ;
    }
}