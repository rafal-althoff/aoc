<?php

function goThroughMap(array $input, array &$energizedMap, array &$movementMap = [], int $x = 0, int $y = 0, string $dir = 'R'): void
{
    if (!isset($input[$y][$x])) {
        return;
    }
    $energizedMap[$y][$x] = 1;
    if (isset($movementMap[$y][$x]) && in_array($dir, $movementMap[$y][$x])) {
        return;
    }
    $movementMap[$y][$x][] = $dir;
    if ($input[$y][$x] === '|' && in_array($dir, ['L','R'])) {
        goThroughMap($input, $energizedMap, $movementMap, $x, $y-1, 'U');
        goThroughMap($input, $energizedMap, $movementMap, $x, $y+1, 'D');
        return;
    }
    if ($input[$y][$x] === '-' && in_array($dir, ['U','D'])) {
        goThroughMap($input, $energizedMap, $movementMap, $x+1, $y, 'R');
        goThroughMap($input, $energizedMap, $movementMap, $x-1, $y, 'L');
        return;
    }
    if ($input[$y][$x] == '\\') {
        if ($dir === 'R') {
            $dir = 'D';
        }
        elseif ($dir === 'L') {
            $dir = 'U';
        }
        elseif ($dir === 'U') {
            $dir = 'L';
        }
        elseif ($dir === 'D') {
            $dir = 'R';
        }
    }
    if ($input[$y][$x] == '/') {
        if ($dir === 'R') {
            $dir = 'U';
        }
        elseif ($dir === 'L') {
            $dir = 'D';
        }
        elseif ($dir === 'U') {
            $dir = 'R';
        }
        elseif ($dir === 'D') {
            $dir = 'L';
        }
    }

    // Move
    if ($dir === 'R') {
        $x++;
    }
    if ($dir === 'L') {
        $x--;
    }
    if ($dir === 'U') {
        $y--;
    }
    if ($dir === 'D') {
        $y++;
    }
    goThroughMap($input, $energizedMap, $movementMap, $x, $y, $dir);
}

function getMapResult(array $map, int $x, int $y, string $dir): int
{
    $energizedMap = $map;
    $movementMap = [];
    goThroughMap($map, $energizedMap, $movementMap, $x, $y, $dir);

    $r = 0;
    foreach ($energizedMap as $row) {
        $r += array_count_values($row)[1] ?? 0;
    }
    return $r;
}

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, trim($input));
foreach ($input as $key => $row) {
    $input[$key] = str_split($row);
}

$max = 0;
foreach ($input as $y => $row) {
    foreach ($row as $x => $v) {
        if ($x === 0) {
            $max = max($max, getMapResult($input, $x, $y, 'R'));
        }
        if ($y === 0) {
            $max = max($max, getMapResult($input, $x, $y, 'D'));
        }
        if ($x === count($row)-1) {
            $max = max($max, getMapResult($input, $x, $y, 'L'));
        }
        if ($y === count($row)-1) {
            $max = max($max, getMapResult($input, $x, $y, 'U'));
        }
    }
}
echo $max . PHP_EOL;