<?php

include __DIR__ . '/../utils/utils.php';


function part1(): int
{
    $measurements = openFile(__DIR__ . '/input.txt');

    $counter = 0;

    for ($i = 1; $i < count($measurements); $i++) {
        if ($measurements[$i - 1] < $measurements[$i]) {
            $counter++;
        }
    }

    return $counter;
}

function part2(): int
{
    $measurements = openFile(__DIR__ . '/input.txt');

    $counter = 0;
    
    for ($i = 0; $i < count($measurements) - 3; $i++) {
        if ($measurements[$i] < $measurements[$i + 3]) {
            $counter++;
        }
    }

    return $counter;
}

println('--- part1 ---');
calcExecutionTime();
printResult(part1());
println("Execution time: " . calcExecutionTime());

println('');
// -- 
println('--- part2 ---');
calcExecutionTime();
printResult(part2());
println("Execution time: " . calcExecutionTime());

println('');
