<?php

namespace Team2020;

class BowlingGame
{

    private $score = 0;

    public function score()
    {
        return $this->score;
    }

    public function roll($pins)
    {
        if ( !is_int ($pins) )
            throw new \InvalidArgumentException ("roll needs an integer between 0 and 10, '$pins' provided.");
        if ( $pins < 0 || $pins > 10 )
            throw new \OutOfRangeException ("roll needs an integer between 0 and 10, '$pins' provided.");
        $this->score += $pins;
    }
}
