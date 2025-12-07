<?php

$input = file_get_contents('input.txt');
[$ranges, $ingredients] = explode(PHP_EOL . PHP_EOL, $input);

$ranges = array_map(
    fn (string $line) => explode('-', $line),
    explode(PHP_EOL, $ranges)
);

$rangesWithoutOverlapping = mergeOverlappingRanges($ranges);

$result = 0;
foreach ($rangesWithoutOverlapping as $range) {
    $result += $range[1] - $range[0] + 1;
}
echo $result . PHP_EOL;

function mergeOverlappingRanges(array $ranges): array
{
    usort($ranges, function(array $a, array $b) {
        return $a[0] <=> $b[0];
    });

    $merged = [];
    foreach ($ranges as $range) {
        if (empty($merged) || end($merged)[1] < $range[0]) {
            $merged[] = $range;
        } else {
            $merged[array_key_last($merged)][1] = max(end($merged)[1], $range[1]);
        }
    }
    return $merged;
}