<?php

/**
 * Auditanos filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAuditanosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'     => new sfWidgetFormFilterInput(),
      'usuario'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'email'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone'      => new sfWidgetFormFilterInput(),
      'plan'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero1'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero2'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero3'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero4'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero5'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'status'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'usuario'    => new sfValidatorPass(array('required' => false)),
      'user_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'email'      => new sfValidatorPass(array('required' => false)),
      'phone'      => new sfValidatorPass(array('required' => false)),
      'plan'       => new sfValidatorPass(array('required' => false)),
      'fichero1'   => new sfValidatorPass(array('required' => false)),
      'fichero2'   => new sfValidatorPass(array('required' => false)),
      'fichero3'   => new sfValidatorPass(array('required' => false)),
      'fichero4'   => new sfValidatorPass(array('required' => false)),
      'fichero5'   => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('auditanos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Auditanos';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'status'     => 'Number',
      'usuario'    => 'Text',
      'user_id'    => 'ForeignKey',
      'email'      => 'Text',
      'phone'      => 'Text',
      'plan'       => 'Text',
      'fichero1'   => 'Text',
      'fichero2'   => 'Text',
      'fichero3'   => 'Text',
      'fichero4'   => 'Text',
      'fichero5'   => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
