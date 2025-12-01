<?php

$input = file_get_contents('input.txt');
$lines = explode(PHP_EOL, $input);

$currentPosition = 50;
$result = 0;

foreach ($lines as $line) {
    if (preg_match('/^([LR])(\d+)$/', $line, $matches)) {
        $currentPosition = rotate($currentPosition, $matches[1], $matches[2], $result);
    }
}

echo $result . PHP_EOL;

function rotate(int $currentPosition, string $direction, int $amount, &$result): int
{
    $result += (int) floor($amount / 100);
    $amount = $amount % 100;
    switch ($direction) {
        case ('R'):
            $currentPosition += $amount;
            if ($currentPosition >= 100) {
                $result++;
                $currentPosition -= 100;
            }
            return $currentPosition;
        case ('L'):
            if ($amount === $currentPosition) {
                $result++;
                return $currentPosition - $amount;
            }
            if ($amount > $currentPosition) {
                if ($currentPosition === 0) {
                    $result--;
                }
                $currentPosition += 100;
                $result++;
            }
            return $currentPosition - $amount;
    }
}