<?php

$input = file_get_contents('input.txt');
$map = array_map(
    fn (string $line) => str_split($line),
    explode(PHP_EOL, $input)
);

$result = 0;
$coordinates = [];
do {
    $map = removeRolls($map, $coordinates);
    drawMap($map);
    $coordinates = [];
    for ($x = 0; $x < count($map); $x++) {
        for ($y = 0; $y < count($map[$x]); $y++) {
            if ($map[$x][$y] !== '@') {
                continue;
            }
            if (countNeighbourRolls($map, $x, $y) < 4) {
                $result++;
                $coordinates[] = [$x,$y];
            }
        }
    }
} while (!empty($coordinates));


echo $result . PHP_EOL;

function drawMap(array $map): void
{
    echo PHP_EOL . PHP_EOL;

    foreach ($map as $line) {
        echo implode("", $line) . PHP_EOL;
    }

    echo PHP_EOL . PHP_EOL;
}
function removeRolls(array $map, array $coordinates): array
{
    var_dump($coordinates);
    foreach ($coordinates as $coordinate) {
        $map[$coordinate[0]][$coordinate[1]] = '.';
    }
    return $map;
}

function countNeighbourRolls(array $map, int $x, int $y): int
{
    $neighbourRolls = 0;
    for ($i = ($x - 1); $i <= ($x + 1); $i++) {
        for ($j = ($y - 1); $j <= ($y + 1); $j++) {
            if ($i === $x && $j === $y) {
                continue;
            }
            if (isset($map[$i][$j]) && $map[$i][$j] === '@') {
                $neighbourRolls += 1;
            }
        }
    }
    return $neighbourRolls;
}