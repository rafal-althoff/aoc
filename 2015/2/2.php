<?php

$input = fopen('input.txt', 'r');

$result = 0;
while (!feof($input)) {
    $data = [$l, $w, $h] = explode('x', fgets($input));
    sort($data);
    array_pop($data);
    $result += $l*$w*$h + 2*$data[0] + 2*$data[1];
}
echo $result . PHP_EOL;
