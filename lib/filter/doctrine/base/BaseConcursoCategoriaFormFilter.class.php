<?php

/**
 * ConcursoCategoria filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConcursoCategoriaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'concurso_tipo_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoTipo'), 'add_empty' => true)),
      'image'            => new sfWidgetFormFilterInput(),
      'orden'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'concurso_tipo_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ConcursoTipo'), 'column' => 'id')),
      'image'            => new sfValidatorPass(array('required' => false)),
      'orden'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('concurso_categoria_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConcursoCategoria';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'concurso_tipo_id' => 'ForeignKey',
      'image'            => 'Text',
      'orden'            => 'Number',
    );
  }
}
