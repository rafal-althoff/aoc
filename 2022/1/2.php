<?php

$input = file_get_contents('input.txt');
$separator = PHP_EOL . PHP_EOL;
$elves = explode($separator, $input);
$elves = array_map(fn (string $elf) => array_sum(explode(PHP_EOL, $elf)), $elves);
rsort($elves);

$result = 0;
for ($i = 0; $i < 3; $i++) {
    $result += $elves[$i];
}

echo $result . PHP_EOL;
