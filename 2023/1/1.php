<?php

$input = fopen('input.txt', 'r');

$result = 0;
while (!feof($input)) {
    preg_match_all('/\d/', fgets($input), $matches);
    $result += (int)(reset($matches[0]) . end($matches[0]));
}
echo $result . PHP_EOL;
