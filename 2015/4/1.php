<?php

$input = 'abcdef';

$i = 0;
while (true) {
    $i++;
    if (str_starts_with(md5($input . $i), '00000')) {
        break;
    }
}
echo $i . PHP_EOL;
