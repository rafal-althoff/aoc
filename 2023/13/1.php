<?php

$input = file_get_contents('input.txt');

$input = explode(PHP_EOL . PHP_EOL, $input);

function findVerticalReflection(string $map): int
{
    $map = explode(PHP_EOL, $map);
    foreach ($map as $key => $row) {
        $map[$key] = str_split($row);
    }
    $map = array_map(null, ...$map);
    foreach ($map as $key => $row) {
        $map[$key] = implode($row);
    }
    $map = implode(PHP_EOL, $map);
    return findHorizontalReflection($map);
}

function findHorizontalReflection(string $map): int
{
    $map = explode(PHP_EOL, $map);

    $maxI = count($map) - 1;
    for ($i = 0; $i < $maxI; $i++) {
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

$r = 0;
foreach ($input as $map) {
    $r += findHorizontalReflection($map) * 100;
    $r += findVerticalReflection($map);
}
echo PHP_EOL . $r . PHP_EOL;