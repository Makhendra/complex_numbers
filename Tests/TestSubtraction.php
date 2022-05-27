<?php

namespace Tests;

use ArithmeticOperations\AllowedArithmeticOperations;
use Exception;
use Models\ComplexNumber;
use Services\ComputingComplexNumbers;

class TestSubtraction extends TestCommon
{
    public function __construct()
    {
        parent::__construct(AllowedArithmeticOperations::Subtraction);
    }

    /**
     * @param ComplexNumber $element
     * @return void
     * @throws Exception
     */
    protected function oppositeElement(ComplexNumber $element): void
    {
        $opposite = ComplexNumber::create($element->getA(), $element->getB());
        $result = $this->computingService->calculate($element, $opposite);
        $this->equal($result, 0);
    }

    /**
     * @throws Exception
     */
    private function positiveReal(): void
    {
        $a = ComplexNumber::create(1, 0);
        $b = ComplexNumber::create(2, 0);
        $c = ComplexNumber::create(3, 0);

        $this->zeroRule($a);
        $this->zeroRule($b);
        $this->zeroRule($c);

        $this->oppositeElement($a);
        $this->oppositeElement($b);
        $this->oppositeElement($c);

        $this->success();
    }

    /**
     * @throws Exception
     */
    private function negativeReal(): void
    {
        $a = ComplexNumber::create(-1, 0);
        $b = ComplexNumber::create(-2, 0);
        $c = ComplexNumber::create(-3, 0);

        $this->zeroRule($a);
        $this->zeroRule($b);
        $this->zeroRule($c);

        $this->oppositeElement($a);
        $this->oppositeElement($b);
        $this->oppositeElement($c);

        $this->success();
    }

    /**
     * @throws Exception
     */
    private function imaginaryPartCheck(): void
    {
        $a = ComplexNumber::create(2, 3);
        $b = ComplexNumber::create(5, 4.5);
        $c = ComplexNumber::create(-1, -1);

        $this->zeroRule($a);
        $this->zeroRule($b);
        $this->zeroRule($c);

        $this->oppositeElement($a);
        $this->oppositeElement($b);
        $this->oppositeElement($c);

        $this->success();
    }

    /**
     * @throws Exception
     */
    public function controlTest() :void {
        try {
            $a = ComplexNumber::create(10, 10);
            $b = ComplexNumber::create(5, 5.5);
            $action = ComplexNumber::create(110, 20);
            $result = $this->computingService->calculate($a, $b);
            $this->equal($action, $result);
        } catch (Exception $exception) {
            // все верно (10 + 10i) - (5 + 5.5i) = (5 + 4.5i) != 110 + 20i
        }

        try {
            $a = ComplexNumber::create(0, 33);
            $b = ComplexNumber::create(0, 0);
            $action = ComplexNumber::create(0, 10);
            $result = $this->computingService->calculate($a, $b);
            $this->equal($action, $result);
        } catch (Exception $exception) {
            // все верно (0 + 33i) - 0 = 0 != (0 + 10i)
        }


        $a = ComplexNumber::create(1, 3);
        $b = ComplexNumber::create(-1.001, 0);
        $action = ComplexNumber::create((1 + 1.001), 3);
        $result = $this->computingService->calculate($a, $b);
        $this->equal($action, $result);


        $this->success();
    }

    /**
     * @return void
     */
    public function test(): void
    {
        try {
            $this->positiveReal();
            $this->negativeReal();
            $this->imaginaryPartCheck();
            $this->controlTest();
            $this->end();
        } catch (Exception $exception) {
            echo "\e[31mТесты не пройдены, ошибка в {$exception->getMessage()}";
        }
    }
}