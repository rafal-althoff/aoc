<?php

$input = trim(file_get_contents('input.txt'));

$inputs = array_chunk(str_split($input), 2);
$santa = array_column($inputs, 0);
$robot = array_column($inputs, 1);

echo count(
    array_unique(
        array_merge(
            getResult($santa),
            getResult($robot),
        )
    )
) . PHP_EOL;

function getResult(array $input): array
{
    $x = $y = 0;
    $locations = ["$x.$y"];
    foreach ($input as $i) {
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
    return array_unique($locations);
}
