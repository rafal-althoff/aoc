<?php

$input = file_get_contents('input.txt');

function transposeMap($map): string
{
    $map = explode(PHP_EOL, $map);
    foreach ($map as $key => $row) {
        $map[$key] = str_split($row);
    }
    $map = array_map(null, ...$map);
    foreach ($map as $key => $row) {
        $map[$key] = implode($row);
    }
    return implode(PHP_EOL, $map);
}


function solveRow(string $row): int
{
    $r = 0;
    if (!str_contains($row, 'O')) {
        return 0;
    }
    if (!str_contains($row, '#')) {
        $o = preg_match_all('/O/', $row);
        for ($i = 0; $i < $o; $i++) {
            $r += strlen($row) - $i;
        }
        return $r;
    }
    $firstHashPosition = strpos($row, '#');
    $beforeHash = substr($row, 0, $firstHashPosition);
    $o = preg_match_all('/O/', $beforeHash);
    for ($i = 0; $i < $o; $i++) {
        $r += strlen($row) - $i;
    }
    return $r + solveRow(substr($row, $firstHashPosition + 1));
}

$r = 0;
$map = transposeMap($input);
$map = explode(PHP_EOL, $map);
foreach ($map as $row) {
    $r += solveRow($row) . PHP_EOL;
}
echo PHP_EOL . $r . PHP_EOL;