<?php

$input = fopen('input.txt', 'r');

$map = [
    'one' => 1,
    'two' => 2,
    'three' => 3,
    'four' => 4,
    'five' => 5,
    'six' => 6,
    'seven' => 7,
    'eight' => 8,
    'nine' => 9,
];

$result = 0;
while (!feof($input)) {
    $row = fgets($input);
    // In theory, we could only use preg_match_all as in first part of the challenge, but unfortunately we won't be able to get overlapping values i.e. 'oneight'.
    // preg_match_all('/\d|one|two|three|four|five|six|seven|eight|nine/', '1oneeight', $matches) will return only 1 and one = which will gives us a result of 11 instead of proper 18.
    preg_match('/\d|one|two|three|four|five|six|seven|eight|nine/', $row, $frontMatch);
    preg_match('/\d|enin|thgie|neves|xis|evif|ruof|eerht|owt|eno/', strrev($row), $backMatch);
    $frontValue = ($map[$frontMatch[0]] ?? $frontMatch[0]);
    $backValue = ($map[strrev($backMatch[0])] ?? $backMatch[0]);
    $result += (int)($frontValue . $backValue);
}
echo $result . PHP_EOL;
