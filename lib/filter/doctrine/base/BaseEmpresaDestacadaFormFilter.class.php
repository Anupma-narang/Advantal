<?php

/**
 * EmpresaDestacada filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEmpresaDestacadaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'empresa_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => true)),
      'empresa_sector_uno_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => true)),
      'empresa_sector_dos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => true)),
      'empresa_sector_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'add_empty' => true)),
      'localidad_id'           => new sfWidgetFormFilterInput(),
      'states_id'              => new sfWidgetFormFilterInput(),
      'rank'                   => new sfWidgetFormFilterInput(),
      'combinado'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'empresa_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Empresa'), 'column' => 'id')),
      'empresa_sector_uno_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorUno'), 'column' => 'id')),
      'empresa_sector_dos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorDos'), 'column' => 'id')),
      'empresa_sector_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorTres'), 'column' => 'id')),
      'localidad_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'states_id'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rank'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'combinado'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('empresa_destacada_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpresaDestacada';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'empresa_id'             => 'ForeignKey',
      'empresa_sector_uno_id'  => 'ForeignKey',
      'empresa_sector_dos_id'  => 'ForeignKey',
      'empresa_sector_tres_id' => 'ForeignKey',
      'localidad_id'           => 'Number',
      'states_id'              => 'Number',
      'rank'                   => 'Number',
      'combinado'              => 'Number',
    );
  }
}
