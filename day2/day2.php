<?php

include __DIR__ . '/../utils/utils.php';


function part1(): int
{
    $horizontal = 0;
    $depth = 0;

    $arr = openFile(__DIR__ .'/input.txt');

    foreach ($arr as $value) {
        [$command, $value] = explode(' ', $value);

        match ($command) {
            'forward' => $horizontal += (int) $value,
            'up' => $depth -= (int) $value,
            'down' => $depth += (int) $value,
        };
    }

    return $horizontal * $depth;
}

function part2(): int
{
    $horizontal = 0;
    $depth = 0;
    $aim = 0;

    $arr = openFile(__DIR__ .'/input.txt');

    foreach ($arr as $key => $value) {

        [$command, $value] = explode(' ', $value);

        switch ($command) {
            case 'forward':
                $horizontal += (int) $value; 
                $depth += $aim * (int) $value;
                break;
 
            case 'up':
                $depth -= (int) $value;
                break;

            case 'down':
                $depth += (int) $value;
                break;
        };
    }

    return $horizontal * $depth;
}

println('--- part1 ---');
calcExecutionTime();
printResult(part1());
println("Execution time: " . calcExecutionTime());


// -- 
println('--- part2 ---');
calcExecutionTime();
printResult(part2());
println("Execution time: " . calcExecutionTime());

println('');
