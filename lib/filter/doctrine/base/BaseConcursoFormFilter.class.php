<?php

/**
 * Concurso filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConcursoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'incidencia'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'concurso_estado_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoEstado'), 'add_empty' => true)),
      'concurso_tipo_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoTipo'), 'add_empty' => true)),
      'empresa_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => true)),
      'producto_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'concurso_categoria_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCategoria'), 'add_empty' => true)),
      'fecha_activacion'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_referendum'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_revision'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_deliberacion'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_observacion'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_cerrado'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_rechazado'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_nulo'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'revision_last_state_id' => new sfWidgetFormFilterInput(),
      'road_type_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
      'states_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
      'city_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'concurso_address'       => new sfWidgetFormFilterInput(),
      'concurso_numero'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'concurso_piso'          => new sfWidgetFormFilterInput(),
      'concurso_puerta'        => new sfWidgetFormFilterInput(),
      'user_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'destacado'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fecha_destacado'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cuestionario_id'        => new sfWidgetFormFilterInput(),
      'cuestionario_total'     => new sfWidgetFormFilterInput(),
      'featured'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'featured_order'         => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'                   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'incidencia'             => new sfValidatorPass(array('required' => false)),
      'concurso_estado_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ConcursoEstado'), 'column' => 'id')),
      'concurso_tipo_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ConcursoTipo'), 'column' => 'id')),
      'empresa_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Empresa'), 'column' => 'id')),
      'producto_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'concurso_categoria_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ConcursoCategoria'), 'column' => 'id')),
      'fecha_activacion'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_referendum'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_revision'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_deliberacion'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_observacion'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_cerrado'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_rechazado'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_nulo'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'revision_last_state_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'road_type_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoadType'), 'column' => 'id')),
      'states_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
      'city_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id')),
      'concurso_address'       => new sfValidatorPass(array('required' => false)),
      'concurso_numero'        => new sfValidatorPass(array('required' => false)),
      'concurso_piso'          => new sfValidatorPass(array('required' => false)),
      'concurso_puerta'        => new sfValidatorPass(array('required' => false)),
      'user_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'destacado'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fecha_destacado'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'cuestionario_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cuestionario_total'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'featured'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'featured_order'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'                   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concurso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Concurso';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'name'                   => 'Text',
      'incidencia'             => 'Text',
      'concurso_estado_id'     => 'ForeignKey',
      'concurso_tipo_id'       => 'ForeignKey',
      'empresa_id'             => 'ForeignKey',
      'producto_id'            => 'ForeignKey',
      'concurso_categoria_id'  => 'ForeignKey',
      'fecha_activacion'       => 'Date',
      'fecha_referendum'       => 'Date',
      'fecha_revision'         => 'Date',
      'fecha_deliberacion'     => 'Date',
      'fecha_observacion'      => 'Date',
      'fecha_cerrado'          => 'Date',
      'fecha_rechazado'        => 'Date',
      'fecha_nulo'             => 'Date',
      'revision_last_state_id' => 'Number',
      'road_type_id'           => 'ForeignKey',
      'states_id'              => 'ForeignKey',
      'city_id'                => 'ForeignKey',
      'concurso_address'       => 'Text',
      'concurso_numero'        => 'Text',
      'concurso_piso'          => 'Text',
      'concurso_puerta'        => 'Text',
      'user_id'                => 'ForeignKey',
      'destacado'              => 'Boolean',
      'fecha_destacado'        => 'Date',
      'cuestionario_id'        => 'Number',
      'cuestionario_total'     => 'Number',
      'featured'               => 'Boolean',
      'featured_order'         => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'slug'                   => 'Text',
    );
  }
}
