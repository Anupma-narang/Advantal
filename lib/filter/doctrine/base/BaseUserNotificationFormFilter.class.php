<?php

/**
 * UserNotification filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserNotificationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'colaborador_contribuye_value'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'concurso_empresa_value'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'concurso_empresa_nombre'         => new sfWidgetFormFilterInput(),
      'concurso_empresa_provincia_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
      'concurso_empresa_ciudad_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('City'), 'add_empty' => true)),
      'concurso_producto_value'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'concurso_producto_nombre'        => new sfWidgetFormFilterInput(),
      'concurso_producto_marca'         => new sfWidgetFormFilterInput(),
      'lista_blanca_value'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'lista_negra_value'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'publica_profesional_value'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'publica_recomend_disaprov_value' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'hash'                            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'                         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'colaborador_contribuye_value'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'concurso_empresa_value'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'concurso_empresa_nombre'         => new sfValidatorPass(array('required' => false)),
      'concurso_empresa_provincia_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
      'concurso_empresa_ciudad_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('City'), 'column' => 'id')),
      'concurso_producto_value'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'concurso_producto_nombre'        => new sfValidatorPass(array('required' => false)),
      'concurso_producto_marca'         => new sfValidatorPass(array('required' => false)),
      'lista_blanca_value'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'lista_negra_value'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'publica_profesional_value'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'publica_recomend_disaprov_value' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'hash'                            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_notification_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserNotification';
  }

  public function getFields()
  {
    return array(
      'id'                              => 'Number',
      'user_id'                         => 'ForeignKey',
      'colaborador_contribuye_value'    => 'Boolean',
      'concurso_empresa_value'          => 'Boolean',
      'concurso_empresa_nombre'         => 'Text',
      'concurso_empresa_provincia_id'   => 'ForeignKey',
      'concurso_empresa_ciudad_id'      => 'ForeignKey',
      'concurso_producto_value'         => 'Boolean',
      'concurso_producto_nombre'        => 'Text',
      'concurso_producto_marca'         => 'Text',
      'lista_blanca_value'              => 'Boolean',
      'lista_negra_value'               => 'Boolean',
      'publica_profesional_value'       => 'Boolean',
      'publica_recomend_disaprov_value' => 'Boolean',
      'hash'                            => 'Text',
    );
  }
}
