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

$boxes = [];
foreach ($input as $data) {
    preg_match('/^(.+)([=-])(.*)$/',$data, $matches);
    $label = getHash($matches[1]);
    $labelString = $matches[1];
    $operation = $matches[2];
    $focalLength = $matches[3] ?? null;
    if ($operation === '-') {
        unset($boxes[$label][$labelString]);
        continue;
    }
    $boxes[$label][$labelString] = $focalLength;
}

$r = 0;
foreach ($boxes as $key => $box) {
    if (empty($box)) {
        continue;
    }
    $j = 0;
    foreach ($box as $v) {
        $r += ($key+1) * (++$j) * $v;
    }
}
echo $r . PHP_EOL;
