<?php

/**
 * ProductoTipoUno filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoTipoUnoFormFilter extends BaseProductoTipoUnoFormFilter
{
  public function configure()
  {
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
		
        $this->widgetSchema['orden'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 3, 'style' => 'width: 22px;'));
        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 70, 'class' => 'tamano_40_c'));
  }
}
