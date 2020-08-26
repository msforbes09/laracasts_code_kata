<?php


use App\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /** @test */
    public function a_gutter_game_scores_0()
    {
        $game = new Game;

        foreach(range(1,20) as $roll)
        {
            $game->roll(0);
        }

        $this->assertSame(0, $game->score());
    }

    /** @test */
    public function a_all_ones_game_scores_20()
    {
        $game = new Game;

        foreach(range(1,20) as $roll)
        {
            $game->roll(1);
        }

        $this->assertSame(20, $game->score());
    }

    /** @test */
    public function it_awards_one_roll_bonus_for_a_spare()
    {
        $game = new Game;

        $game->roll(5);
        $game->roll(5); // spare

        $game->roll(8);

        foreach(range(1,17) as $roll)
        {
            $game->roll(0);
        }

        $this->assertSame(26, $game->score());
    }

    /** @test */
    public function it_awards_two_roll_bonus_for_a_strike()
    {
        $game = new Game;

        $game->roll(10); //strike

        $game->roll(5);
        $game->roll(2);

        foreach(range(1,16) as $roll)
        {
            $game->roll(0);
        }

        $this->assertSame(24, $game->score());
    }

    /** @test */
    public function a_spare_in_final_frame_grants_one_extra_roll()
    {
        $game = new Game;

        foreach(range(1,18) as $roll)
        {
            $game->roll(1);
        }

        $game->roll(5);
        $game->roll(5); //spare

        $game->roll(5);

        $this->assertSame(33, $game->score());
    }

    /** @test */
    public function a_strike_in_final_frame_grants_two_extra_roll()
    {
        $game = new Game;

        foreach(range(1,18) as $roll)
        {
            $game->roll(1);
        }

        $game->roll(10); //strike

        $game->roll(10);
        $game->roll(5);

        $this->assertSame(43, $game->score());
    }

    /** @test */
    public function a_perfect_game_scores_300()
    {
        $game = new Game;

        foreach(range(1,10) as $roll)
        {
            $game->roll(10);
        }

        $game->roll(10);
        $game->roll(10);

        $this->assertSame(300, $game->score());
    }
}
