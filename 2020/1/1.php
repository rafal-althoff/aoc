<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);
$input = array_flip($input);

foreach ($input as $expenseValue => $v) {
    $search = 2020 - $expenseValue;
    if (array_key_exists($search, $input)) {
        echo $expenseValue * $search;
        break;
    }
}