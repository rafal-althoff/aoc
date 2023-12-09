<?php

$data = file_get_contents('input.txt');
$data = explode(PHP_EOL, $data);

function processRow(array $in): array
{
    $result = [];
    for ($i = 0; $i < count($in) - 1; $i++) {
        $result[] = $in[$i+1] - $in[$i];
    }
    return $result;
}

$result = 0;
foreach ($data as $row) {
    $row = explode(' ', $row);
    $rowData = [0 => $row];
    for ($i = 0; $i < count($row) -1; $i++) {
        $rowData[$i+1] = processRow($rowData[$i]);
        if (count(array_unique($rowData[$i+1])) == 1) {
            break;
        }
    }
    $nextOne = 0;
    foreach ($rowData as $data) {
        $nextOne += end($data);
    }
    $result += $nextOne;
}
echo $result . PHP_EOL;