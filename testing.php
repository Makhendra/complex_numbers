<?php

require __DIR__. '/vendor/autoload.php';

use Tests\TestAddition;
use Tests\TestDivision;
use Tests\TestMultipleOperations;
use Tests\TestMultiplication;
use Tests\TestSubtraction;

(new TestAddition())->test();
(new TestSubtraction())->test();
(new TestMultiplication())->test();
(new TestDivision())->test();
(new TestMultipleOperations())->test();
