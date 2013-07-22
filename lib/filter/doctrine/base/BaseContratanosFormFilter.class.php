<?php

/**
 * Contratanos filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContratanosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'       => new sfWidgetFormFilterInput(),
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'road_type_id' => new sfWidgetFormFilterInput(),
      'cif'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'actividad'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido1'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido2'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cargo'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'direccion'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'num'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'piso'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'puerta'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cp'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'states_id'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'city_id'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ayudar'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'servicio'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'antes'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'what'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'empresa'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'form_type'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'         => new sfValidatorPass(array('required' => false)),
      'road_type_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cif'          => new sfValidatorPass(array('required' => false)),
      'actividad'    => new sfValidatorPass(array('required' => false)),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'apellido1'    => new sfValidatorPass(array('required' => false)),
      'apellido2'    => new sfValidatorPass(array('required' => false)),
      'cargo'        => new sfValidatorPass(array('required' => false)),
      'email'        => new sfValidatorPass(array('required' => false)),
      'phone'        => new sfValidatorPass(array('required' => false)),
      'direccion'    => new sfValidatorPass(array('required' => false)),
      'num'          => new sfValidatorPass(array('required' => false)),
      'piso'         => new sfValidatorPass(array('required' => false)),
      'puerta'       => new sfValidatorPass(array('required' => false)),
      'cp'           => new sfValidatorPass(array('required' => false)),
      'states_id'    => new sfValidatorPass(array('required' => false)),
      'city_id'      => new sfValidatorPass(array('required' => false)),
      'ayudar'       => new sfValidatorPass(array('required' => false)),
      'servicio'     => new sfValidatorPass(array('required' => false)),
      'antes'        => new sfValidatorPass(array('required' => false)),
      'what'         => new sfValidatorPass(array('required' => false)),
      'empresa'      => new sfValidatorPass(array('required' => false)),
      'form_type'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('contratanos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contratanos';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'status'       => 'Number',
      'name'         => 'Text',
      'road_type_id' => 'Number',
      'cif'          => 'Text',
      'actividad'    => 'Text',
      'nombre'       => 'Text',
      'apellido1'    => 'Text',
      'apellido2'    => 'Text',
      'cargo'        => 'Text',
      'email'        => 'Text',
      'phone'        => 'Text',
      'direccion'    => 'Text',
      'num'          => 'Text',
      'piso'         => 'Text',
      'puerta'       => 'Text',
      'cp'           => 'Text',
      'states_id'    => 'Text',
      'city_id'      => 'Text',
      'ayudar'       => 'Text',
      'servicio'     => 'Text',
      'antes'        => 'Text',
      'what'         => 'Text',
      'empresa'      => 'Text',
      'form_type'    => 'Boolean',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
