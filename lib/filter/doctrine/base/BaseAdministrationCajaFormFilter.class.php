<?php

/**
 * AdministrationCaja filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdministrationCajaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'expiry_date'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'points_per_cent' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'expiry_date'     => new sfValidatorPass(array('required' => false)),
      'points_per_cent' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('administration_caja_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdministrationCaja';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'expiry_date'     => 'Text',
      'points_per_cent' => 'Number',
    );
  }
}
