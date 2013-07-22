<?php

/**
 * Profesional filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfesionalFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name_one'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name_two'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'address'                  => new sfWidgetFormFilterInput(),
      'numero'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'piso'                     => new sfWidgetFormFilterInput(),
      'puerta'                   => new sfWidgetFormFilterInput(),
      'telefono'                 => new sfWidgetFormFilterInput(),
      'email'                    => new sfWidgetFormFilterInput(),
      'destacado'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fecha_destacado'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_activacion'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_referendum'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_revision'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_deliberacion'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_observacion'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_cerrado'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_rechazado'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_nulo'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'revision_last_state_id'   => new sfWidgetFormFilterInput(),
      'profesional_estado_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalEstado'), 'add_empty' => true)),
      'profesional_tipo_uno_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'add_empty' => true)),
      'profesional_tipo_dos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoDos'), 'add_empty' => true)),
      'profesional_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoTres'), 'add_empty' => true)),
      'road_type_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
      'states_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
      'city_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'user_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'active_reason'            => new sfWidgetFormFilterInput(),
      'dividendo'                => new sfWidgetFormFilterInput(),
      'featured'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'featured_order'           => new sfWidgetFormFilterInput(),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'                     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'first_name'               => new sfValidatorPass(array('required' => false)),
      'last_name_one'            => new sfValidatorPass(array('required' => false)),
      'last_name_two'            => new sfValidatorPass(array('required' => false)),
      'address'                  => new sfValidatorPass(array('required' => false)),
      'numero'                   => new sfValidatorPass(array('required' => false)),
      'piso'                     => new sfValidatorPass(array('required' => false)),
      'puerta'                   => new sfValidatorPass(array('required' => false)),
      'telefono'                 => new sfValidatorPass(array('required' => false)),
      'email'                    => new sfValidatorPass(array('required' => false)),
      'destacado'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fecha_destacado'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_activacion'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_referendum'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_revision'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_deliberacion'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_observacion'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_cerrado'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_rechazado'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_nulo'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'revision_last_state_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'profesional_estado_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalEstado'), 'column' => 'id')),
      'profesional_tipo_uno_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'column' => 'id')),
      'profesional_tipo_dos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalTipoDos'), 'column' => 'id')),
      'profesional_tipo_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalTipoTres'), 'column' => 'id')),
      'road_type_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoadType'), 'column' => 'id')),
      'states_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
      'city_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id')),
      'user_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'active_reason'            => new sfValidatorPass(array('required' => false)),
      'dividendo'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'featured'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'featured_order'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'                     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profesional_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profesional';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'first_name'               => 'Text',
      'last_name_one'            => 'Text',
      'last_name_two'            => 'Text',
      'address'                  => 'Text',
      'numero'                   => 'Text',
      'piso'                     => 'Text',
      'puerta'                   => 'Text',
      'telefono'                 => 'Text',
      'email'                    => 'Text',
      'destacado'                => 'Boolean',
      'fecha_destacado'          => 'Date',
      'fecha_activacion'         => 'Date',
      'fecha_referendum'         => 'Date',
      'fecha_revision'           => 'Date',
      'fecha_deliberacion'       => 'Date',
      'fecha_observacion'        => 'Date',
      'fecha_cerrado'            => 'Date',
      'fecha_rechazado'          => 'Date',
      'fecha_nulo'               => 'Date',
      'revision_last_state_id'   => 'Number',
      'profesional_estado_id'    => 'ForeignKey',
      'profesional_tipo_uno_id'  => 'ForeignKey',
      'profesional_tipo_dos_id'  => 'ForeignKey',
      'profesional_tipo_tres_id' => 'ForeignKey',
      'road_type_id'             => 'ForeignKey',
      'states_id'                => 'ForeignKey',
      'city_id'                  => 'ForeignKey',
      'user_id'                  => 'ForeignKey',
      'active_reason'            => 'Text',
      'dividendo'                => 'Number',
      'featured'                 => 'Boolean',
      'featured_order'           => 'Number',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
      'slug'                     => 'Text',
    );
  }
}
