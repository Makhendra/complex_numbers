<?php
declare(strict_types=1);

namespace ArithmeticOperations;

use Models\ComplexNumber;

class Addition implements ArithmeticOperationInterface
{

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @return ComplexNumber|int
     */
    public function calculate(ComplexNumber $a, ComplexNumber $b): ComplexNumber|int
    {
        $real_path_a = $a->getA() + $b->getA();
        $real_path_b = $a->getB() + $b->getB();

        if ($real_path_a == 0 && $real_path_b == 0) {
            return 0;
        }

        return ComplexNumber::create($real_path_a, $real_path_b);
    }
}