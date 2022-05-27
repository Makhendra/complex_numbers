<?php
declare(strict_types=1);

namespace ArithmeticOperations;

use Exception;
use Models\ComplexNumber;

class Division implements ArithmeticOperationInterface
{

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @return ComplexNumber|float
     * @throws Exception
     */
    public function calculate(ComplexNumber $a, ComplexNumber $b): ComplexNumber|float
    {
        if ($b->getA() == 0 && $b->getB() == 0) {
            throw new Exception('Can\'t divide by zero');
        }

        $k = $a->getA();
        $c = $b->getA();
        $f = $a->getB();
        $d = $b->getB();

        $real_path_a = ($k * $c + $f * $d) / ($c**2 + $d**2);
        $real_path_b = ($f * $c - $k * $d) / ($c**2 + $d**2);

        if ($real_path_b == 0) {
            return $real_path_a;
        }

        return ComplexNumber::create($real_path_a, $real_path_b);
    }
}