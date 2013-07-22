<?php

/**
 * GiftRedemption filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGiftRedemptionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(),
      'surname1'       => new sfWidgetFormFilterInput(),
      'surname2'       => new sfWidgetFormFilterInput(),
      'road_type'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'number'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'floor'          => new sfWidgetFormFilterInput(),
      'door'           => new sfWidgetFormFilterInput(),
      'states_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
      'city_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'cp'             => new sfWidgetFormFilterInput(),
      'contact_number' => new sfWidgetFormFilterInput(),
      'delivery_time'  => new sfWidgetFormFilterInput(),
      'gift'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Gift'), 'add_empty' => true)),
      'user'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'status'         => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'surname1'       => new sfValidatorPass(array('required' => false)),
      'surname2'       => new sfValidatorPass(array('required' => false)),
      'road_type'      => new sfValidatorPass(array('required' => false)),
      'address'        => new sfValidatorPass(array('required' => false)),
      'number'         => new sfValidatorPass(array('required' => false)),
      'floor'          => new sfValidatorPass(array('required' => false)),
      'door'           => new sfValidatorPass(array('required' => false)),
      'states_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
      'city_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id')),
      'cp'             => new sfValidatorPass(array('required' => false)),
      'contact_number' => new sfValidatorPass(array('required' => false)),
      'delivery_time'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gift'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Gift'), 'column' => 'id')),
      'user'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'status'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('gift_redemption_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GiftRedemption';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'name'           => 'Text',
      'surname1'       => 'Text',
      'surname2'       => 'Text',
      'road_type'      => 'Text',
      'address'        => 'Text',
      'number'         => 'Text',
      'floor'          => 'Text',
      'door'           => 'Text',
      'states_id'      => 'ForeignKey',
      'city_id'        => 'ForeignKey',
      'cp'             => 'Text',
      'contact_number' => 'Text',
      'delivery_time'  => 'Number',
      'gift'           => 'ForeignKey',
      'user'           => 'ForeignKey',
      'status'         => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
