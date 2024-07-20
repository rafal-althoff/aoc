<?php

$input = file_get_contents('input.txt');
$input = explode(PHP_EOL, $input);
$input = array_flip($input);

foreach ($input as $expenseValue => $v) {
    foreach ($input as $expenseValue2 => $v2) {
        if ($expenseValue === $expenseValue2 || $expenseValue + $expenseValue2 > 2020) {
            continue;
        }
        $search = 2020 - ($expenseValue + $expenseValue2);
        if ($search !== $expenseValue && $search !== $expenseValue2 && array_key_exists($search, $input)) {
            echo $expenseValue * $expenseValue2 * $search;
            break 2;
        }
    }
}