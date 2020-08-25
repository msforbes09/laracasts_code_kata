<?php


namespace App;


use mysql_xdevapi\Exception;

class RomanNumerals
{
    const NUMERALS = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        1 => 'I',
    ];

    public static function generate($number)
    {
        $value = '';

        if ($number <= 0 || $number >= 4000)
        {
            return false;
        }


        foreach (static::NUMERALS as $numeral => $roman)
        {
            for (;$number >= $numeral; $number -= $numeral)
            {
                $value .= $roman;
            }
        }

        return $value;
    }
}