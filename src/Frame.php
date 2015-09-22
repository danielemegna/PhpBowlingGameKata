<?php

class Frame {
  
  private $firstShot;
  private $secondShot;
  private $nextFrame;

  function __construct($firstShot) {
    $this->firstShot = $firstShot;
    $this->secondShot = null;
    $this->nextFrame = null;
  }

  function getScore() {
    $score = 0;
    $score += $this->spareAdditionalScore();
    $score += $this->strikeAdditionalScore();
    $score += $this->shotsSum();
    return $score;
  }

  private function spareAdditionalScore() {
    if(!$this->isSpare())
      return 0;

    if($this->nextFrame == null)
      return 0;

    return $this->nextFrame->firstShot;
  }

  private function isSpare() {
    return ($this->secondShot > 0 && $this->shotsSum() == 10);
  }

  private function strikeAdditionalScore() {
    if(!$this->isStrike())
      return 0;

    if($this->nextFrame == null)
      return 0;

    return $this->nextFrame->shotsSum();
  }

  private function isStrike() {
    return ($this->firstShot == 10);
  }

  private function shotsSum() {
    return ($this->firstShot + $this->secondShot);
  }

  function getNextFrame() {
    return $this->nextFrame;
  }

  function setNextFrame($frame) {
    $this->nextFrame = $frame;
  }

  function setSecondShot($secondShot) {
    $this->secondShot = $secondShot;
  }

  function isComplete() {
    return $this->firstShot == 10 || $this->secondShot != null;
  }

}
