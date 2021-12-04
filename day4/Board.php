<?php

namespace pjadanowski\Aoc2021\Day4;

class Board
{
    public array $fields = [];
    public bool $isCompleted = false;

    public function __construct(array $fields)
    {
        foreach ($fields as $i => $row) {
            foreach ($row as $j => $number) {
                $this->fields[$i][$j] = new Field((int)$number);
            }
        }
    }

    public function checkNumber(int $number): bool
    {
        foreach ($this->fields as $i => $row) {
            foreach ($row as $j => $field) {
                if ($field->getNumber() === $number) {
                    $field->setMarked();
                    return true;
                }
            }
        }
        return false;
    }

    public function sumColumnOrRow(): int
    {
        if (($index = $this->checkRows()) !== false) {
            // sum row
            return array_reduce($this->fields[$index], fn($sum, Field $field) => $sum + $field->getNumber(), 0);
        }

        if (($index = $this->checkColumns()) !== false) {
            // sum column
            $sum = 0;
            foreach (range(0, count($this->fields) - 1) as $rowIndex) {
                $sum += $this->fields[$rowIndex][$index]->getNumber();
            }
            return $sum;
        }

        return 0;
    }

    public function checkCompletion(): bool
    {
        $this->isCompleted = $this->checkColumns() !== false || $this->checkRows() !== false;
        return $this->isCompleted;
    }

    /**
     * it returns index of a row or false if not completed
     * @return int|bool
     */
    public function checkRows(): int|bool
    {
        $length = count($this->fields);

        foreach (range(0, $length - 1) as $i) {
            $n = 0;
            foreach (range(0, $length - 1) as $j) {
                if ($this->fields[$i][$j]->marked === true) {
                    $n++;
                }
            }
            if ($n === $length) {
                return $i;
            }
        }
        return false;
    }

    /**
     * it returns index of a column or false if not completed
     * @return int|bool
     */
    public function checkColumns(): int|bool
    {
        $length = count($this->fields);

        foreach (range(0, $length - 1) as $i) {
            $n = 0;
            foreach (range(0, $length - 1) as $j) {
                if ($this->fields[$j][$i]->marked === true) {
                    $n++;
                }
            }
            if ($n === $length) {
                return $i;
            }
        }
        return false;
    }

    public function sumUnmarked(): int
    {
        $length = count($this->fields);
        $sum = 0;
        foreach (range(0, $length - 1) as $i) {
            foreach (range(0, $length - 1) as $j) {
                if ($this->fields[$i][$j]->marked === false) {
                    $sum += $this->fields[$i][$j]->getNumber();
                }
            }
        }
        return $sum;
    }


    public function print(): string
    {
        $str = '';
        $length = count($this->fields);
        foreach (range(0, $length - 1) as $j) {
            foreach (range(0, $length - 1) as $i) {
                $str .= $this->fields[$j][$i]->getNumber() . ($i < $length - 1 ? ' ' : '');
            }
            $str .= ($j < $length - 1 ? "\n" : '');
        }
        echo $str;
        return $str;
    }
}