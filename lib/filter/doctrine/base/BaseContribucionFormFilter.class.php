<?php

/**
 * Contribucion filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContribucionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'concurso_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => true)),
      'contribucion_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionEstado'), 'add_empty' => true)),
      'incidencia'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'plan_accion'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resumen'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'principal'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'numero'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'destacado'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fecha_destacado'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'                   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'concurso_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Concurso'), 'column' => 'id')),
      'contribucion_estado_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ContribucionEstado'), 'column' => 'id')),
      'incidencia'             => new sfValidatorPass(array('required' => false)),
      'plan_accion'            => new sfValidatorPass(array('required' => false)),
      'resumen'                => new sfValidatorPass(array('required' => false)),
      'principal'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'numero'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'destacado'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fecha_destacado'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'                   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contribucion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contribucion';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'name'                   => 'Text',
      'concurso_id'            => 'ForeignKey',
      'contribucion_estado_id' => 'ForeignKey',
      'incidencia'             => 'Text',
      'plan_accion'            => 'Text',
      'resumen'                => 'Text',
      'principal'              => 'Boolean',
      'numero'                 => 'Number',
      'user_id'                => 'ForeignKey',
      'destacado'              => 'Boolean',
      'fecha_destacado'        => 'Date',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'slug'                   => 'Text',
    );
  }
}
