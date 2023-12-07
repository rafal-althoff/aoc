<?php

function cmp(array $a, array $b): int
{
    $a = str_split($a[0]);
    $ac = array_count_values($a);

    $b = str_split($b[0]);
    $bc = array_count_values($b);

    if (max($ac) > max($bc)) {
        return 1;
    }
    if (max($ac) < max($bc)) {
        return -1;
    }

    if (count($ac) < count($bc)) {
        return 1;
    }
    if (count($ac) > count($bc)) {
        return -1;
    }
    $mapData = [
        'T' => 10,
        'J' => 11,
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