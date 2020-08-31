<?php


use App\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    /** @test */
    public function it_evaluates_empty_string_as_0()
    {
        $calculator = new StringCalculator;

        $this->assertSame(0, $calculator->add(''));
    }

    /** @test */
    public function it_finds_the_sum_of_a_single_number()
    {
        $calculator = new StringCalculator;

        $this->assertSame(10, $calculator->add('10'));
    }

    /** @test */
    public function it_finds_the_sum_of_two_numbers()
    {
        $calculator = new StringCalculator;

        $this->assertSame(10, $calculator->add('5,5'));
    }

    /** @test */
    public function it_finds_the_sum_of_any_amount_of_numbers()
    {
        $calculator = new StringCalculator;

        $this->assertSame(45, $calculator->add('5,5,10,25'));
    }

    /** @test */
    public function it_allows_new_line_as_delimiter()
    {
        $calculator = new StringCalculator;

        $this->assertSame(10, $calculator->add("5\n5"));
    }

    /** @test */
    public function it_will_not_allow_negative_numbers()
    {
        $this->expectException(\Exception::class);

        $calculator = new StringCalculator;

        $calculator->add('5,-5');
    }

    /** @test */
    public function it_will_ignore_number_greater_than_1000()
    {
        $calculator = new StringCalculator;

        $this->assertSame(5, $calculator->add('5,1001'));
    }

    /** @test */
    public function it_supports_other_delimiters()
    {
        $calculator = new StringCalculator;

        $this->assertSame(9, $calculator->add("//;\n5;4"));
    }
}
