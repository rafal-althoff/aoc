<?php

function calculateSupport(array $map): int
{
    $r = 0;
    foreach ($map as $row) {
        foreach ($row as $key => $char) {
            if ($char === 'O') {
                $r += count($row) - $key;
            }
        }
    }
    return $r;
}


function cycle(array $map, array &$cache): array
{
    for ($i = 0; $i < 4; $i ++) {
        $map = rotateMapClockwise($map);
        $map = transformMap($map, $cache);
    }
    return $map;
}

function rotateMapClockwise(array $map): array
{
    return array_map(null, ...array_reverse($map));
}

function transformMap(array $map, array &$cache): array
{
    foreach ($map as $key => $row) {
        $cKey = json_encode($row);
        if (isset($cache[$cKey])) {
            $map[$key] = $cache[$cKey];
            continue;
        }
        $map[$key] = transformRow($row);
        $cache[$cKey] = $map[$key];
    }
    return $map;
}

function transformRow(array $row): array
{
    for ($i = count($row) - 1; $i > 0; $i--) {
        $current = $row[$i];
        $previous = $row[$i-1];
        if ($current === '.' && $previous === 'O') {
            $row[$i] = $previous;
            $row[$i-1] = $current;
            $row = transformRow($row);
        }
    }
    return $row;
}

$map = file_get_contents('input.txt');
$map = explode(PHP_EOL, $map);
foreach ($map as $key => $row) {
    $map[$key] = str_split($row);
}

$cache = [];
$loopEveryStep = 0;
for ($i = 0; $i < 1000000000; $i++) {
    $cKey = json_encode($map);
    if (isset($cache[$cKey])) {
        $loopEveryStep = $i - $cache[$cKey];
        break;
    }
    $cache[$cKey] = $i;
    $map = cycle($map, $cache);
}
$newSteps = (1000000000-$i)%$loopEveryStep;
for ($j=0; $j<$newSteps; $j++) {
    $map = cycle($map, $cache);
}

echo calculateSupport(array_map(null, ...$map)) . PHP_EOL;
