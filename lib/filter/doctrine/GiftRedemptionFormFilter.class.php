<?php

/**
 * GiftRedemption filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GiftRedemptionFormFilter extends BaseGiftRedemptionFormFilter {

  public function configure() {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));

    $this->widgetSchema['name'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));

    $this->widgetSchema['gift'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gift'), 'add_empty' => 'Selecciona regalo'),array('class' => 'tamano_70_c','style' => 'max-width:300px;width:300px;'));

    $this->widgetSchema['states_id'] = new sfWidgetFormDoctrineChoice(array(
                'model' => 'States',
                'add_empty' => 'Selecciona provincia',
                'order_by' => array('orden', 'ASC')), array('style' => 'width:300px;'));
    $this->widgetSchema['city_id'] = new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'City',
                'depends' => 'States',
                'ajax' => true,
                'add_empty' => 'Selecciona localidad',
            ), array('style' => 'width:300px;'));
    
    $this->widgetSchema['user'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => __('Selecciona Usuario')), array('style' => 'width:300px;'));
    $this->widgetSchema['status'] = new sfWidgetFormChoice(array('choices' => array(0 => 'Todas',1 => 'Revista', 2 => 'Enviado', 3 => 'Entregado')));
    $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));

    $this->widgetSchema['user'] =  new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_40_c'));
    $this->validatorSchema['user'] = new sfValidatorString(array('required' => false));


    $this->widgetSchema->moveField('city_id', 'after', 'states_id');
    

    $this->validatorSchema['name'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['gift'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gift'), 'column' => 'id'));
    $this->validatorSchema['states_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id'));
    $this->validatorSchema['city_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id'));
    $this->validatorSchema['status'] = new sfValidatorChoice(array('required' => true, 'choices' => array(0,1, 2, 3)));
    $this->validatorSchema['created_at'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59'))));
  }

}
