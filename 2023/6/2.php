<?php

function getPossibleSolutions(int $time, int $distance): int
{
    $result = 0;
    for ($i = 1; $i < $time; $i++) {
        if ($i * ($time - $i) > $distance) {
            $result++;
        }
    }
    return $result;
}

echo getPossibleSolutions(45977295, 305106211101695) . PHP_EOL;
