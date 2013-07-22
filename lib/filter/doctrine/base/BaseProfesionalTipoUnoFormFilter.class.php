<?php

/**
 * ProfesionalTipoUno filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfesionalTipoUnoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value' => new sfWidgetFormFilterInput(),
      'orden' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image' => new sfWidgetFormFilterInput(),
      'slug'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'  => new sfValidatorPass(array('required' => false)),
      'value' => new sfValidatorPass(array('required' => false)),
      'orden' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image' => new sfValidatorPass(array('required' => false)),
      'slug'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profesional_tipo_uno_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfesionalTipoUno';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'name'  => 'Text',
      'value' => 'Text',
      'orden' => 'Number',
      'image' => 'Text',
      'slug'  => 'Text',
    );
  }
}
