<?php

$file = fopen('input.txt', 'r');
$instructions = str_split(fgets($file));
array_pop($instructions);

fgets($file);

$data = [];
while (!feof($file)) {
    preg_match_all('/[A-Z]{3}/', fgets($file), $matches);
    $data[$matches[0][0]] = [
        'L' => $matches[0][1],
        'R' => $matches[0][2],
    ];
}

$key = 'AAA';
$steps = 0;
while (true) {
    foreach ($instructions as $instruction) {
        $steps++;
        $key = $data[$key][$instruction];
        if ($key === 'ZZZ') {
            echo $steps; exit;
        }
    }
}