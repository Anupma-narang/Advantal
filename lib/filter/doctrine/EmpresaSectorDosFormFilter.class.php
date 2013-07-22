<?php

/**
 * EmpresaSectorDos filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EmpresaSectorDosFormFilter extends BaseEmpresaSectorDosFormFilter
{
  public function configure()
  {

	$i18n = sfContext::getInstance()->getI18N();
        
        $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));
        $this->widgetSchema['orden'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 3, 'class' => 'tamano_3_c'));
        $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => 'Selecciona sector'));
        
       /* $this->widgetSchema['empresa_sector_uno_id'] = new sfWidgetFormDoctrineDependentSelect(array(
            'model' => $this->getRelatedModelName('EmpresaSectorUno'),
            'add_empty' => 'Selecciona sector'));*/
  }
}
