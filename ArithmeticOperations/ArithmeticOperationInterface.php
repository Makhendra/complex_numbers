<?php

declare(strict_types=1);

namespace ArithmeticOperations;

use Models\ComplexNumber;

interface ArithmeticOperationInterface
{
    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @return ComplexNumber|int|float
     */
    public function calculate(ComplexNumber $a, ComplexNumber $b): ComplexNumber|int|float;
}