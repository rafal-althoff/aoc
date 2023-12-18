<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);

$minX = $maxX = $minY = $maxY = 0;
$x = $y = 0;
foreach ($input as $k => $row) {
    $input[$k] = explode(' ', $row);
    $direction = $input[$k][0];
    $length = (int)$input[$k][1];
    if ($direction === 'L') {
        $x -= $length;
        $minX = min($x, $minX);
    }
    if ($direction === 'R') {
        $x += $length;
        $maxX = max($x, $maxX);
    }
    if ($direction === 'U') {
        $y -= $length;
        $minY = min($y, $minY);
    }
    if ($direction === 'D') {
        $y += $length;
        $maxY = max($y, $maxY);
    }
}

$map = [];
for ($y = $minY-1; $y <= $maxY+1; $y++) {
    for ($x = $minX-1; $x <= $maxX+1; $x++) {
        $map[$y][$x] = 0;
    }
}

$x = $y = 0;
foreach ($input as $k => $data) {
    $direction = $data[0];
    $length = (int)$data[1];
    if ($direction === 'L') {
        for ($i = $x; $i >= $x - $length; $i--){
            $map[$y][$i] = 1;
        }
        $x -= $length;
    }
    if ($direction === 'R') {
        for ($i = $x; $i < $length + $x; $i++){
            $map[$y][$i] = 1;
        }
        $x += $length;
    }
    if ($direction === 'U') {
        for ($i = $y; $i >= $y - $length; $i--){
            $map[$i][$x] = 1;
        }
        $y -= $length;
    }
    if ($direction === 'D') {
        for ($i = $y; $i < $length + $y; $i++){
            $map[$i][$x] = 1;
        }
        $y += $length;
    }
}

fillNeighbours($map, $minX-1, $minY-1);

function fillNeighbours(array &$inputData, $x, $y): void
{
    if ($inputData[$y][$x] != 0) {
        return;
    }
    $inputData[$y][$x] = 2;
    if (isset($inputData[$y-1][$x]) && $inputData[$y-1][$x] == 0) {
        fillNeighbours($inputData, $x, $y-1);
    }
    if (isset($inputData[$y][$x-1]) && $inputData[$y][$x-1] == 0) {
        fillNeighbours($inputData, $x-1, $y);
    }
    if (isset($inputData[$y+1][$x]) && $inputData[$y+1][$x] == 0) {
        fillNeighbours($inputData, $x, $y+1);
    }
    if (isset($inputData[$y][$x+1]) && $inputData[$y][$x+1] == 0) {
        fillNeighbours($inputData, $x+1, $y);
    }
}

$r = 0;
foreach ($map as $row) {
    $counts = array_count_values($row);
    $r += ($counts[1] ?? 0) + ($counts[0] ?? 0);
}
echo $r . PHP_EOL;