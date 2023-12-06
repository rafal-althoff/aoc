<?php

$input = fopen('input.txt', 'r');

$result = 0;
while (!feof($input)) {
    $row = fgets($input);
    preg_match_all('/(\d+) red/', $row, $redMatches);
    preg_match_all('/(\d+) green/', $row, $greenMatches);
    preg_match_all('/(\d+) blue/', $row, $blueMatches);

    $result += max($redMatches[1]) * max($greenMatches[1]) * max($blueMatches[1]);
}
echo $result . PHP_EOL;
