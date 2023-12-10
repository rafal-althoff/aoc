<?php

$data = file_get_contents('input.txt');

function findNeighbours(array $map, int $x, int $y): array
{
    $result = [];
    if (in_array($map[$y][$x], ['S', '-', 'J', '7']) && isset($map[$y][$x-1]) && in_array($map[$y][$x-1], ['-', 'L', 'F'])) {
        $result[] = [$x-1, $y];
    }
    if (in_array($map[$y][$x], ['S', '-', 'L', 'F']) && isset($map[$y][$x+1]) && in_array($map[$y][$x+1], ['-', 'J', '7'])) {
        $result[] = [$x+1,$y];
    }
    if (in_array($map[$y][$x], ['S', '|', 'L', 'J']) && isset($map[$y-1][$x]) && in_array($map[$y-1][$x], ['|', '7', 'F'])) {
        $result[] = [$x, $y-1];
    }
    if (in_array($map[$y][$x], ['S', '|', '7', 'F']) && isset($map[$y+1][$x]) && in_array($map[$y+1][$x], ['|', 'L', 'J'])) {
        $result[] = [$x, $y+1];
    }
    return $result;
}

$data = explode(PHP_EOL, $data);
$startingPosition = null;
foreach ($data as $key => $row) {
    $data[$key] = str_split($row);
    $position = array_search('S', $data[$key]);
    if (is_int($position)) {
        $startingPosition = [$position, $key];
    }
}

$positions = findNeighbours($data, $startingPosition[0], $startingPosition[1]);
$r = 1;
while (true) {
    foreach ($positions as $key => $position) {
        $newPosition = findNeighbours($data, $position[0], $position[1]);
        $data[$position[1]][$position[0]] = 'S';
        if (empty($newPosition)) {
            break;
        }
        $positions[$key] = $newPosition[0];
    }
    $r++;
    if ($positions[0] == $positions[1]) {
        break;
    }
}
echo $r . PHP_EOL;