<?php

/**
 * ContribucionArchivo filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContribucionArchivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contribucion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Contribucion'), 'add_empty' => true)),
      'file'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contribucion_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Contribucion'), 'column' => 'id')),
      'file'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contribucion_archivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContribucionArchivo';
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
