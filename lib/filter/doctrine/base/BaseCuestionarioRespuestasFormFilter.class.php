<?php

/**
 * CuestionarioRespuestas filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCuestionarioRespuestasFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'respuesta1'      => new sfWidgetFormFilterInput(),
      'respuesta2'      => new sfWidgetFormFilterInput(),
      'respuesta3'      => new sfWidgetFormFilterInput(),
      'respuesta4'      => new sfWidgetFormFilterInput(),
      'respuesta5'      => new sfWidgetFormFilterInput(),
      'respuesta6'      => new sfWidgetFormFilterInput(),
      'respuesta7'      => new sfWidgetFormFilterInput(),
      'respuesta8'      => new sfWidgetFormFilterInput(),
      'respuesta9'      => new sfWidgetFormFilterInput(),
      'respuesta10'     => new sfWidgetFormFilterInput(),
      'respuesta11'     => new sfWidgetFormFilterInput(),
      'respuesta12'     => new sfWidgetFormFilterInput(),
      'respuesta13'     => new sfWidgetFormFilterInput(),
      'total'           => new sfWidgetFormFilterInput(),
      'cuestionario_id' => new sfWidgetFormFilterInput(),
      'concurso_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Concurso'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'created_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'updated_by'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updator'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'respuesta1'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta2'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta3'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta4'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta5'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta6'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta7'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta8'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta9'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta10'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta11'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta12'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'respuesta13'     => new sfValidatorPass(array('required' => false)),
      'total'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cuestionario_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'concurso_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Concurso'), 'column' => 'id')),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Creator'), 'column' => 'id')),
      'updated_by'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Updator'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('cuestionario_respuestas_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CuestionarioRespuestas';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'respuesta1'      => 'Number',
      'respuesta2'      => 'Number',
      'respuesta3'      => 'Number',
      'respuesta4'      => 'Number',
      'respuesta5'      => 'Number',
      'respuesta6'      => 'Number',
      'respuesta7'      => 'Number',
      'respuesta8'      => 'Number',
      'respuesta9'      => 'Number',
      'respuesta10'     => 'Number',
      'respuesta11'     => 'Number',
      'respuesta12'     => 'Number',
      'respuesta13'     => 'Text',
      'total'           => 'Number',
      'cuestionario_id' => 'Number',
      'concurso_id'     => 'ForeignKey',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
      'created_by'      => 'ForeignKey',
      'updated_by'      => 'ForeignKey',
    );
  }
}
