<?php

include __DIR__ . '/../src/Game.php';

class GameTest extends PHPUnit_Framework_TestCase {

  private $game;

  function setUp() {
    $this->game = new Game();
  }
 
  function testWithoutShots_ScoreIsZero() {
    $this->assertTrue(is_int($this->game->getScore()));
    $this->assertGameScore(0);
  }

  function testSingleShot() {
    $this->game->shot(2);
    $this->assertGameScore(2);
  }

  function testTwoShot() {
    $this->game->shot(3);
    $this->game->shot(1);

    $this->assertGameScore(4);
  }

  function testWithSpareShot_NextShotIsCountedTwice() {
    $this->game->shot(6);
    $this->game->shot(4);

    $this->game->shot(3);
    $this->game->shot(4);

    $this->assertGameScore(10 + (3) + 7);
  }

  function testSpareShotInTheMiddleOfGame() {
    $this->game->shot(1);
    $this->game->shot(3);

    $this->game->shot(6);
    $this->game->shot(4);

    $this->game->shot(2);
    $this->game->shot(3);

    $this->assertGameScore(4 + 10 + (2) + 5);
  }

  function testWithStrikeShot_NextTwoShotsAreCountedTwice() {
    $this->game->shot(10);

    $this->game->shot(3);
    $this->game->shot(5);

    $this->game->shot(5);
    $this->game->shot(4);

    $this->assertGameScore(10 + 8 + (8) + 9);
  }

  private function assertGameScore($expected) {
    $this->assertEquals($expected, $this->game->getScore());
  }

}
