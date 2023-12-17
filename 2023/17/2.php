<?php

memory_reset_peak_usage();
$start_time = microtime(true);

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, trim($input));

$costs = [];
$unvisited = [];
$m = 0;
foreach ($input as $y => $row) {
    $input[$y] = str_split(trim($row));
    foreach ($input[$y] as $x => $cost) {
        foreach (['L','R','U','D',] as $d) {
            $costs["$x.$y.$d"] = [
                0 => ($x === 0 && $y === 0) ? 0 : PHP_INT_MAX,
                1 => 'X',
                2 => '',
            ];
            $unvisited["$x.$y.$d"] = 1;
        }
    }
}

while (!empty($unvisited)) {
    // Get min unvisited node.
    echo count($unvisited) . ' left' . PHP_EOL;
    $x = $y = null;
    $currentCost = null;
    $previousDirection = null;
    $previousLocations = null;
    foreach ($costs as $k => $v) {
        if (isset($unvisited[$k])) {
            [$x, $y, $d] = explode('.', $k);
            if ($x == count($input[0])-1 && $y == count($input)-1) {
                echo $v[0] . PHP_EOL;
                echo "Execution time: ".round(microtime(true) - $start_time, 4)." seconds\n";
                echo "   Peak memory: ".round(memory_get_peak_usage()/pow(2, 20), 4), " MiB\n\n";exit;
            }
            $currentCost = $v[0];
            $previousDirection = $d;
            $previousLocations = $v[2];
            unset($unvisited[$k]);
            break;
        }
    }

    $cost = $currentCost;
    if ($previousDirection != 'R' && $previousDirection != 'L') {
        for ($i = $x+1; $i < $x+4; $i++) {
            $cost += $input[$y][$i] ?? 0;
        }
        for ($i = $x + 4; $i < $x + 11; $i++) {
            if (!isset($input[$y][$i])) {
                continue;
            }
            $cost += $input[$y][$i];
            if (!isset($unvisited["$i.$y.R"])) {
                continue;
            }
            if ($cost < $costs["$i.$y.R"][0]) {
                $costs["$i.$y.R"][0] = $cost;
                $costs["$i.$y.R"][1] = 'R';
                $costs["$i.$y.R"][2] = $previousLocations . ' ,' . $x.'.'.$y;
            }
        }
    }
    $cost = $currentCost;
    if ($previousDirection != 'L' && $previousDirection != 'R') {
        for ($i = $x-1; $i > $x-4; $i--) {
            $cost += $input[$y][$i] ?? 0;
        }
        for ($i = $x-4; $i > $x - 11; $i--) {
            if (!isset($input[$y][$i])) {
                continue;
            }
            $cost += $input[$y][$i];
            if (!isset($unvisited["$i.$y.L"])) {
                continue;
            }
            if ($cost < $costs["$i.$y.L"][0]) {
                $costs["$i.$y.L"][0] = $cost;
                $costs["$i.$y.L"][1] = 'L';
                $costs["$i.$y.L"][2] = $previousLocations . ' ,' . $x.'.'.$y;
            }
        }
    }

    $cost = $currentCost;
    if ($previousDirection != 'D' && $previousDirection != 'U') {
        for ($i = $y+1; $i < $y+4; $i++) {
            $cost += $input[$i][$x] ?? 0;
        }
        for ($i = $y + 4; $i < $y + 11; $i++) {
            if (!isset($input[$i][$x])) {
                continue;
            }
            $cost += $input[$i][$x];
            if (!isset($unvisited["$x.$i.D"])) {
                continue;
            }
            if ($cost < $costs["$x.$i.D"][0]) {
                $costs["$x.$i.D"][0] = $cost;
                $costs["$x.$i.D"][1] = 'D';
                $costs["$x.$i.D"][2] = $previousLocations . ' ,' . $x.'.'.$y;
            }
        }
    }
    $cost = $currentCost;
    if ($previousDirection != 'U' && $previousDirection != 'D') {
        for ($i = $y-1; $i > $y - 4; $i--) {
            $cost += $input[$i][$x] ?? 0;
        }
        for ($i = $y-4; $i > $y - 11; $i--) {
            if (!isset($input[$i][$x])) {
                continue;
            }
            $cost += $input[$i][$x];
            if (!isset($unvisited["$x.$i.U"])) {
                continue;
            }
            if ($cost < $costs["$x.$i.U"][0]) {
                $costs["$x.$i.U"][0] = $cost;
                $costs["$x.$i.U"][1] = 'U';
                $costs["$x.$i.U"][2] = $previousLocations . ' ,' . $x.'.'.$y;
            }
        }
    }
    uasort($costs, fn ($a, $b) => $a[0] <=> $b[0]);
}