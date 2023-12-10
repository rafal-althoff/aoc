<?php

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

function getStartingPipe(array $startingPosition, array $neighbourPositions): string
{
    if ($neighbourPositions[0][1] === $neighbourPositions[1][1]) {
        return '-';
    }
    if ($neighbourPositions[0][0] === $neighbourPositions[1][0]) {
        return '|';
    }
    if ($neighbourPositions[0][0] > $startingPosition[0] || $neighbourPositions[1][0] > $startingPosition[0]) {
        if ($neighbourPositions[0][1] > $startingPosition[1] || $neighbourPositions[1][1] > $startingPosition[1]) {
            return 'F';
        }
        return 'L';
    }
    if ($neighbourPositions[0][0] < $startingPosition[0] || $neighbourPositions[1][0] < $startingPosition[0]) {
        if ($neighbourPositions[0][1] > $startingPosition[1] || $neighbourPositions[1][1] > $startingPosition[1]) {
            return '7';
        }
        return 'J';
    }
}

$data = file_get_contents('input.txt');
$data = explode(PHP_EOL, $data);
$startingPosition = null;
foreach ($data as $key => $row) {
    $data[$key] = str_split($row);
    $position = array_search('S', $data[$key]);
    if (is_int($position)) {
        $startingPosition = [$position, $key];
    }
}

// Clone initial data.
$inputData = $data;

$positions = findNeighbours($data, $startingPosition[0], $startingPosition[1]);
$startingPipe = getStartingPipe($startingPosition, $positions);
while (true) {
    foreach ($positions as $key => $position) {
        $newPosition = findNeighbours($data, $position[0], $position[1]);
        $data[$position[1]][$position[0]] = 'S';
        if (empty($newPosition)) {
            break;
        }
        $positions[$key] = $newPosition[0];
    }
    if ($positions[0] == $positions[1]) {
        $data[$positions[0][1]][$positions[0][0]] = 'S';
        break;
    }
}

// Remove all pipes not used for solution.
foreach ($inputData as $y => $row) {
    foreach ($row as $x => $value) {
        $inputData[$y][$x] = $data[$y][$x] === 'S' ? $value : '.';
    }
}

// Expand data to create direct access to not enclosed tiles.
$expansions = [
    '.' => [
        ['M','M','M'],
        ['M','.','M'],
        ['M','M','M'],
    ],
    '|' => [
        ['M','|','M'],
        ['M','|','M'],
        ['M','|','M'],
    ],
    '-' => [
        ['M','M','M'],
        ['-','-','-'],
        ['M','M','M'],
    ],
    'L' => [
        ['M','|','M'],
        ['M','L','-'],
        ['M','M','M'],
    ],
    'J' => [
        ['M','|','M'],
        ['-','J','M'],
        ['M','M','M'],
    ],
    '7' => [
        ['M','M','M'],
        ['-','7','M'],
        ['M','|','M'],
    ],
    'F' => [
        ['M','M','M'],
        ['M','F','-'],
        ['M','|','M'],
    ],
];
$expansions['S'] = $expansions[$startingPipe];

$expandedInputData = [];
foreach ($inputData as $y => $row) {
    foreach ($row as $x => $value) {
        $expandedCell = $expansions[$value];
        for ($a = 0; $a < count($expandedCell); $a++) {
            for ($b = 0; $b < count($expandedCell[0]); $b++) {
                $expandedInputData[3*$y+$a][3*$x+$b] = $expandedCell[$a][$b];
            }
        }
    }
}
$inputData = $expandedInputData;

function fillNeighbours(array &$inputData, $x, $y): void
{
    if (!in_array($inputData[$y][$x], ['M', '.'])) {
        return;
    }
    $inputData[$y][$x] = 'O';
    // set O for all neighbours.
    if (isset($inputData[$y-1][$x]) && in_array($inputData[$y-1][$x], ['M', '.'])) {
        fillNeighbours($inputData, $x, $y-1);
    }
    if (isset($inputData[$y][$x-1]) && in_array($inputData[$y][$x-1], ['M', '.'])) {
        fillNeighbours($inputData, $x-1, $y);
    }
    if (isset($inputData[$y+1][$x]) && in_array($inputData[$y+1][$x], ['M', '.'])) {
        fillNeighbours($inputData, $x, $y+1);
    }
    if (isset($inputData[$y][$x+1]) && in_array($inputData[$y][$x+1], ['M', '.'])) {
        fillNeighbours($inputData, $x+1, $y);
    }
}

// Fill the data from the borders of the map.
for ($y = 0; $y < count($inputData);$y++) {
    for ($x = 0; $x < count($inputData[0]);$x++) {
        // We only initialise filling from border non solution tiles.
        if (!in_array($inputData[$y][$x], ['.', 'M'])) {
            continue;
        }
        if ($x === 0 || $x === count($inputData[0]) - 1 || $y === 0 || $y === count($inputData)-1) {
            fillNeighbours($inputData, $x, $y);
        }
    }
}

$r = 0;
foreach ($inputData as $row) {
    $values = array_count_values($row);
    $r += $values['.'] ?? 0;
}

echo $r . PHP_EOL;