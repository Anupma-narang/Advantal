<?php

/**
 * ColaboradorNivelDos filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseColaboradorNivelDosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orden'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'                    => new sfWidgetFormFilterInput(),
      'colaborador_nivel_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ColaboradorNivelUno'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                     => new sfValidatorPass(array('required' => false)),
      'value'                    => new sfValidatorPass(array('required' => false)),
      'orden'                    => new sfValidatorPass(array('required' => false)),
      'image'                    => new sfValidatorPass(array('required' => false)),
      'colaborador_nivel_uno_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ColaboradorNivelUno'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('colaborador_nivel_dos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ColaboradorNivelDos';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'name'                     => 'Text',
      'value'                    => 'Text',
      'orden'                    => 'Text',
      'image'                    => 'Text',
      'colaborador_nivel_uno_id' => 'ForeignKey',
    );
  }
}
