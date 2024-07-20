<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);

$result = 0;
for ($i = 1; $i < count($input); $i++) {
    if ($input[$i] > $input[$i - 1]) {
        $result++;
    }
}
echo $result . PHP_EOL;