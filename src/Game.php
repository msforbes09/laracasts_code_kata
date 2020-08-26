<?php


namespace App;


class Game
{
    const FRAME_PER_GAME = 10;

    protected $rolls = [];

    /**
     * @param int $pin
     */
    public function roll(int $pin): void
    {
        $this->rolls[] = $pin;
    }

    /**
     * @return int
     */
    public function score(): int
    {
        $score = 0;
        $roll = 0;

        foreach (range(1, self::FRAME_PER_GAME) as $frame)
        {
            if ($this->isStrike($roll)) {
                $score += $this->pinCount($roll) + $this->strikeBonus($roll);

                $roll = $roll + 1;

                continue;
            }

            $score += $this->defaultFrameScore($roll);

            if($this->isSpare($roll)) {
                $score += $this->spareBonus($roll);
            }

            $roll = $roll + 2;
        }


        return $score;
    }

    /**
     * @param $roll
     * @return bool
     */
    protected function isStrike(int $roll): bool
    {
        return $this->pinCount($roll) === 10;
    }

    /**
     * @param int $roll
     * @return bool
     */
    protected function isSpare(int $roll): bool
    {
        return $this->pinCount($roll) + $this->pinCount($roll + 1) === 10;
    }

    /**
     * @param int $roll
     * @return int
     */
    protected function defaultFrameScore(int $roll): int
    {
        return $this->pinCount($roll) + $this->pinCount($roll + 1);
    }

    /**
     * @param int $roll
     * @return mixed
     */
    protected function strikeBonus(int $roll): int
    {
        return $this->pinCount($roll + 1) + $this->pinCount($roll + 2);
    }

    /**
     * @param int $roll
     * @return mixed
     */
    protected function spareBonus(int $roll): int
    {
        return $this->pinCount($roll + 2);
    }

    /**
     * @param $roll
     * @return int
     */
    public function pinCount($roll): int
    {
        return $this->rolls[$roll];
    }
}