<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'email'                    => new sfWidgetFormFilterInput(),
      'name'                     => new sfWidgetFormFilterInput(),
      'surname1'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'surname2'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'active'                   => new sfWidgetFormFilterInput(),
      'fecha_nac'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'validate'                 => new sfWidgetFormFilterInput(),
      'image'                    => new sfWidgetFormFilterInput(),
      'direccion'                => new sfWidgetFormFilterInput(),
      'numero'                   => new sfWidgetFormFilterInput(),
      'piso'                     => new sfWidgetFormFilterInput(),
      'puerta'                   => new sfWidgetFormFilterInput(),
      'cp'                       => new sfWidgetFormFilterInput(),
      'telefono'                 => new sfWidgetFormFilterInput(),
      'colaborador_nivel_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelUno'), 'add_empty' => true)),
      'colaborador_nivel_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelDos'), 'add_empty' => true)),
      'metodo_cobro_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MetodoCobro'), 'add_empty' => true)),
      'rank'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'accumulated_points'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'hierarchy'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'change_points'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'money'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'money_sum'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'road_type_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
      'states_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
      'city_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'sex'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'formacion_academica_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FormacionAcademica'), 'add_empty' => true)),
      'is_online'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_blocked'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'blocked_limit'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'email'                    => new sfValidatorPass(array('required' => false)),
      'name'                     => new sfValidatorPass(array('required' => false)),
      'surname1'                 => new sfValidatorPass(array('required' => false)),
      'surname2'                 => new sfValidatorPass(array('required' => false)),
      'active'                   => new sfValidatorPass(array('required' => false)),
      'fecha_nac'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'validate'                 => new sfValidatorPass(array('required' => false)),
      'image'                    => new sfValidatorPass(array('required' => false)),
      'direccion'                => new sfValidatorPass(array('required' => false)),
      'numero'                   => new sfValidatorPass(array('required' => false)),
      'piso'                     => new sfValidatorPass(array('required' => false)),
      'puerta'                   => new sfValidatorPass(array('required' => false)),
      'cp'                       => new sfValidatorPass(array('required' => false)),
      'telefono'                 => new sfValidatorPass(array('required' => false)),
      'colaborador_nivel_uno_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ColaboradorNivelUno'), 'column' => 'id')),
      'colaborador_nivel_dos_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ColaboradorNivelDos'), 'column' => 'id')),
      'metodo_cobro_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MetodoCobro'), 'column' => 'id')),
      'rank'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'accumulated_points'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hierarchy'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'change_points'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'money'                    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'money_sum'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'road_type_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoadType'), 'column' => 'id')),
      'states_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
      'city_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id')),
      'sex'                      => new sfValidatorPass(array('required' => false)),
      'formacion_academica_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FormacionAcademica'), 'column' => 'id')),
      'is_online'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_blocked'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'blocked_limit'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'user_id'                  => 'Number',
      'email'                    => 'Text',
      'name'                     => 'Text',
      'surname1'                 => 'Text',
      'surname2'                 => 'Text',
      'active'                   => 'Text',
      'fecha_nac'                => 'Date',
      'validate'                 => 'Text',
      'image'                    => 'Text',
      'direccion'                => 'Text',
      'numero'                   => 'Text',
      'piso'                     => 'Text',
      'puerta'                   => 'Text',
      'cp'                       => 'Text',
      'telefono'                 => 'Text',
      'colaborador_nivel_uno_id' => 'ForeignKey',
      'colaborador_nivel_dos_id' => 'ForeignKey',
      'metodo_cobro_id'          => 'ForeignKey',
      'rank'                     => 'Number',
      'accumulated_points'       => 'Number',
      'hierarchy'                => 'Number',
      'change_points'            => 'Number',
      'money'                    => 'Number',
      'money_sum'                => 'Number',
      'road_type_id'             => 'ForeignKey',
      'states_id'                => 'ForeignKey',
      'city_id'                  => 'ForeignKey',
      'sex'                      => 'Text',
      'formacion_academica_id'   => 'ForeignKey',
      'is_online'                => 'Boolean',
      'is_blocked'               => 'Boolean',
      'blocked_limit'            => 'Number',
    );
  }
}
