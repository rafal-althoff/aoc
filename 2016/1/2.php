<?php

$directionMap = [
    'NR' => 'E',
    'NL' => 'W',
    'ER' => 'S',
    'EL' => 'N',
    'SR' => 'W',
    'SL' => 'E',
    'WR' => 'N',
    'WL' => 'S',
];

$factors = [
    'N' => ['x' => 0, 'y' => 1],
    'S' => ['x' => 0,'y' => -1],
    'W' => ['x' => -1,'y' => 0],
    'E' => ['x' => 1, 'y' => 0],
];

$input = explode(', ', file_get_contents('input.txt'));
$currentDirection = 'N';
$currentPosition = ['x' => 0, 'y' => 0];
$history = ['0.0' => 1];

foreach ($input as $value) {
    $direction = substr($value, 0, 1);
    $length = (int) substr($value, 1);
    $currentDirection = $directionMap[$currentDirection . $direction];
    $currentFactor = $factors[$currentDirection];
    for ($j = 0; $j < $length; $j++) {
        $currentPosition['x'] += $currentFactor['x'];
        $currentPosition['y'] += $currentFactor['y'];
        $key = $currentPosition['x'] . '.' . $currentPosition['y'];
        if (array_key_exists($key, $history)) {
            break 2;
        }
        $history[$key] = 1;
    }
}

echo PHP_EOL . abs($currentPosition['y']) + abs($currentPosition['x']) . PHP_EOL;
