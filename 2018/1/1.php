<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);

$result = 0;
foreach ($input as $line) {
    $result += (int) $line;
}

echo $result . PHP_EOL;