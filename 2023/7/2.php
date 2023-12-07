<?php

function cmp(array $a, array $b): int
{
    $a = str_split($a[0]);
    $ac = array_count_values($a);
    $acNJ = array_diff_key($ac, ['J' => 0]);
    $maxA = ($ac['J'] ?? 0) + ($acNJ ? max($acNJ) : 0);

    $b = str_split($b[0]);
    $bc = array_count_values($b);
    $bcNJ = array_diff_key($bc, ['J' => 0]);
    $maxB = ($bc['J'] ?? 0) + ($bcNJ ? max($bcNJ) : 0);

    if ($maxA > $maxB) {
        return 1;
    }
    if ($maxA < $maxB) {
        return -1;
    }

    if ((count($acNJ) ?: 1) < (count($bcNJ) ?: 1)) {
        return 1;
    }
    if ((count($acNJ) ?: 1) > (count($bcNJ) ?: 1)) {
        return -1;
    }
    $mapData = [
        'T' => 10,
        'J' => 0,
        'Q' => 12,
        'K' => 13,
        'A' => 14,
    ];

    foreach ($a as $k => $av) {
        $av = (int)($mapData[$av] ?? $av);
        $bv = (int)($mapData[$b[$k]] ?? $b[$k]);
        if ($av > $bv) {
            return 1;
        }
        if ($bv > $av) {
            return -1;
        }
    }
    return 0;
}

$data = file_get_contents('input.txt');

$data = explode(PHP_EOL, $data);
$formattedData = [];
foreach ($data as $key => $datum) {
    $formattedData[] = explode(' ', $datum);
}

usort($formattedData, 'cmp');

$r = 0;
foreach ($formattedData as $k => $data) {
    $r +=  $data[1] * ($k + 1);
}
echo $r . PHP_EOL;