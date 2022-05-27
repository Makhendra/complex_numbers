<?php

namespace Tests;

use ArithmeticOperations\AllowedArithmeticOperations;
use Exception;
use Models\ComplexNumber;

class TestMultiplication extends TestCommon
{

    public function __construct()
    {
        parent::__construct(AllowedArithmeticOperations::Multiplication);
    }

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @param ComplexNumber|float $c
     * @return void
     * @throws Exception
     */
    protected function associativityRule(ComplexNumber $a, ComplexNumber $b, ComplexNumber|float $c):void {
        $bc = $this->computingService->calculate($b, $c);
        $ab = $this->computingService->calculate($a, $b);

        if( ! $bc instanceof ComplexNumber) {
            $bc = ComplexNumber::create($bc, 0);
        }

        if( ! $ab instanceof ComplexNumber) {
            $ab = ComplexNumber::create($ab, 0);
        }

        $result = $this->computingService->calculate($a, $bc);
        $action = $this->computingService->calculate($ab, $c);
        $this->equal($result, $action);
    }

    /**
     * @param ComplexNumber $a
     * @return void
     * @throws Exception
     */
    protected function zeroRule(ComplexNumber $a): void
    {
        $zero = ComplexNumber::create(0, 0);
        $result = $this->computingService->calculate($a, $zero);
        $this->equal($result, 0);
    }

    /**
     * @param ComplexNumber $a
     * @return void
     * @throws Exception
     */
    protected function unitRule(ComplexNumber $a): void
    {
        $one = ComplexNumber::create(1, 0);
        $result = $this->computingService->calculate($a, $one);
        if ($result instanceof ComplexNumber) {
            $this->equal($result, $a);
        } else {
            $this->equal($result, $a->getA());
        }

    }

    /**
     * @throws Exception
     */
    private function positiveReal(): void
    {
        $a = ComplexNumber::create(2, 0);
        $b = ComplexNumber::create(3, 0);
        $c = ComplexNumber::create(4, 2);

        $this->commutativityRule($a, $b, 6);
        $this->commutativityRule($a, $c, ComplexNumber::create(8, 4));
        $this->commutativityRule($b, $c, ComplexNumber::create(12, 6));

        $this->associativityRule($a, $b, $c);

        $this->zeroRule($a);
        $this->zeroRule($b);
        $this->zeroRule($c);

        $this->unitRule($a);
        $this->unitRule($b);
        $this->unitRule($c);

        $this->success();
    }

    /**
     * @throws Exception
     */
    private function negativeReal(): void
    {
        $a = ComplexNumber::create(-2, 0);
        $b = ComplexNumber::create(-5, 0);
        $c = ComplexNumber::create(-3, 3);

        $this->commutativityRule($a, $b, 10);
        $this->commutativityRule($a, $c, ComplexNumber::create(6, -6));
        $this->commutativityRule($b, $c, ComplexNumber::create(15, -15));

        $this->associativityRule($a, $b, $c);

        $this->zeroRule($a);
        $this->zeroRule($b);
        $this->zeroRule($c);

        $this->unitRule($a);
        $this->unitRule($b);
        $this->unitRule($c);

        $this->success();
    }

    /**
     * @throws Exception
     */
    private function imaginaryPartCheck(): void
    {
        $a = ComplexNumber::create(8, 3.123);
        $b = ComplexNumber::create(2, 0.22);
        $c = ComplexNumber::create(-3, -1.7);

        $this->commutativityRule($a, $b, ComplexNumber::create(15.31294, 8.006));
        $this->commutativityRule($a, $c, ComplexNumber::create(-18.6909, - 22.969));
        $this->commutativityRule($b, $c, ComplexNumber::create(-5.626, - 4.06));

        $this->associativityRule($a, $b, $c);

        $this->zeroRule($a);
        $this->zeroRule($b);
        $this->zeroRule($c);

        $this->unitRule($a);
        $this->unitRule($b);
        $this->unitRule($c);

        $this->success();
    }

    /**
     * @throws Exception
     */
    private function controlTest(): void
    {
        try {
            $a = ComplexNumber::create(3, 6);
            $b = ComplexNumber::create(2, 4);
            $result = $this->computingService->calculate($a, $b);
            $action = ComplexNumber::create(3344, 7.9);
            $this->equal($result, $action);
        } catch (Exception $exception) {
            //
        }

        $a = ComplexNumber::create(3, 6);
        $b = ComplexNumber::create(2, 4);
        $result = $this->computingService->calculate($a, $b);
        $action = ComplexNumber::create(-18, 24);
        $this->equal($result, $action);

        $this->success();
    }

    /**
     * @param ComplexNumber|int|float $result
     * @param ComplexNumber|int|float $action
     * @return void
     * @throws Exception
     */
    protected function equal(ComplexNumber|int|float $result, ComplexNumber|int|float $action): void
    {
        if ($result != $action) {
            $this->error();
        }
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