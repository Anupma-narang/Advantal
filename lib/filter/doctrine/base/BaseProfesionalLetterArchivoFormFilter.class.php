<?php

/**
 * ProfesionalLetterArchivo filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfesionalLetterArchivoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'profesional_letter_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProfesionalLetter'), 'add_empty' => true)),
      'file'                  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'profesional_letter_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProfesionalLetter'), 'column' => 'id')),
      'file'                  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('profesional_letter_archivo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfesionalLetterArchivo';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'profesional_letter_id' => 'ForeignKey',
      'file'                  => 'Text',
    );
  }
}
