<?php

include __DIR__ . '/../src/Frame.php';

class FrameTest extends PHPUnit_Framework_TestCase {

  private $frame;

  function testFrameCanReturnItsScore() {
    $this->initFrame(3);
    $this->assertScore(3);
  }

  function testFrameCanHaveTwoRoll() {
    $this->initFrame(2);
    $this->frame->secondRoll(5);

    $this->assertScore(2 + 5);
  }

  function testFrameIsNotCompleteWithoutSecondRoll() {
    $this->initFrame(3);
    $this->assertFalse($this->frame->isComplete());
  }

  function testFrameIsCompleteWhenItHasTwoRoll() {
    $this->initFrame(5);
    $this->frame->secondRoll(3);

    $this->assertTrue($this->frame->isComplete());
  }

  function testSpareTestCase() {
    $this->initFrame(6);
    $this->frame->secondRoll(4);

    $nextFrame = new Frame(5);
    $nextFrame->secondRoll(2);
    $this->frame->setNextFrame($nextFrame);

    $this->assertScore(6 + 4 + 5);
  }

  function testWithFirstRoll10_FrameIsComplete() {
    $this->initFrame(10);
    $this->assertTrue($this->frame->isComplete());
  }

  function testStrikeTestCase() {
    $this->initFrame(10);

    $nextFrame = new Frame(5);
    $nextFrame->secondRoll(2);
    $this->frame->setNextFrame($nextFrame);

    $this->assertScore(10 + (5+2));
  }

  function testDoubleStrikeTestCase() {
    $this->initFrame(10);

    $nextFrame = new Frame(10);
    $this->frame->setNextFrame($nextFrame);

    $anotherFrame = new Frame(1);
    $anotherFrame->secondRoll(2);
    $nextFrame->setNextFrame($anotherFrame);

    $this->assertScore(10 + (10+1));
  }

  private function initFrame($firstRollScore) {
    $this->frame = new Frame($firstRollScore);
  }

  private function assertScore($expected) {
    $this->assertEquals($expected, $this->frame->score());
  }
}
