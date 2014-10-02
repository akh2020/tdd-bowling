<?php

namespace Team2020;

class BowlingGameTest extends \Codeception\TestCase\Test
{
    /**
     * * @var \UnitTester
     * */
    protected $tester;

    protected function _before()
    {
        $this->game = new BowlingGame();
    }

    protected function _after()
    {
    }

    public function testBasics()
    {
        $this->assertInstanceof('Team2020\BowlingGame', $this->game, 'game is a BowlingGame');

        $this->assertTrue(method_exists( $this->game, 'score'), 'BowlingGame has method score');
        $this->assertTrue(method_exists( $this->game, 'roll'), 'BowlingGame has method roll');
    }

    public function testOneRoll()
    {
        $this->game->roll(4);
        $this->assertEquals(4, $this->game->score(), 'when one rolls 4, score is 4');
    }

    public function testRollArg()
    {
        $nbCatchs = 0;
        try {
            $this->game->roll();
        } catch (\ErrorException $expected) {
            ++$nbCatchs;
        }
        try {
            $this->game->roll('not an int');
        } catch (\InvalidArgumentException $expected) {
            ++$nbCatchs;
        }
        try {
            $this->game->roll(3.5);
        } catch (\InvalidArgumentException $expected) {
            ++$nbCatchs;
        }
        if ($nbCatchs != 3)
            $this->fail('roll accept invalid args');
        $nbCatchs = 0;
        try {
            $this->game->roll(11);
        } catch (\OutOfRangeException $expected) {
            ++$nbCatchs;
        }
        try {
            $this->game->roll(-1);
        } catch (\OutOfRangeException $expected) {
            ++$nbCatchs;
        }
        if ($nbCatchs != 2)
            $this->fail('roll accept args out of bound');
    }

    public function testTwoRoll()
    {
        $this->game->roll(1);
        $this->game->roll(2);
        $this->assertEquals(3, $this->game->score(), 'after two rolls of 1 and 2, the score must be 3');
    }

    public function testTwoRollsBound()
    {
        $this->game->roll(5);
        $this->setExpectedException('OverflowException', '2 rolls must stay between 0 and 10, current score is 5, 6 provided.');
        $this->game->roll(6);
    }

    public function testTwoFrames()
    {
        $this->game->roll(3);
        $this->game->roll(6);
        $this->game->roll(4);
        $this->assertEquals(13, $this->game->score(), 'on complete frame of (3, 6) and a roll of 4, score must be 13');
    }

    public function testSpare()
    {
        $this->game->roll(4);
        $this->game->roll(6);
        $this->game->roll(9);
        $this->assertEquals(28, $this->game->score(), 'after a spare (4,6) and a roll of 9, the score must be 28');
    }

    public function testStrike()
    {
        $this->game->roll(10);
        $this->game->roll(5);
        $this->game->roll(3);
        $this->game->roll(8);
        $this->game->roll(1);
        $this->assertEquals(35, $this->game->score(), 'after (X; 5,3; 8,1) score must be 35');
    }
}
