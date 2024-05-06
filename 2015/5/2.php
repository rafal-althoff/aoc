<?php

function isNice(string $string): bool
{
    if (preg_match('/(..).*\1/i', $string, $matches) !== 1) {
        return false;
    }

    if (preg_match('/(\w)\w\1/i', $string, $matches) !== 1) {
        return false;
    }

    return true;
}

$input = fopen('input.txt', 'r');

$result = 0;
while (!feof($input)) {
    if (isNice(fgets($input))) {
        $result++;
    }
}

echo $result . PHP_EOL;