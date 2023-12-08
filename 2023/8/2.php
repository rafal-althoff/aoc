<?php

$file = fopen('input.txt', 'r');
$instructions = str_split(fgets($file));
array_pop($instructions);

fgets($file);

$data = [];
while (!feof($file)) {
    preg_match_all('/[\dA-Z]{3}/', fgets($file), $matches);
    $data[$matches[0][0]] = [
        'L' => $matches[0][1],
        'R' => $matches[0][2],
    ];
}

$keys = [];
$solutions = [];
foreach ($data as $k => $v) {
    if (str_ends_with($k, 'A')) {
        $keys[] = $k;
        $solutions[] = [];
    }
}


$steps = 0;
while (true) {
    foreach ($instructions as $instruction) {
        $steps++;
        $allEndsWithZ = true;
        foreach ($keys as $id => $key) {
            $keys[$id] = $data[$key][$instruction];
            if (!str_ends_with($keys[$id], 'Z')) {
                $allEndsWithZ = false;
                continue;
            }
            // Add solution for starting point with $id
            $solutions[$id][] = $steps;
        }

        if ($allEndsWithZ) {
            // It is still possible to get solution before catching 2nd solution for all starting points.
            echo $steps;
            exit;
        }
        foreach($solutions as $numbers) {
            if (count($numbers) < 2) {
                // after 2nd solution the 3rd one will be equal to (2nd solution step) - (1st solution step).
                // If we calculate lcm of all(2nd solution step) - (1st solution step), we will get solution for puzzle.
                continue 2;
            }
        }
        // If we get here we have at least 2 solutions for each starting point so go to the next steps.
        break 2;
    }
}


$lcmNumbers = [];
foreach ($solutions as $solution) {
    $lcmNumbers[] = array_pop($solution) - array_pop($solution);
}

$lcm = array_pop($lcmNumbers);
foreach ($lcmNumbers as $lcmNumber) {
    // we need to install php-gmp to use this function.
    $lcm = gmp_lcm($lcm, $lcmNumber);
}
echo $lcm;