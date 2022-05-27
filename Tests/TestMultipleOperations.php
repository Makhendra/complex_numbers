<?php

namespace Tests;

use ArithmeticOperations\AllowedArithmeticOperations;
use Exception;
use Models\ComplexNumber;
use Services\ComputingComplexNumbers;

class TestMultipleOperations
{
    use ActionsTrait;

    /**
     * @throws Exception
     *  a - b = a + (-b)
     */
    public function performingSubtractionThroughAddition(): void
    {
        $subtraction = new ComputingComplexNumbers(AllowedArithmeticOperations::Subtraction);
        $addition = new ComputingComplexNumbers(AllowedArithmeticOperations::Adding);
        $multiplication = new ComputingComplexNumbers(AllowedArithmeticOperations::Multiplication);

        $a = ComplexNumber::create(4.4, 1.2);
        $b = ComplexNumber::create(7, 10);
        $negative_unit = ComplexNumber::create(-1, 0);
        $negative_b = $multiplication->calculate($b, $negative_unit);

        $this->equal(
            $subtraction->calculate($a, $b),
            $addition->calculate($a, $negative_b),
        );

        $this->success();
    }

    /**
     * @throws Exception
     *  a ( b + c ) = ab + ac
     */
    public function distributivityOfMultiplicationToAddition(): void
    {
        $addition = new ComputingComplexNumbers(AllowedArithmeticOperations::Adding);
        $multiplication = new ComputingComplexNumbers(AllowedArithmeticOperations::Multiplication);

        $a = ComplexNumber::create(5.5, 0.05);
        $b = ComplexNumber::create(2, 2);
        $c = ComplexNumber::create(3, 1);

        $first = $multiplication->calculate($a, $addition->calculate($b, $c));
        $second = $addition->calculate(
            $multiplication->calculate($a, $b),
            $multiplication->calculate($a, $c)
        );

        $this->equal(
            $first,
            $second
        );

        $this->success();
    }

    /**
     * @return void
     */
    public function test(): void
    {
        try {
            $this->performingSubtractionThroughAddition();
            $this->distributivityOfMultiplicationToAddition();
            $this->end();
        } catch (Exception $exception) {
            echo "\e[31mТесты не пройдены, ошибка в {$exception->getMessage()}";
        }
    }
}