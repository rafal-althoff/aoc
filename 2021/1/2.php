<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);

$mergedDepthMap = [];
for ($i = 0; $i < count($input) - 2; $i++) {
    $mergedDepthMap[$i] = $input[$i] + $input[$i + 1] + $input[$i + 2];
}

$result = 0;
for ($i = 1; $i < count($mergedDepthMap); $i++) {
    if ($mergedDepthMap[$i] > $mergedDepthMap[$i - 1]) {
        $result++;
    }
}
echo $result . PHP_EOL;