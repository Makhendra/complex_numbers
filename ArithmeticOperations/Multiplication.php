<?php
declare(strict_types=1);

namespace ArithmeticOperations;

use Models\ComplexNumber;

class Multiplication implements ArithmeticOperationInterface
{

    /**
     * @param ComplexNumber $a
     * @param ComplexNumber $b
     * @return ComplexNumber|float
     *
     * (k + fi) * (c + di) = kc + fci + kdi + fdi = (kc + fdi^2) + (fc + kd)i = (kc - fd) + (fc + kd)i
     */
    public function calculate(ComplexNumber $a, ComplexNumber $b): ComplexNumber|float
    {
        $k = $a->getA();
        $c = $b->getA();
        $f = $a->getB();
        $d = $b->getB();

        $real_path_a = $k * $c - $f * $d;
        $real_path_b = $f * $c + $k * $d;

        if ($real_path_b == 0) {
            return $real_path_a;
        }

        return ComplexNumber::create($real_path_a, $real_path_b);
    }
}