<?php

$input = file_get_contents('input.txt');

$input = explode(PHP_EOL . PHP_EOL, $input);

function findVerticalReflection(string $map, int $previousSolution = 0): int
{
    $map = transposeMap($map);
    return findHorizontalReflection($map, $previousSolution);
}

function findHorizontalReflection(string $map, int $previousSolution = 0): int
{
    $map = explode(PHP_EOL, $map);

    $maxI = count($map) - 1;
    for ($i = 0; $i < $maxI; $i++) {
        if ($i + 1 === $previousSolution) {
            continue;
        }
        if ($map[$i] !== $map[$i+1]) {
            continue;
        }
        if ($i === 0) {
            return 1;
        }
        if ($i === ($maxI - 1)) {
            return $maxI;
        }

        for ($j = $i - 1; $j >= 0 && $i + 1 + $i - $j < count($map); $j--) {
            if ($map[$j] !== $map[2*$i+1-$j])
            {
                continue 2;
            }
        }
        return $i + 1;
    }
    return 0;
}

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

$r = 0;
foreach ($input as $k => $map) {
    $horizontal = findHorizontalReflection($map);
    $vertical = findVerticalReflection($map);
    for ($i = 0; $i < strlen($map); $i++) {
        $char = substr($map, $i, 1);
        if (!in_array($char, ['#', '.'])) {
            continue;
        }
        $newMap = substr_replace($map, $char === '#' ? '.' : '#', $i, 1);
        $newHorizontal = findHorizontalReflection($newMap, $horizontal);
        if ($newHorizontal !== 0 && $newHorizontal !== $horizontal) {
            $r += $newHorizontal * 100;
            continue 2;
        }
        $newVertical = findVerticalReflection($newMap, $vertical);
        if ($newVertical !== 0 && $newVertical !== $vertical) {
            $r += $newVertical;
            continue 2;
        }
    }
}
echo PHP_EOL . $r . PHP_EOL;