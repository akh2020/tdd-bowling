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

    public function testTwoStrikesGame()
    {
        $this->game->roll(1);
        $this->game->roll(2);
        $this->assertEquals(3, $this->game->score(), 'after 1st frame (1,2), the score must be 3');
        $this->game->roll(10);
        $this->assertEquals(13, $this->game->score(), 'after 2nd frame (X), the score must be 13');
        $this->game->roll(10);
        $this->assertEquals(33, $this->game->score(), 'after 3nd frame (X), the score must be 33');
        $this->game->roll(4);
        $this->game->roll(3);
        $this->assertEquals(51, $this->game->score(), 'after 4th frame (4,3), the score must be 51');
        $this->game->roll(7);
        $this->game->roll(3);
        $this->assertEquals(61, $this->game->score(), 'after 5th frame (7,/), the score must be 61');
        $this->game->roll(9);
        $this->game->roll(0);
        $this->assertEquals(79, $this->game->score(), 'after 6th frame (9,0), the score must be 79');
        $this->game->roll(1);
        $this->game->roll(7);
        $this->assertEquals(87, $this->game->score(), 'after 7th frame (1,7), the score must be 87');
        $this->game->roll(2);
        $this->game->roll(6);
        $this->assertEquals(95, $this->game->score(), 'after 8th frame (2,6), the score must be 95');
        $this->game->roll(5);
        $this->game->roll(5);
        $this->assertEquals(105, $this->game->score(), 'after 9th frame (5,/), the score must be 105');
        $this->game->roll(0);
        $this->game->roll(6);
        $this->assertEquals(111, $this->game->score(), 'after the last frame (0,6), the score must be 111');
    }

}
