<?php

$input = fopen('input.txt', 'r');

$result = 0;
while (!feof($input)) {
    $row = fgets($input);
    preg_match_all('/(\d+) red/', $row, $redMatches);
    preg_match_all('/(\d+) green/', $row, $greenMatches);
    preg_match_all('/(\d+) blue/', $row, $blueMatches);

    if (max($redMatches[1]) > 12) {
        continue;
    }
    if (max($greenMatches[1]) > 13) {
        continue;
    }
    if (max($blueMatches[1]) > 14) {
        continue;
    }
    preg_match('/Game (\d+)/', $row, $match);
    $result += (int)$match[1];
}
echo $result . PHP_EOL;
