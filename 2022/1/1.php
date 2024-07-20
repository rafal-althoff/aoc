<?php

$input = file_get_contents('input.txt');
$separator = PHP_EOL . PHP_EOL;
$elves = explode($separator, $input);
$elves = array_map(fn (string $elf) => array_sum(explode(PHP_EOL, $elf)), $elves);

echo max($elves) . PHP_EOL;