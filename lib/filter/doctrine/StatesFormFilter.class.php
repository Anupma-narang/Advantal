<?php

/**
 * States filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class StatesFormFilter extends BaseStatesFormFilter
{
  public function configure()
  {
      $this->widgetSchema['orden'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 3, 'class' => 'tamano_3_c'));
  }
}
