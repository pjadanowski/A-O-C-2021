<?php

use pjadanowski\Aoc2021\Day4\Board;
use pjadanowski\Aoc2021\Day4\Day4;

class Day4Test extends \PHPUnit\Framework\TestCase
{
    public string $input = '';
    private Board $board;

    protected function setUp(): void
    {
        parent::setUp();
        $input = <<<EOD
38 80 23 60 82
25 35 28 47 39
40  0 30 48 76
32 41 49 69  4
13 42 89 20 12
EOD;
        $day4 = new Day4();
        $boards = $day4->buildBoards(explode("\n", $input));
        $this->board = $boards[0];
    }


    public function testItCreatesBoardFromInput()
    {

        $expected = <<<EOD
38 80 23 60 82
25 35 28 47 39
40 0 30 48 76
32 41 49 69 4
13 42 89 20 12
EOD;
        $this->assertSame($expected, $this->board->print());
    }

    public function testItReturnsCorrectColumnIfCompleted()
    {
        // mark second column as completed
        for ($i = 0; $i < count($this->board->fields); $i++) {
            $this->board->fields[$i][1]->setMarked();
        }
//        die(var_dump($this->board->fields));

        $this->assertSame(1, $this->board->checkColumns());
    }

    public function testItChecksCorrectColumn()
    {
        // mark only 4 items in column as completed
        for ($i = 0; $i < count($this->board->fields) - 1; $i++) {
            $this->board->fields[$i][1]->setMarked();
        }

        $this->assertSame(false, $this->board->checkColumns());
    }

    public function testItReturnsCorrectRowIfCompleted()
    {
        // mark second column as completed
        for ($i = 0; $i < count($this->board->fields); $i++) {
            $this->board->fields[3][$i]->setMarked();
        }

        $this->assertSame(3, $this->board->checkRows());
    }


    public function testCheckCompletion()
    {
        // mark second column as completed
        for ($i = 0; $i < count($this->board->fields); $i++) {
            $this->board->fields[$i][0]->setMarked();
        }

        $this->assertTrue($this->board->checkCompletion());
    }

    public function testSumColumnOrRowForRow()
    {
        // first column complete
        for ($i = 0; $i < count($this->board->fields); $i++) {
            $this->board->fields[0][$i]->setMarked();
        }

        $this->assertSame(283, $this->board->sumColumnOrRow());
    }
    public function testSumColumnOrRowForColumn()
    {
        // first column complete
        for ($i = 0; $i < count($this->board->fields); $i++) {
            $this->board->fields[$i][0]->setMarked();
        }

        $this->assertSame(148, $this->board->sumColumnOrRow());
    }

    public function testFinalResultPart1(): void
    {
        $day4 = new Day4();

        $this->assertSame(87456, $day4->part1());
    }

    public function testFinalResultPart2(): void
    {
        $day4 = new Day4();

        $this->assertSame(15561, $day4->part2());
    }
}