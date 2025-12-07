<?php

$input = file_get_contents('input.txt');
$lines = array_map(
    fn (string $line) => explode(' ', preg_replace('/\s+/', ' ', trim($line))),
    explode(PHP_EOL, $input)
);


$result = 0;
for ($i = 0; $i < count($lines[0]); $i++) {
    $numbers = getNumbers($lines, $i);
    if (end($lines)[$i] === '+') {
        $result += array_sum($numbers);
    }
    if (end($lines)[$i] === '*') {
        $result += array_product($numbers);
    }
}
echo $result . PHP_EOL;

function getNumbers(array $data, int $index): array
{
    $numbers = array_column($data, $index);
    array_pop($numbers);
    return $numbers;
}