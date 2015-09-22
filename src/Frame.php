<?php

class Frame {
  
  private $firstRoll;
  private $secondRoll;
  private $nextFrame;

  function __construct($firstRoll) {
    $this->firstRoll = $firstRoll;
    $this->secondRoll = null;
    $this->nextFrame = null;
  }

  function score() {
    return
      $this->rollsSum() +
      $this->spareAdditionalScore() +
      $this->strikeAdditionalScore();
  }

  private function spareAdditionalScore() {
    if(!$this->isSpare())
      return 0;

    if($this->nextFrame == null)
      return 0;

    return $this->nextFrame->firstRoll;
  }

  private function isSpare() {
    return ($this->secondRoll > 0 && $this->rollsSum() == 10);
  }

  private function strikeAdditionalScore() {
    if(!$this->isStrike())
      return 0;

    $nextFrame = $this->nextFrame;
    if($nextFrame == null)
      return 0;

    $additionalScore = $nextFrame->rollsSum();
    if($nextFrame->isStrike())
      $additionalScore += $nextFrame->getNextFrame()->firstRoll;
      
    return $additionalScore;
  }

  private function isStrike() {
    return ($this->firstRoll == 10);
  }

  private function rollsSum() {
    return ($this->firstRoll + $this->secondRoll);
  }

  function getNextFrame() {
    return $this->nextFrame;
  }

  function setNextFrame($frame) {
    $this->nextFrame = $frame;
  }

  function secondRoll($knockedDownPins) {
    $this->secondRoll = $knockedDownPins;
  }

  function isComplete() {
    return $this->firstRoll == 10 || $this->secondRoll != null;
  }
}
