<?php

/**
 * ComentarioCp filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseComentarioCpFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'contenido'          => new sfWidgetFormFilterInput(),
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'concurso_cp_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCp'), 'add_empty' => true)),
      'contribucion_cp_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionCp'), 'add_empty' => true)),
      'parent_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Parent'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'               => new sfValidatorPass(array('required' => false)),
      'contenido'          => new sfValidatorPass(array('required' => false)),
      'user_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'concurso_cp_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ConcursoCp'), 'column' => 'id')),
      'contribucion_cp_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ContribucionCp'), 'column' => 'id')),
      'parent_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Parent'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('comentario_cp_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ComentarioCp';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'name'               => 'Text',
      'contenido'          => 'Text',
      'user_id'            => 'ForeignKey',
      'concurso_cp_id'     => 'ForeignKey',
      'contribucion_cp_id' => 'ForeignKey',
      'parent_id'          => 'ForeignKey',
    );
  }
}
