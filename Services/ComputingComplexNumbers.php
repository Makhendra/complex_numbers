<?php

declare(strict_types=1);

namespace Services;

use ArithmeticOperations\Addition;
use ArithmeticOperations\AllowedArithmeticOperations as Operations;
use ArithmeticOperations\ArithmeticOperationInterface;
use ArithmeticOperations\Division;
use ArithmeticOperations\Multiplication;
use ArithmeticOperations\Subtraction;
use Models\ComplexNumber;

class ComputingComplexNumbers
{
    private ArithmeticOperationInterface $computing;

    public function __construct(Operations $case)
    {
        match ($case) {
            Operations::Adding => $this->computing = new Addition(),
            Operations::Subtraction => $this->computing = new Subtraction(),
            Operations::Division => $this->computing = new Division(),
            Operations::Multiplication => $this->computing = new Multiplication(),
        };
    }

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @return ComplexNumber|int|float
     */
    public function calculate(ComplexNumber $a, ComplexNumber $b): ComplexNumber|int|float
    {
        return $this->computing->calculate($a, $b);
    }

}