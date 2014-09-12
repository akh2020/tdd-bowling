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
}
