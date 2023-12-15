<?php

function getHash(string $string): int
{
    $r = 0;
    foreach (str_split($string) as $char) {
        $r += ord($char);
        $r *= 17;
        $r %= 256;
    }
    return $r;
}

$input = file_get_contents('input.txt');
$input = explode(',', $input);

$result = 0;
foreach ($input as $data) {
    $result += getHash($data);
}
echo $result . PHP_EOL;
