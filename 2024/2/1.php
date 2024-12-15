<?php

$input = file_get_contents('input.txt');
$lines = explode(PHP_EOL, $input);
$lists = array_map(fn (string $lines) => explode(' ', $lines), $lines);
$result = 0;
foreach ($lists as $list)
{
    $result += (int) isSafe($list);
}

echo $result . PHP_EOL;

function isSafe(array $data): bool
{
    $diff = null;
    for ($i = 0; $i < (count($data) - 1); $i++) {
        if ($diff !== null && $diff * ($data[$i] - $data[$i + 1]) < 0) {
            return false;
        }
        $diff = $data[$i] - $data[$i + 1];
        if (abs($diff) > 3 || $diff === 0) {
            return false;
        }
    }
    return true;
}