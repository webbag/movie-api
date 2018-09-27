<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Prophecy\Exception\InvalidArgumentException;

class SumTest extends TestCase
{
    private function sum($a, $b)
    {
        if (!is_int($a) || !is_int($b)) {
            throw new InvalidArgumentException();
        }
        return $a + $b;
    }

    public function testSum()
    {
        $result = $this->sum(10, 10);
        $this->assertEquals($result, 20);
    }

}
