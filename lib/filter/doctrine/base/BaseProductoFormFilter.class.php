<?php

/**
 * Producto filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProductoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'marca'                 => new sfWidgetFormFilterInput(),
      'modelo'                => new sfWidgetFormFilterInput(),
      'valida'                => new sfWidgetFormFilterInput(),
      'lista'                 => new sfWidgetFormFilterInput(),
      'dividendo'             => new sfWidgetFormFilterInput(),
      'divisor'               => new sfWidgetFormFilterInput(),
      'comentario_inicial'    => new sfWidgetFormFilterInput(),
      'lista_cuestionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'add_empty' => true)),
      'texto_lista_negra'     => new sfWidgetFormFilterInput(),
      'persona_contacto'      => new sfWidgetFormFilterInput(),
      'email'                 => new sfWidgetFormFilterInput(),
      'telefono'              => new sfWidgetFormFilterInput(),
      'producto_tipo_uno_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'add_empty' => true)),
      'producto_tipo_dos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'add_empty' => true)),
      'producto_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'add_empty' => true)),
      'concurso_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('concursoDestacado'), 'add_empty' => true)),
      'featured'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'featured_order'        => new sfWidgetFormFilterInput(),
      'slug'                  => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                  => new sfValidatorPass(array('required' => false)),
      'marca'                 => new sfValidatorPass(array('required' => false)),
      'modelo'                => new sfValidatorPass(array('required' => false)),
      'valida'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lista'                 => new sfValidatorPass(array('required' => false)),
      'dividendo'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'divisor'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comentario_inicial'    => new sfValidatorPass(array('required' => false)),
      'lista_cuestionario_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cuestionario'), 'column' => 'id')),
      'texto_lista_negra'     => new sfValidatorPass(array('required' => false)),
      'persona_contacto'      => new sfValidatorPass(array('required' => false)),
      'email'                 => new sfValidatorPass(array('required' => false)),
      'telefono'              => new sfValidatorPass(array('required' => false)),
      'producto_tipo_uno_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoUno'), 'column' => 'id')),
      'producto_tipo_dos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoDos'), 'column' => 'id')),
      'producto_tipo_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoTres'), 'column' => 'id')),
      'concurso_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('concursoDestacado'), 'column' => 'id')),
      'featured'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'featured_order'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slug'                  => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producto';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'name'                  => 'Text',
      'marca'                 => 'Text',
      'modelo'                => 'Text',
      'valida'                => 'Number',
      'lista'                 => 'Text',
      'dividendo'             => 'Number',
      'divisor'               => 'Number',
      'comentario_inicial'    => 'Text',
      'lista_cuestionario_id' => 'ForeignKey',
      'texto_lista_negra'     => 'Text',
      'persona_contacto'      => 'Text',
      'email'                 => 'Text',
      'telefono'              => 'Text',
      'producto_tipo_uno_id'  => 'ForeignKey',
      'producto_tipo_dos_id'  => 'ForeignKey',
      'producto_tipo_tres_id' => 'ForeignKey',
      'concurso_id'           => 'ForeignKey',
      'featured'              => 'Boolean',
      'featured_order'        => 'Number',
      'slug'                  => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
