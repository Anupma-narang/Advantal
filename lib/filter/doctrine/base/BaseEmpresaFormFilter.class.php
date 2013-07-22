<?php

/**
 * Empresa filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEmpresaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'road_type_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
      'direccion'              => new sfWidgetFormFilterInput(),
      'numero'                 => new sfWidgetFormFilterInput(),
      'piso'                   => new sfWidgetFormFilterInput(),
      'puerta'                 => new sfWidgetFormFilterInput(),
      'localidad_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
      'codigopostal'           => new sfWidgetFormFilterInput(),
      'dividendo'              => new sfWidgetFormFilterInput(),
      'divisor'                => new sfWidgetFormFilterInput(),
      'comentario_inicial'     => new sfWidgetFormFilterInput(),
      'texto_lista_negra'      => new sfWidgetFormFilterInput(),
      'lista'                  => new sfWidgetFormFilterInput(),
      'valida'                 => new sfWidgetFormFilterInput(),
      'persona_contacto'       => new sfWidgetFormFilterInput(),
      'telefono'               => new sfWidgetFormFilterInput(),
      'email'                  => new sfWidgetFormFilterInput(),
      'states_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
      'lista_cuestionario_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'add_empty' => true)),
      'empresa_sector_uno_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => true)),
      'empresa_sector_dos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => true)),
      'empresa_sector_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'add_empty' => true)),
      'user_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'concurso_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('concursoDestacado'), 'add_empty' => true)),
      'featured'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'featured_order'         => new sfWidgetFormFilterInput(),
      'slug'                   => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'road_type_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoadType'), 'column' => 'id')),
      'direccion'              => new sfValidatorPass(array('required' => false)),
      'numero'                 => new sfValidatorPass(array('required' => false)),
      'piso'                   => new sfValidatorPass(array('required' => false)),
      'puerta'                 => new sfValidatorPass(array('required' => false)),
      'localidad_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Localidad'), 'column' => 'id')),
      'codigopostal'           => new sfValidatorPass(array('required' => false)),
      'dividendo'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'divisor'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comentario_inicial'     => new sfValidatorPass(array('required' => false)),
      'texto_lista_negra'      => new sfValidatorPass(array('required' => false)),
      'lista'                  => new sfValidatorPass(array('required' => false)),
      'valida'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'persona_contacto'       => new sfValidatorPass(array('required' => false)),
      'telefono'               => new sfValidatorPass(array('required' => false)),
      'email'                  => new sfValidatorPass(array('required' => false)),
      'states_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
      'lista_cuestionario_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cuestionario'), 'column' => 'id')),
      'empresa_sector_uno_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorUno'), 'column' => 'id')),
      'empresa_sector_dos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorDos'), 'column' => 'id')),
      'empresa_sector_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorTres'), 'column' => 'id')),
      'user_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'concurso_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('concursoDestacado'), 'column' => 'id')),
      'featured'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'featured_order'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'slug'                   => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('empresa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Empresa';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'name'                   => 'Text',
      'road_type_id'           => 'ForeignKey',
      'direccion'              => 'Text',
      'numero'                 => 'Text',
      'piso'                   => 'Text',
      'puerta'                 => 'Text',
      'localidad_id'           => 'ForeignKey',
      'codigopostal'           => 'Text',
      'dividendo'              => 'Number',
      'divisor'                => 'Number',
      'comentario_inicial'     => 'Text',
      'texto_lista_negra'      => 'Text',
      'lista'                  => 'Text',
      'valida'                 => 'Number',
      'persona_contacto'       => 'Text',
      'telefono'               => 'Text',
      'email'                  => 'Text',
      'states_id'              => 'ForeignKey',
      'lista_cuestionario_id'  => 'ForeignKey',
      'empresa_sector_uno_id'  => 'ForeignKey',
      'empresa_sector_dos_id'  => 'ForeignKey',
      'empresa_sector_tres_id' => 'ForeignKey',
      'user_id'                => 'ForeignKey',
      'concurso_id'            => 'ForeignKey',
      'featured'               => 'Boolean',
      'featured_order'         => 'Number',
      'slug'                   => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
