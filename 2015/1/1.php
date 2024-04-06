<?php

$input = file_get_contents('input.txt');

$result = 0;
foreach (str_split($input) as $i) {
    $result += ($i === ')') ? -1 : 1;
}
echo $result . PHP_EOL;
