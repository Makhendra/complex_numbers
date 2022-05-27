<?php

namespace Tests;

use ArithmeticOperations\AllowedArithmeticOperations;
use Exception;
use Models\ComplexNumber;
use Services\ComputingComplexNumbers;

class TestCommon
{
    use ActionsTrait;

    protected ComputingComplexNumbers $computingService;

    public function __construct(AllowedArithmeticOperations $operation)
    {
        $this->computingService = new ComputingComplexNumbers($operation);
    }

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @param ComplexNumber|int $action
     * @return void
     * @throws Exception
     */
    protected function commutativityRule(ComplexNumber $a, ComplexNumber $b, ComplexNumber|int $action): void
    {
        $result = $this->computingService->calculate($a, $b);
        $this->equal($result, $action);

        $result = $this->computingService->calculate($b, $a);
        $this->equal($result, $action);
    }

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @param ComplexNumber $c
     * @return void
     * @throws Exception
     */
    protected function associativityRule(ComplexNumber $a, ComplexNumber $b, ComplexNumber $c): void
    {
        $result = $this->computingService->calculate($a, $this->computingService->calculate($b, $c));
        $action = $this->computingService->calculate($this->computingService->calculate($a, $b), $c);
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
        $action = $a;
        $this->equal($result, $action);
    }

}