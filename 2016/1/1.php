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

$input = explode(', ', file_get_contents('input.txt'));
$currentDirection = 'N';
$currentPosition = ['x' => 0, 'y' => 0];

foreach ($input as $value) {
    $direction = substr($value, 0, 1);
    $length = (int) substr($value, 1);
    $currentDirection = $directionMap[$currentDirection . $direction];
    if ($currentDirection === 'N') {
        $currentPosition['y'] += $length;
    } if ($currentDirection === 'S') {
        $currentPosition['y'] -= $length;
    } if ($currentDirection === 'W') {
        $currentPosition['x'] -= $length;
    } if ($currentDirection === 'E') {
        $currentPosition['x'] += $length;
    }
}

echo abs($currentPosition['y']) + abs($currentPosition['x']);