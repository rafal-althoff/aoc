<?php

function getPossibleSolutions(int $time, int $distance): int
{
    $result = 0;
    for ($i = 1; $i < $time; $i++) {
        if ($i * ($time - $i) > $distance) {
            $result++;
        }
    }
    return $result;
}

$data = [
    45 => 305,
    97 => 1062,
    72 => 1110,
    95 => 1695,
];

$result = 1;
foreach ($data as $time => $distance) {
    $result *= getPossibleSolutions($time, $distance);
}
echo $result . PHP_EOL;
