<?php

$input = file_get_contents('input.txt');
$lines = explode(PHP_EOL, $input);
$lists = array_map(fn (string $lines) => explode('   ', $lines), $lines);
$list1 = array_column($lists,0);
sort($list1);
$list2 = array_column($lists,1);
sort($list2);

$result = 0;
for ($i = 0; $i < count($list1); $i++) {
    $result += abs($list1[$i] - $list2[$i]);
}

echo $result . PHP_EOL;