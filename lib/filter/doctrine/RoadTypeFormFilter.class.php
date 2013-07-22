<?php

/**
 * RoadType filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RoadTypeFormFilter extends BaseRoadTypeFormFilter
{
  public function configure()
  {
    $this->widgetSchema['orden'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('size'=>3, 'maxlength'=>3, 'class' => 'tamano_3_c'));
    $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('size'=>3, 'maxlength'=>40, 'class' => 'tamano_20_c'));
  }
}
