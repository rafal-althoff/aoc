<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);

$perimeter = 0;
$points = [];
$x = $y = 0;
foreach ($input as $k => $row) {
    $input[$k] = explode(' ', $row);
    $direction = substr(trim($input[$k][2], '()'), -1);
    $length = (int)hexdec(substr(trim($input[$k][2], '()'), 0, -1));
    $perimeter += $length;

    if ($direction === '2') {
        $x -= $length;
    }
    if ($direction === '0') {
        $x += $length;
    }
    if ($direction === '3') {
        $y -= $length;
    }
    if ($direction === '1') {
        $y += $length;
    }
    $points[] = [$x, $y];
}

$area = 0;
foreach ($points as $k => $point)
{
    $area += ($points[$k-1][0] ?? 0)  * $point[1] - $point[0] * ($points[$k-1][1] ?? 0);
}
echo ((abs($area) + $perimeter) / 2 + 1) . PHP_EOL;