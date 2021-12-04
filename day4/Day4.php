<?php

namespace pjadanowski\Aoc2021\Day4;

class Day4
{
    public function part1(): int
    {
        $lines = openFile(__DIR__ . '/input.txt');

        $numbers = explode(',', array_shift($lines));

        /** @var Board[] */
        $boards = $this->buildBoards($lines);

        return $this->checkForNumbers($boards, $numbers);
    }

    public function checkBoards(array &$boards, $number): array
    {
        $completedIndexes = [];
        foreach ($boards as $index => $board) {
            $exists = $board->checkNumber($number);
            if (!$exists) {
                continue;
            }

            $completed = $board->checkCompletion($number);

            if ($completed) {
                $completedIndexes[] = $index;
            }
        }
        return $completedIndexes;
    }

    public function buildBoards(array $lines)
    {
        $boards = [];
        for ($i = 0; $i < count($lines) - 1; $i += 5) {
            $boards[] = new Board(
                $this->buildBoard($lines[$i], $lines[$i + 1], $lines[$i + 2], $lines[$i + 3], $lines[$i + 4])
            );
        }

        return $boards;
    }

    public function buildBoard(...$lines)
    {
        return array_map(fn($line) => $result[] = preg_split("/\s+/", $line), $lines);
    }

    private function checkForNumbers(array $boards, array $numbers, bool $firstWins = true): int
    {
        foreach ($numbers as $n => $number) {
            $boardsNotCompleted = $this->boardsNotCompleted($boards);
            $completedIndexes = $this->checkBoards($boardsNotCompleted, (int)$number);

            if (count($completedIndexes) > 0 && $firstWins) {
                return ($boards[$completedIndexes[0]]->sumUnmarked()) * $number;
            }

            if (!$firstWins && count($boardsNotCompleted) === 1 && count($completedIndexes) > 0) {
                return ($boards[$completedIndexes[0]]->sumUnmarked()) * $number;
            }
        }

        return 0;
    }

    public function part2(): int
    {
        $lines = openFile(__DIR__ . '/input.txt');

        $numbers = explode(',', array_shift($lines));

        /** @var Board[] */
        $boards = $this->buildBoards($lines);

        return $this->checkForNumbers($boards, $numbers, false);
    }

    private function boardsNotCompleted(array $boards)
    {
        $n = 0;
        return array_filter($boards, fn(Board $b) => !$b->isCompleted);
    }
}

