<?php

namespace Models;

/**
 * ComplexNumber
 * a+bi,
 * where a, b is real number
 * i is imaginary unit ( i^2 = - 1)
 */
class ComplexNumber
{

    private function __construct(
        private float $a,
        private float $b,
    )
    {
    }

    /**
     * @return float
     */
    public function getA(): float
    {
        return $this->a;
    }

    /**
     * @return float
     */
    public function getB(): float
    {
        return $this->b;
    }

    /**
     * @param float $a
     * @param float $b
     * @return static
     */
    public static function create(float $a, float $b): self
    {
        return new self($a, $b);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "{$this->getA()} + ({$this->getB()}i)";
    }
}