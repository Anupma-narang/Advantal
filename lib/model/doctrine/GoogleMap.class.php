<?php

/**
 * GoogleMap
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    symfony
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class GoogleMap extends BaseGoogleMap
{

    public function getLink()
    {
        $path = 'http://maps.google.com/?';
        $params = sprintf('ll=%s,%s&z=%s',  $this->getLng(), $this->getLat(), $this->getZoom());

        return $path . $params;

    }
}
