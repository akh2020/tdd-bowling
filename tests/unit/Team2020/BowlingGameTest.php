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
        $this->assertInstanceof('Team2020\BowlingGame', $this->game);

        $this->assertTrue(method_exists( $this->game, 'score'));
        $this->assertTrue(method_exists( $this->game, 'roll'));
    }
}
