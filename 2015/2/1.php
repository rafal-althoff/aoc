<?php

$input = fopen('input.txt', 'r');

$result = 0;
while (!feof($input)) {
    [$l, $w, $h] = explode('x', fgets($input));
    $s1 = ($l*$w);
    $s2 = ($w*$h);
    $s3 = ($h*$l);
    $result += 2*$s1 + 2*$s2 + 2*$s3 + min($s1, $s2, $s3);
}
echo $result . PHP_EOL;
