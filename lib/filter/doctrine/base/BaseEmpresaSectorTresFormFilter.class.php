<?php

/**
 * EmpresaSectorTres filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEmpresaSectorTresFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'orden'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'                 => new sfWidgetFormFilterInput(),
      'empresa_sector_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => true)),
      'empresa_sector_dos_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => true)),
      'slug'                  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'                  => new sfValidatorPass(array('required' => false)),
      'value'                 => new sfValidatorPass(array('required' => false)),
      'orden'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image'                 => new sfValidatorPass(array('required' => false)),
      'empresa_sector_uno_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorUno'), 'column' => 'id')),
      'empresa_sector_dos_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorDos'), 'column' => 'id')),
      'slug'                  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('empresa_sector_tres_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpresaSectorTres';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'name'                  => 'Text',
      'value'                 => 'Text',
      'orden'                 => 'Number',
      'image'                 => 'Text',
      'empresa_sector_uno_id' => 'ForeignKey',
      'empresa_sector_dos_id' => 'ForeignKey',
      'slug'                  => 'Text',
    );
  }
}
