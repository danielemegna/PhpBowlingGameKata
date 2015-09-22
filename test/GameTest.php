<?php

include __DIR__ . '/../src/Game.php';

class GameTest extends PHPUnit_Framework_TestCase {

  private $game;

  function setUp() {
    $this->game = new Game();
  }
 
  function testWithoutRoll_ScoreIsZero() {
    $this->assertGameScore(0);
  }

  function testSingleRoll() {
    $this->game->roll(2);
    $this->assertGameScore(2);
  }

  function testDoubleRoll() {
    $this->game->roll(3);
    $this->game->roll(1);

    $this->assertGameScore(4);
  }

  function testWithASpare_NextRollIsCountedTwice() {
    $this->game->roll(6);
    $this->game->roll(4);

    $this->game->roll(3);
    $this->game->roll(4);

    $this->assertGameScore(10 + (3) + 7);
  }

  function testSpareInTheMiddleOfGameTestCase() {
    $this->game->roll(1);
    $this->game->roll(3);

    $this->game->roll(6);
    $this->game->roll(4);

    $this->game->roll(2);
    $this->game->roll(3);

    $this->assertGameScore(4 + 10 + (2) + 5);
  }

  function testWithAStrike_NextTwoRollsAreCountedTwice() {
    $this->game->roll(10);

    $this->game->roll(3);
    $this->game->roll(5);

    $this->game->roll(5);
    $this->game->roll(4);

    $this->assertGameScore(10 + 8 + (8) + 9);
  }

  function testTwoConsecutiveStrikes() {
    $this->game->roll(10);

    $this->game->roll(10);

    $this->game->roll(4);
    $this->game->roll(2);

    $this->assertGameScore(10 + (10 + 4) + 10 + (4 + 2) + 6);
  }

  function testPerfectGame() {
    for($i = 0; $i < 12; $i++)
      $this->game->roll(10);

    $this->assertGameScore(300);
  }

  private function assertGameScore($expected) {
    $this->assertEquals($expected, $this->game->score());
  }

}
