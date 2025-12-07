<?php

$input = file_get_contents('input.txt');
$banks = explode(PHP_EOL, $input);

$result = 0;
foreach ($banks as $bank) {
    $bankDigits = str_split($bank);
    $firstDigit = getFirstBankDigit($bankDigits);
    $secondDigit = getSecondBankDigit($bankDigits, $firstDigit);
    $result += (int) "{$firstDigit}{$secondDigit}";
}

echo $result . PHP_EOL;

function getFirstBankDigit(array $bank): int
{
    array_pop($bank);
    return max($bank);
}

function getSecondBankDigit(array $bank, int $max): int
{
    $reducedBank = array_slice(
        $bank,
        array_search($max, $bank) + 1
    );
    return max($reducedBank);
}