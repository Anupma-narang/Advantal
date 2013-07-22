<?php

/**
 * Gift filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGiftFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'require_points' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'hierarchy'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia'), 'add_empty' => true)),
      'features'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orden'          => new sfWidgetFormFilterInput(),
      'featured'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'featured_order' => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'           => new sfValidatorPass(array('required' => false)),
      'image'          => new sfValidatorPass(array('required' => false)),
      'require_points' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hierarchy'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Jerarquia'), 'column' => 'id')),
      'features'       => new sfValidatorPass(array('required' => false)),
      'orden'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'featured'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'featured_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('gift_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gift';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'name'           => 'Text',
      'image'          => 'Text',
      'require_points' => 'Number',
      'hierarchy'      => 'ForeignKey',
      'features'       => 'Text',
      'orden'          => 'Number',
      'featured'       => 'Boolean',
      'featured_order' => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
