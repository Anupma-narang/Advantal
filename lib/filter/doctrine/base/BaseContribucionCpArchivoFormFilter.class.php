<?php

/**
 * ContribucionCpArchivo filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContribucionCpArchivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contribucion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContribucionCp'), 'add_empty' => true)),
      'file'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contribucion_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ContribucionCp'), 'column' => 'id')),
      'file'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contribucion_cp_archivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContribucionCpArchivo';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'contribucion_id' => 'ForeignKey',
      'file'            => 'Text',
    );
  }
}
