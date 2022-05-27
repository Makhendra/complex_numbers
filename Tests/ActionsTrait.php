<?php

namespace Tests;

use Exception;
use Models\ComplexNumber;

trait ActionsTrait
{

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
     * @throws Exception
     */
    protected function error()
    {
        $class = get_class($this);
        $method = debug_backtrace()[2]['function'];
        throw new Exception("$class - $method");
    }

    /**
     * @return void
     */
    protected function success(): void
    {
        $class = get_class($this);
        $method = debug_backtrace()[1]['function'];
        echo "\e[32mТест {$method} - {$class} успешно пройден." . PHP_EOL;
    }

    /**
     * @return void
     */
    protected function end():void {
        echo '======================================================='.PHP_EOL;
    }
}