<?php


function openFile(string $filepath): array
{
    $lines = [];
    if ($file = fopen($filepath, "r")) {
        while(!feof($file)) {
            $line = trim(fgets($file));
            if ($line !== '') {
                $lines[] = $line;
            }
        }
        fclose($file);
    }

    return $lines;
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

function printResult(int|float $result): void
{
    println("Result: $result");
}