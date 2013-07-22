<?php

/**
 * ProductoTipoDos filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductoTipoDosFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'orden'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image'                => new sfWidgetFormFilterInput(),
      'producto_tipo_uno_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'add_empty' => true)),
      'slug'                 => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'orden'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'                 => new sfValidatorPass(array('required' => false)),
      'image'                => new sfValidatorPass(array('required' => false)),
      'producto_tipo_uno_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoUno'), 'column' => 'id')),
      'slug'                 => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('producto_tipo_dos_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductoTipoDos';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'orden'                => 'Number',
      'name'                 => 'Text',
      'image'                => 'Text',
      'producto_tipo_uno_id' => 'ForeignKey',
      'slug'                 => 'Text',
    );
  }
}
