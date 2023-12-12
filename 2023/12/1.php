<?php

$input = file_get_contents('input.txt');

$input = explode(PHP_EOL, $input);
foreach ($input as $key => $value) {
    [$string, $numbers] = explode(' ', $value);
    $numbers = explode(',', $numbers);
    $string = preg_replace('/\.+/', '.', $string);
    $input[$key] = [trim($string, '.'), $numbers];
}

function findSolutionsNumber(string $str, array $map): int
{
    if (strlen($str) === array_sum($map) + count($map) - 1) {
        return 1;
    }

    $r = 0;
    $solutions = generateSolutions($str);
    $regex = '/^\.*';
    foreach ($map as $key => $v) {
        $regex .= '#{' . $v . '}';
        if ($key !== array_key_last($map)) {
            $regex .= '\.+';
        }
    }
    $regex .= '\.*$/';
    echo $regex . PHP_EOL;
    foreach ($solutions as $s) {
        $r += preg_match($regex, $s);
    }
    return $r;
}

function generateSolutions(string $str): array
{
    $possibleStrings = [];
    $pos = strpos($str, '?');
    if ($pos === false) {
        return [$str];
    }
    $dotString = substr_replace($str,".", $pos, 1);
    $possibleStrings = array_merge($possibleStrings, generateSolutions($dotString));

    $hashString = substr_replace($str,"#", $pos, 1);
    return array_merge($possibleStrings, generateSolutions($hashString));
}

$r = 0;
foreach ($input as $data) {
    $r += findSolutionsNumber($data[0], $data[1]);
}
echo PHP_EOL . $r . PHP_EOL;