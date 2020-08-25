<?php


use App\PrimeFactor;
use PHPUnit\Framework\TestCase;

class PrimeFactorTest extends TestCase
{
    /**
     * @test
     * @dataProvider factors
     */
    public function it_generates_prime_factor($number, $factor)
    {
        $factors = new PrimeFactor;

        $this->assertEquals($factor, $factors->generate($number));
    }

    public function factors()
    {
        return [
           [1, []],
           [2, [2]],
           [3, [3]],
           [4, [2, 2]],
           [5, [5]],
           [6, [2, 3]],
           [8, [2, 2, 2]],
           [25, [5, 5]],
           [100, [2, 2, 5, 5]],
           [2568, [2, 2, 2, 3, 107]],
        ];
    }
}
