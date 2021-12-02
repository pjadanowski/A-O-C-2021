<?php


function openFile(string $filepath): array
{
    $arr = [];
    if ($file = fopen($filepath, "r")) {
        while (($line = trim(fgets($file))) !== '') {
            $arr[] = $line;
        }
        fclose($file);
    }

    return $arr;
}


function calcExecutionTime(): ?string
{
    static $startTime = null;
    if (null === $startTime) {
        $startTime = microtime(true);

        return null;
    }

    $result = (microtime(true) - $startTime) * 1000;
    $startTime = null;

    return sprintf('%.4f', $result) . 'ms';
}

function println(string $message): void
{
    print($message) . PHP_EOL;
}

function printResult(int $result): void
{
    println("Result: $result");
}