<?php

$input = file_get_contents('input.txt');
$lines = explode(PHP_EOL, $input);

$currentPosition = 50;
$result = 0;

foreach ($lines as $line) {
    if (preg_match('/^([LR])(\d+)$/', $line, $matches)) {
        $currentPosition = rotate($currentPosition, $matches[1], $matches[2]);
        if ($currentPosition === 0) {
            $result++;
        }
    }
}

echo $result . PHP_EOL;

function rotate(int $currentPosition, string $direction, int $amount): int
{
    switch ($direction) {
        case ('R'):
            $currentPosition += $amount;
            return $currentPosition % 100;
        case ('L'):
            if ($amount > $currentPosition) {
                $mod = (int) (($amount % 100) > $currentPosition);
                $currentPosition += ((int) floor($amount / 100) + $mod) * 100;
            }
            return $currentPosition - $amount;
    }
}
