<?php

namespace Tests;

use ArithmeticOperations\AllowedArithmeticOperations;
use Exception;
use Models\ComplexNumber;

class TestDivision extends TestCommon
{
    public function __construct()
    {
        parent::__construct(AllowedArithmeticOperations::Division);
    }

    /**
     * @return void
     */
    public function testDivisionByZero():void {
        try {
            $a = ComplexNumber::create(1, 0);
            $b = ComplexNumber::create(0, 0);
            $this->computingService->calculate($a, $b);
        } catch (Exception $exception) {
            $this->success();
        }
    }

    /**
     * @throws Exception
     */
    public function controlTest() :void {
        $a = ComplexNumber::create(1, 0);
        $b = ComplexNumber::create(2, 0);
        $result = $this->computingService->calculate($a, $b);
        $actual = 0.5;

        $this->equal($result, $actual);

        try {
            $actual = 0.77;
            $this->equal($result, $actual);
        } catch (Exception) {
            //
        }

        $a = ComplexNumber::create(4, 2.2);
        $b = ComplexNumber::create(2, 4.4);
        $result = $this->computingService->calculate($a, $b);
        $actual = ComplexNumber::create(0.7568493150684931, -0.5650684931506849);
        $this->equal($result, $actual);

        $this->success();
    }

    /**
     * @return void
     */
    public function test(): void
    {
        try {
            $this->testDivisionByZero();
            $this->controlTest();
            $this->end();
        } catch (Exception $exception) {
            echo "\e[31mТесты не пройдены, ошибка в {$exception->getMessage()}";
        }
    }
}