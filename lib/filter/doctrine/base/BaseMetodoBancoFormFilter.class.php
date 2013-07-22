<?php

/**
 * MetodoBanco filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMetodoBancoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'tipo_documento_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => true)),
      'nifnie'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'titular_name'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'surname1'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'surname2'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cuenta_entidad'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cuenta_oficina'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cuenta_dc'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cuenta_numero'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'tipo_documento_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoDocumento'), 'column' => 'id')),
      'nifnie'            => new sfValidatorPass(array('required' => false)),
      'titular_name'      => new sfValidatorPass(array('required' => false)),
      'surname1'          => new sfValidatorPass(array('required' => false)),
      'surname2'          => new sfValidatorPass(array('required' => false)),
      'cuenta_entidad'    => new sfValidatorPass(array('required' => false)),
      'cuenta_oficina'    => new sfValidatorPass(array('required' => false)),
      'cuenta_dc'         => new sfValidatorPass(array('required' => false)),
      'cuenta_numero'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('metodo_banco_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MetodoBanco';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'user_id'           => 'ForeignKey',
      'tipo_documento_id' => 'ForeignKey',
      'nifnie'            => 'Text',
      'titular_name'      => 'Text',
      'surname1'          => 'Text',
      'surname2'          => 'Text',
      'cuenta_entidad'    => 'Text',
      'cuenta_oficina'    => 'Text',
      'cuenta_dc'         => 'Text',
      'cuenta_numero'     => 'Text',
    );
  }
}
