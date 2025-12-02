<?php

$input = file_get_contents('input.txt');
$ranges = explode(',', $input);

$badIds = [];
foreach ($ranges as $range) {
    [$start, $end] = explode('-', $range);
    for ($i = $start; $i <= $end; $i++) {
        if (isBadId((string) $i)) {
            $badIds[] = $i;
        }
    }
}

echo array_sum($badIds) . PHP_EOL;

function isBadId(string $id): bool
{
    $max = (int) floor(strlen($id) / 2);
    for ($i = 1; $i <= $max; $i++) {
        if (strlen($id) % $i !== 0) {
            continue;
        }
        $regex = '/^(' . substr($id, 0, $i) . ')+$/';
        if (preg_match($regex, $id) === 1) {
            return true;
        }
    }
    return false;
}