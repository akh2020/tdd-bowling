<?php

namespace Team2020;

class BowlingFrame
{

    private $throw1 = null;
    private $throw2 = null;

    public function roll($pins)
    {
        $score = $this->score();
        if ( $this->throw2 != null )
            throw new \OutOfRangeException ("frame already completed");

        if ( $this->throw1 + $pins > 10 )
            throw new \OverflowException ("2 rolls must stay between 0 and 10, current score is $score, $pins provided.");

        if ( $this->throw1 != null )
            $this->throw2 = $pins;
        else
            $this->throw1 = $pins;
    }

    public function score()
    {
        return $this->throw1 + $this->throw2;
    }
}
