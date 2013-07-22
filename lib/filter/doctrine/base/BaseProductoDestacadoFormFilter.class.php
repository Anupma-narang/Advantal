<?php

/**
 * ProductoDestacado filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductoDestacadoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Producto'), 'add_empty' => true)),
      'producto_tipo_dos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'add_empty' => true)),
      'producto_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'add_empty' => true)),
      'name'                  => new sfWidgetFormFilterInput(),
      'marca'                 => new sfWidgetFormFilterInput(),
      'rank'                  => new sfWidgetFormFilterInput(),
      'combinado'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'producto_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Producto'), 'column' => 'id')),
      'producto_tipo_dos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoDos'), 'column' => 'id')),
      'producto_tipo_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoTres'), 'column' => 'id')),
      'name'                  => new sfValidatorPass(array('required' => false)),
      'marca'                 => new sfValidatorPass(array('required' => false)),
      'rank'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'combinado'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('producto_destacado_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductoDestacado';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'producto_id'           => 'ForeignKey',
      'producto_tipo_dos_id'  => 'ForeignKey',
      'producto_tipo_tres_id' => 'ForeignKey',
      'name'                  => 'Text',
      'marca'                 => 'Text',
      'rank'                  => 'Number',
      'combinado'             => 'Number',
    );
  }
}
