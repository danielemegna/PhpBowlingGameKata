<?php

class Game {
 
  private $firstFrame;

  function __construct() {
    $this->firstFrame = null;
  }

  function getScore() {
    $score = 0;
    $currentFrame = $this->firstFrame;

    while($currentFrame != null) {
      $score += $currentFrame->getScore();
      $currentFrame = $currentFrame->getNextFrame();
    }

    return $score;
  }

  function shot($knockedDownPins) {
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
