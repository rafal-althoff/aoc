<?php

$input = file_get_contents('input.txt');
$ranges = explode(',', $input);

$badIds = [];
foreach ($ranges as $range) {
    [$start, $end] = explode('-', $range);
    for ($i = $start; $i <= $end; $i++) {
        if (strlen($i) % 2 === 1) {
            $i = (int) ('1' . str_pad('0', strlen($i), '0'));
        } else {
            [$firstHalf, $secondHalf] = str_split($i, strlen($i) / 2);
            if ($firstHalf === $secondHalf) {
                $badIds[] = $i;
            }
        }
    }
}

echo array_sum($badIds) . PHP_EOL;
