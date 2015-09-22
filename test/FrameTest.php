<?php

include __DIR__ . '/../src/Frame.php';

class FrameTest extends PHPUnit_Framework_TestCase {

  private $frame;

  function testFrameCanReturnItsScore() {
    $this->initFrame(3);

    $this->assertEquals(3, $this->frame->getScore());
  }

  function testFrameCanHaveTwoShots() {
    $this->initFrame(2);
    $this->frame->setSecondShot(5);

    $this->assertEquals(2 + 5, $this->frame->getScore());
  }

  function testFrameIsCompleteWhenItHasTwoShots() {
    $this->initFrame(5);
    $this->frame->setSecondShot(3);

    $this->assertTrue($this->frame->isComplete());
  }

  function testFrameIsNotCompleteWithoutSecondShot() {
    $this->initFrame(3);

    $this->assertFalse($this->frame->isComplete());
  }

  function testSpareTestCase() {
    $this->initFrame(6);
    $this->frame->setSecondShot(4);

    $nextFrame = new Frame(5);
    $this->frame->setNextFrame($nextFrame);
    $nextFrame->setSecondShot(2);

    $this->assertEquals(6 + 4 + 5, $this->frame->getScore());
  }

  function testWithFirstShot10_FrameIsComplete() {
    $this->initFrame(10);
    $this->assertTrue($this->frame->isComplete());
  }

  private function initFrame($firstShotScore) {
    $this->frame = new Frame($firstShotScore);
  }

}
