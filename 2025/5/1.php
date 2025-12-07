<?php

$input = file_get_contents('input.txt');
[$ranges, $ingredients] = explode(PHP_EOL . PHP_EOL, $input);

$ranges = array_map(
    fn (string $line) => explode('-', $line),
    explode(PHP_EOL, $ranges)
);
$ingredients = explode(PHP_EOL, $ingredients);

$result = 0;
foreach ($ingredients as $ingredient) {
    foreach ($ranges as $range) {
        if ($ingredient >= $range[0] && $ingredient <= $range[1]) {
            $result++;
            continue 2;
        }
    }
}
echo $result . PHP_EOL;