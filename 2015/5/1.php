<?php

function isNice(string $string): bool
{
    $count = preg_match_all('/[aeiou]/i', $string, $matches);
    if ($count < 3) {
        return false;
    }

    if (preg_match('/(.)\1/i', $string, $matches) !== 1) {
        return false;
    }

    if (preg_match('/ab|cd|pq|xy/i', $string, $matches) === 1) {
        return false;
    }

    return true;
}

$input = fopen('input.txt', 'r');

$result = 0;
while (!feof($input)) {
    if (isNice((string) fgets($input))) {
        $result++;
    }
}

echo $result . PHP_EOL;