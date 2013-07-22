<?php

/**
 * ConcursoCpArchivo filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConcursoCpArchivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'concurso_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ConcursoCp'), 'add_empty' => true)),
      'file'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'concurso_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ConcursoCp'), 'column' => 'id')),
      'file'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('concurso_cp_archivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ConcursoCpArchivo';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'concurso_id' => 'ForeignKey',
      'file'        => 'Text',
    );
  }
}
