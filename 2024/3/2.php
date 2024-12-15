<?php

$input = file_get_contents('input.txt');
$result = 0;

$input = preg_replace('/don\'t\(\).*?do\(\)/s', '', $input);
$input = preg_replace('/don\'t\(\).*/', '', $input);

preg_match_all('/mul\((\d{1,3}),(\d{1,3})\)/', $input, $matches);

foreach ($matches[1] as $key => $value) {
    $result += $matches[1][$key] * $matches[2][$key];
}

echo $result . PHP_EOL;