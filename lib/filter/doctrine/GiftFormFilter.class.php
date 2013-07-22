<?php

/**
 * Gift filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GiftFormFilter extends BaseGiftFormFilter {

  public function configure() {

    $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_32_c'));
    $this->widgetSchema['require_points'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 10, 'class' => 'tamano_10_c'));
    $this->widgetSchema['hierarchy'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia'), 'add_empty' => 'Selecciona Jerarquía'));
    $this->widgetSchema['featured'] = new sfWidgetFormChoice(array('choices' => array('' => 'si o no', 1 => 'si', 0 => 'no')));
    $this->widgetSchema['orden'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 3, 'class' => 'tamano_3_c'));
    $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));

    $this->validatorSchema['name'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['require_points'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
    $this->validatorSchema['hierarchy'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Jerarquia'), 'column' => 'id', 'multiple' =>  true));
    $this->validatorSchema['featured'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));
    $this->validatorSchema['orden'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['created_at'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59'))));

//    $this->widgetSchema['hierarchy']->setOption('multiple', true);
    
    
  }

}
