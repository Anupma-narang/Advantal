<?php

/**
 * ProfesionalTipoDos filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfesionalTipoDosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value'                   => new sfWidgetFormFilterInput(),
      'orden'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'                   => new sfWidgetFormFilterInput(),
      'profesional_tipo_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'add_empty' => true)),
      'slug'                    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'                    => new sfValidatorPass(array('required' => false)),
      'value'                   => new sfValidatorPass(array('required' => false)),
      'orden'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image'                   => new sfValidatorPass(array('required' => false)),
      'profesional_tipo_uno_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalTipoUno'), 'column' => 'id')),
      'slug'                    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profesional_tipo_dos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfesionalTipoDos';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'name'                    => 'Text',
      'value'                   => 'Text',
      'orden'                   => 'Number',
      'image'                   => 'Text',
      'profesional_tipo_uno_id' => 'ForeignKey',
      'slug'                    => 'Text',
    );
  }
}
