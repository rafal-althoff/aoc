<?php

$input = str_split(file_get_contents('input.txt'));
array_push($input, $input[0]);

$sum = 0;
for ($i = 0; $i < count($input) - 1; $i++) {
    if ($input[$i] === $input[$i + 1]) {
        $sum += $input[$i];
    }
}

echo $sum . PHP_EOL;