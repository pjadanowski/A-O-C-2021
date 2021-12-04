<?php

namespace pjadanowski\Aoc2021\Day4;


class Field
{
    public int $number;
    public bool $marked = false;

    public function __construct(int $number)
    {
        $this->number = $number;
    }

    public function setMarked(): self
    {
        $this->marked = true;
        return $this;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

}