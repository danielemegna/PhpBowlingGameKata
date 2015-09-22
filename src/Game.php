<?php

class Game {
 
  private $firstFrame;

  function __construct() {
    $this->firstFrame = null;
  }

  function score() {
    $score = 0;
    $currentFrame = $this->firstFrame;

    $count = 1;
    while($currentFrame != null && $count <= 10) {
      $score += $currentFrame->getScore();
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
      $lastFrame->setSecondShot($knockedDownPins);
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
