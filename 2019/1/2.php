<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);

$fuelConsumption = 0;
foreach ($input as $mass) {
    $fuelConsumption += getFuelConsumption((int) $mass);
}
echo $fuelConsumption . PHP_EOL;

function getFuelConsumption(int $mass): int
{
    $fuelConsumption = (int) (floor($mass / 3) - 2);
    if ($fuelConsumption > 8) {
        return $fuelConsumption + getFuelConsumption($fuelConsumption);
    }
    return $fuelConsumption;
}