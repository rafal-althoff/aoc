<?php

$input = fopen('input.txt', 'r');

$lightsMatrix = array_fill(0, 1000, array_fill(0, 1000, 0));
while (!feof($input)) {
    $instruction = fgets($input);
    preg_match_all('/\d+,\d+/', $instruction, $matches);
    [$x1, $y1] = explode(',', $matches[0][0]);
    [$x2, $y2] = explode(',', $matches[0][1]);
    preg_match('/turn on|turn off|toggle/', $instruction, $operation);
    for ($i = $x1; $i <= $x2; $i++) {
        for ($j = $y1; $j <= $y2; $j++) {
            if ($operation[0] === 'turn on') {
                $lightsMatrix[$i][$j] = 1;
            }
            if ($operation[0] === 'turn off') {
                $lightsMatrix[$i][$j] = 0;
            }
            if ($operation[0] === 'toggle') {
                $lightsMatrix[$i][$j] = (int)!$lightsMatrix[$i][$j];
            }
        }
    }
}

$result = 0;
foreach ($lightsMatrix as $row) {
    $rowSums = array_count_values($row);
    $result += $rowSums[1] ?? 0;
}

echo $result . PHP_EOL;