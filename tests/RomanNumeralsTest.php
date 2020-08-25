<?php


use App\RomanNumerals;
use PHPUnit\Framework\TestCase;

class RomanNumeralsTest extends TestCase
{
    /**
     * @test
     * @dataProvider data
     */
    public function it_generates_roman_numeral($number, $expected)
    {
        $this->assertEquals($expected, RomanNumerals::generate($number));
    }

    /** @test */
    public function it_will_return_false_for_less_than_or_equal_0()
    {
        $this->assertFalse(RomanNumerals::generate(0));
    }

    /** @test */
    public function it_will_return_false_for_greater_than_or_equal_4000()
    {
        $this->assertFalse(RomanNumerals::generate(4000));
    }


    public function data()
    {
        return [
            [1, 'I'],
            [3, 'III'],
            [4, 'IV'],
            [5, 'V'],
            [6, 'VI'],
            [8, 'VIII'],
            [10, 'X'],
            [1991, 'MCMXCI'],
        ];
    }
}
