<?php

/**
 * ProductoTipoTres filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProductoTipoTresFormFilter extends BaseProductoTipoTresFormFilter
{
  public function configure()
  {
      $this->widgetSchema['orden'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 3, 'class' => 'tamano_3_c'));
      $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('maxlength' => 70, 'class' => 'tamano_40_c'));
      
      $this->widgetSchema['producto_tipo_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'add_empty' => 'Selecciona sector'));
        
      $this->widgetSchema['producto_tipo_dos_id'] = new sfWidgetFormDoctrineDependentSelect(array(
        'model' => $this->getRelatedModelName('ProductoTipoDos'),
        'depends' => 'ProductoTipoUno',
        'order_by' => array('orden', 'asc'),
        'add_empty' => 'Selecciona subsector'));
  }
}
