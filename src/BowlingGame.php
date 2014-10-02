<?php

namespace Team2020;

class BowlingGame
{

    private $frame;
    private $total = 0;
    private $lastStrike;

    public function score()
    {
        return $this->total + $this->frame->score();
    }

    public function roll($pins)
    {
        if ( !is_int ($pins) )
            throw new \InvalidArgumentException ("roll needs an integer between 0 and 10, '$pins' provided.");

        if ( $pins < 0 || $pins > 10 )
            throw new \OutOfRangeException ("roll needs an integer between 0 and 10, '$pins' provided.");

        if ( !$this->frame )
            $this->frame = new BowlingFrame ();

        try {
            $this->frame->roll($pins);

            if ( $this->lastStrike )
                $this->total += $pins;

        } catch ( \OutOfRangeException $e ) {
            $this->lastStrike = $this->frame->isStrike();

            if ( $this->frame->score() === 10 )
                $this->total += $pins;

            $this->total += $this->frame->score();
            $this->frame = new BowlingFrame ();
            $this->frame->roll($pins);
        }
    }
}
