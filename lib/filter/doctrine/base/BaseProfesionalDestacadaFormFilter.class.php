<?php

/**
 * ProfesionalDestacada filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfesionalDestacadaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'profesional_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'add_empty' => true)),
      'profesional_tipo_uno_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'add_empty' => true)),
      'profesional_tipo_dos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoDos'), 'add_empty' => true)),
      'profesional_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoTres'), 'add_empty' => true)),
      'city_id'                  => new sfWidgetFormFilterInput(),
      'states_id'                => new sfWidgetFormFilterInput(),
      'rank'                     => new sfWidgetFormFilterInput(),
      'combinado'                => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'profesional_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesional'), 'column' => 'id')),
      'profesional_tipo_uno_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'column' => 'id')),
      'profesional_tipo_dos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalTipoDos'), 'column' => 'id')),
      'profesional_tipo_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalTipoTres'), 'column' => 'id')),
      'city_id'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'states_id'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rank'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'combinado'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('profesional_destacada_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfesionalDestacada';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'profesional_id'           => 'ForeignKey',
      'profesional_tipo_uno_id'  => 'ForeignKey',
      'profesional_tipo_dos_id'  => 'ForeignKey',
      'profesional_tipo_tres_id' => 'ForeignKey',
      'city_id'                  => 'Number',
      'states_id'                => 'Number',
      'rank'                     => 'Number',
      'combinado'                => 'Number',
    );
  }
}
