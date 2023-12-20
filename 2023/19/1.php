<?php

$data = file_get_contents('input.txt');
$data = explode(PHP_EOL.PHP_EOL, $data);

$rawWorkflows = explode(PHP_EOL, $data[0]);
$rawParts = explode(PHP_EOL, $data[1]);

$workflows = [];
foreach ($rawWorkflows as $rawWorkflow) {
    $workflowBracketPosition = strpos($rawWorkflow, '{');
    $key = substr($rawWorkflow, 0, $workflowBracketPosition);
    $workflows[$key] = substr($rawWorkflow, $workflowBracketPosition+1, -1);
}

$parts = [];
foreach ($rawParts as $part) {
    preg_match_all('/\d+/', $part, $numbers);
    preg_match_all('/(\D)=/', $part, $names);
    $parts[] = array_combine($names[1], $numbers[0]);
}

$accepted = 0;
foreach ($parts as $part) {
    $workflow = $workflows['in'];
    while (true) {
        $workflowKey = processWorkflow($part, $workflow);
        if ($workflowKey === 'A') {
            $accepted += array_sum($part);
            break;
        }
        if ($workflowKey === 'R') {
            break;
        }
        $workflow = $workflows[$workflowKey];
    }
}

function processWorkflow(array $part, string $workflow): string
{
    $steps = explode(',', $workflow);
    foreach ($steps as $step) {
        if (!str_contains($step, ':')) {
            return $step;
        }
        [$instruction, $targetStep] = explode(':', $step);
        preg_match('/([xmas])([<>])(\d+)/', $instruction, $matches);
        if (version_compare($part[$matches[1]], $matches[3], $matches[2])) {
            return $targetStep;
        }
    }
}

echo $accepted . PHP_EOL;