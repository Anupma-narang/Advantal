<?php

/**
 * Contactanos filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContactanosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'     => new sfWidgetFormFilterInput(),
      'user_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'nombre'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido1'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido2'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comentario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero1'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero2'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero3'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero4'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichero5'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'logo'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'status'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'nombre'     => new sfValidatorPass(array('required' => false)),
      'apellido1'  => new sfValidatorPass(array('required' => false)),
      'apellido2'  => new sfValidatorPass(array('required' => false)),
      'email'      => new sfValidatorPass(array('required' => false)),
      'phone'      => new sfValidatorPass(array('required' => false)),
      'comentario' => new sfValidatorPass(array('required' => false)),
      'fichero1'   => new sfValidatorPass(array('required' => false)),
      'fichero2'   => new sfValidatorPass(array('required' => false)),
      'fichero3'   => new sfValidatorPass(array('required' => false)),
      'fichero4'   => new sfValidatorPass(array('required' => false)),
      'fichero5'   => new sfValidatorPass(array('required' => false)),
      'logo'       => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('contactanos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contactanos';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'status'     => 'Number',
      'user_id'    => 'ForeignKey',
      'nombre'     => 'Text',
      'apellido1'  => 'Text',
      'apellido2'  => 'Text',
      'email'      => 'Text',
      'phone'      => 'Text',
      'comentario' => 'Text',
      'fichero1'   => 'Text',
      'fichero2'   => 'Text',
      'fichero3'   => 'Text',
      'fichero4'   => 'Text',
      'fichero5'   => 'Text',
      'logo'       => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
