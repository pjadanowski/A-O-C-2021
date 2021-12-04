<?php

include __DIR__ . '/../utils/utils.php';


function part1()
{
    $arr = openFile(__DIR__ . '/input.txt');

    $gamma = "";
    $elipson = "";


    foreach (range(0, strlen($arr[0]) - 1) as $i) {
        $zeros = 0;
        $ones = 0;

        foreach ($arr as $index => $value) {

            if ($value[$i] === '0') {
                $zeros++;
            } else {
                $ones++;
            }
        }

        if ($zeros > $ones) {
            $gamma = $gamma . '0';
            $elipson = $elipson . '1';
        } else {
            $gamma = $gamma . '1';
            $elipson = $elipson . '0';
        }
    }

    return bindec($gamma) * bindec($elipson);
}

function part2(): int
{
    $lines = openFile(__DIR__ . '/input.txt');
    $lineLength = strlen($lines[0]);

    $oxygen = $lines;

    for ($i = 0; $i < $lineLength; $i++) {
        if (count($oxygen) === 1) break;

        $sum = 0;
        foreach ($oxygen as $ox) {
            $sum += (int)$ox[$i];
        }

        $mostCommon = round($sum / count($oxygen));
        $oxygen = array_filter($oxygen, fn($number) => $number[$i] == $mostCommon);
    }


    $co2 = $lines;
    for ($i = 0; $i < $lineLength; $i++) {
        if (count($co2) == 1) break;

        $sum = 0;
        foreach ($co2 as $c) {
            $sum += (int)$c[$i];
        }
        $leastCommon = (1 - round($sum / count($co2)));
        $co2 = array_filter($co2, fn($number) => $number[$i] == $leastCommon);
    }

    return bindec(array_values($oxygen)[0]) * bindec(array_values($co2)[0]);
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
// 2250414
// 6085575