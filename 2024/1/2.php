<?php

$input = file_get_contents('input.txt');
$lines = explode(PHP_EOL, $input);
$lists = array_map(fn (string $lines) => explode('   ', $lines), $lines);
$list1 = array_column($lists,0);
sort($list1);
$list2 = array_column($lists,1);
$list2 = array_count_values($list2);

$result = 0;
foreach ($list1 as $listElement) {
    $result += $listElement * ($list2[$listElement] ?? 0);
}

echo $result . PHP_EOL;