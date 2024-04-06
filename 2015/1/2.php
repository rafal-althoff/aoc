<?php

$input = file_get_contents('input.txt');

$floor = 0;
$result = 0;
foreach (str_split($input) as $i) {
    $result++;
    $floor += ($i === ')') ? -1 : 1;
    if ($floor === -1) {
        echo $result . PHP_EOL;
        return;
    }
}
echo 'Never reached basement' . PHP_EOL;
