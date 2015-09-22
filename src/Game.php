<?php

class Game {
 
  const MAX_FRAME_COUNT = 10;
  private $firstFrame;

  function __construct() {
    $this->firstFrame = null;
  }

  function score() {
    $score = 0;
    $currentFrame = $this->firstFrame;

    $count = 1;
    while($currentFrame != null && $count <= self::MAX_FRAME_COUNT) {
      $score += $currentFrame->score();
      $currentFrame = $currentFrame->getNextFrame();
      $count++;
    }

    return $score;
  }

  function roll($knockedDownPins) {
    $lastFrame = $this->getLastFrame();

    if($lastFrame == null) {
      $this->firstFrame = new Frame($knockedDownPins);
      return;
    } 

    if(!$lastFrame->isComplete()) {
      $lastFrame->secondRoll($knockedDownPins);
      return;
    }

    $lastFrame->setNextFrame(new Frame($knockedDownPins));
  }
  
  private function getLastFrame() {
    return $this->getLastFrameFrom($this->firstFrame);
  }

  private function getLastFrameFrom($frame) {
    if($frame == null || $frame->getNextFrame() == null)
      return $frame;

    return $this->getLastFrameFrom($frame->getNextFrame());
  }
}
