<?php

/**
 * ColaboradorPuntoDefinicion filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ColaboradorPuntoDefinicionFormFilter extends BaseColaboradorPuntoDefinicionFormFilter
{
  public function configure()
  {
        $i18n = sfContext::getInstance()->getI18N();
		
  	$this->widgetSchema['descripcion'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('size'=>70, 'maxlength'=>70, 'class' => 'tamano_40_c'));
        $this->widgetSchema['puntos'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('size'=>6, 'maxlength'=>10, 'class' => 'tamano_10_c'));
	$this->widgetSchema['is_automatic'] = new sfWidgetFormChoice(array('choices' => array('' => 'si o no', 1 => 'si', 0 => 'no')));
        $this->widgetSchema['codigo'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength'=>40, 'class' => 'tamano_20_c'));
        
        
        $this->validatorSchema['puntos'] = new sfValidatorSchemaFilter('text', new sfValidatorString(array('required' => false)));
  }
}
