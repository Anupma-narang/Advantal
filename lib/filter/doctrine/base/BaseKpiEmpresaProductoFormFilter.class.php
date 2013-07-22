<?php

/**
 * KpiEmpresaProducto filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseKpiEmpresaProductoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'kpi_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Kpi'), 'add_empty' => true)),
      'empresa_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => true)),
      'producto_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'suma_valores'   => new sfWidgetFormFilterInput(),
      'numero_valores' => new sfWidgetFormFilterInput(),
      'nombre'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'kpi_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Kpi'), 'column' => 'id')),
      'empresa_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Empresa'), 'column' => 'id')),
      'producto_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'suma_valores'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numero_valores' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'         => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('kpi_empresa_producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'KpiEmpresaProducto';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'kpi_id'         => 'ForeignKey',
      'empresa_id'     => 'ForeignKey',
      'producto_id'    => 'ForeignKey',
      'suma_valores'   => 'Number',
      'numero_valores' => 'Number',
      'nombre'         => 'Text',
    );
  }
}
