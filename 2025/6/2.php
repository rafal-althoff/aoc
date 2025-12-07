<?php

$input = file_get_contents('input.txt');
$lines = array_map(
    fn ($line) => str_split(strrev($line)),
    explode(PHP_EOL, $input)
);

$result = 0;
for($i = 0; $i < count($lines[0]); $i++) {
    $number = getNumber($lines, $i);
    if (empty($number)) {
        continue;
    }
    $numbers[] = (int)$number;
    if (end($lines)[$i] === '+') {
        $result += array_sum($numbers);
        $numbers = [];
    }
    if (end($lines)[$i] === '*') {
        $result += array_product($numbers);
        $numbers = [];
    }
}

echo $result . PHP_EOL;

function getNumber(array $data, int $index): string
{
    $digits = array_column($data, $index);
    array_pop($digits);
    return trim(implode('', $digits));
}