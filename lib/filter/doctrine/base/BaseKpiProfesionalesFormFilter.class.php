<?php

/**
 * KpiProfesionales filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseKpiProfesionalesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'kpi_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Kpi'), 'add_empty' => true)),
      'profesional_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'add_empty' => true)),
      'suma_valores'   => new sfWidgetFormFilterInput(),
      'numero_valores' => new sfWidgetFormFilterInput(),
      'nombre'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'kpi_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Kpi'), 'column' => 'id')),
      'profesional_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesional'), 'column' => 'id')),
      'suma_valores'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numero_valores' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('kpi_profesionales_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'KpiProfesionales';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'kpi_id'         => 'ForeignKey',
      'profesional_id' => 'ForeignKey',
      'suma_valores'   => 'Number',
      'numero_valores' => 'Number',
      'nombre'         => 'Text',
    );
  }
}
