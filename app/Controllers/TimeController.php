<?php

namespace App\Controllers;

Class TimeController{

  private $timeStart;
  private $timeEnd;

  public function setTime(&$time)
  {
    $time = microtime(true);
  }

  function calculateTime()
  {
    echo "\n".($this->timeEnd - $this->timeStart)."\n";
  }

  public function setTimeStart()
  {
    $this->setTime($this->timeStart);
  }

  public function setTimeEnd()
  {
    $this->setTime($this->timeEnd);
  }
}
