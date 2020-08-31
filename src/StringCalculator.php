<?php


namespace App;


use Exception;

class StringCalculator
{
    const MAX_NUMBER_ALLOWED = 1000;

    protected $delimiter = ",|\\n";

    public function add(string $numbers)
    {
        if (! $numbers) {
            return 0;
        }

        $numbers = $this->generateNumbers($numbers);

        $this->disallowNegativeNumber($numbers);

        $numbers = $this->disRegardNumbersMoreThanAllowed($numbers);

        return array_sum($numbers);
    }

    /**
     * @param array $numbers
     * @return array
     */
    protected function disRegardNumbersMoreThanAllowed(array $numbers)
    {
        return array_filter($numbers, function ($number) {
            return $number <= self::MAX_NUMBER_ALLOWED;
        });
    }

    /**
     * @param string $numbers
     * @return array
     */
    protected function generateNumbers(string $numbers)
    {
        $customDelimiter = "^\/\/(.)\n";

        if (preg_match("/$customDelimiter/", $numbers, $matches)) {
            $this->delimiter = $matches[1];

            $numbers = str_replace($matches[0], '', $numbers);
        };

        $numbers = preg_split("/{$this->delimiter}/", $numbers);

        return $numbers;
    }

    /**
     * @param array $numbers
     * @return void
     * @throws Exception
     */
    protected function disallowNegativeNumber(array $numbers) : void
    {
        foreach ($numbers as $number) {
            if($number < 0) {
                throw new Exception('Negative not allowed');
            }
        }
    }
}
