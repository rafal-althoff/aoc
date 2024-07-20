<?php

$input = str_split(file_get_contents('input.txt'));
$inputs = array_chunk($input, floor(count($input) / 2));

$sum = 0;
for ($i = 0; $i < count($inputs[0]); $i++) {
    if ($inputs[0][$i] === $inputs[1][$i]) {
        $sum += $inputs[0][$i] * 2;
    }
}

echo $sum . PHP_EOL;