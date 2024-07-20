<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);

$fuelConsumption = 0;
foreach ($input as $mass) {
    $fuelConsumption += floor($mass / 3) - 2;
}

echo $fuelConsumption . PHP_EOL;