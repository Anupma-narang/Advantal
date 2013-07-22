<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
      $this->dispatcher->connect('alert.new_alert',array('AlertListener', 'createAlert'));

  }
}
