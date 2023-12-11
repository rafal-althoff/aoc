<?php

$data = file_get_contents('input.txt');
$data = explode(PHP_EOL, $data);

$positions = [];
foreach ($data as $yPosition => $row) {
    $data[$yPosition] = str_split($row);
    $xPositions = array_keys($data[$yPosition], '#');
    foreach ($xPositions as $xPosition) {
        $positions[] = [$xPosition, $yPosition];
    }
}

$xPosToExpand = array_diff(range(0, count($data)-1), array_unique(array_column($positions, 0)));
$yPosToExpand = array_diff(range(0, count($data[0])-1), array_unique(array_column($positions, 1)));

$r = 0;
while (true)
{
    $currentPos = array_pop($positions);
    if ($currentPos === null) {
        break;
    }
    foreach ($positions as $p) {
        $startX = min($currentPos[0], $p[0]);
        $endX = max($currentPos[0], $p[0]);
        foreach ($xPosToExpand as $x) {
            if ($startX < $x && $x < $endX) {
                $r += 999999;
            }
        }
        $startY = min($currentPos[1], $p[1]);
        $endY = max($currentPos[1], $p[1]);
        foreach ($yPosToExpand as $y) {
            if ($startY < $y && $y < $endY) {
                $r += 999999;
            }
        }
        $r += $endX - $startX + $endY - $startY;
    }
}

echo $r . PHP_EOL;
