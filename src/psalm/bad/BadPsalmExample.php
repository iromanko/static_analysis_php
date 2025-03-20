<?php

namespace App\psalm\bad;

class BadPsalmExample
{
    private int $number;

    public function __construct(string $value)
    {
        $this->number = $value; // Error: Expected int, but a string is assigned
    }

    public function add(int $a, int $b): string
    {
        return $a + $b; // Error: Expected string, but an int is returned
    }

    public function getData(): array
    {
        return null; // Error: Expected array, but null is returned
    }
}
