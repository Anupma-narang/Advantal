<?php

/**
 * PdCarta filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePdCartaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'        => new sfWidgetFormFilterInput(),
      'plan_accion'        => new sfWidgetFormFilterInput(),
      'pd_estado_carta_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PdEstadoCarta'), 'add_empty' => true)),
      'pd_activa_desa_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PdActivaDesa'), 'add_empty' => true)),
      'pd_apro_despro_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PdAproDespro'), 'add_empty' => true)),
      'pd_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pd'), 'add_empty' => true)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'               => new sfValidatorPass(array('required' => false)),
      'description'        => new sfValidatorPass(array('required' => false)),
      'plan_accion'        => new sfValidatorPass(array('required' => false)),
      'pd_estado_carta_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PdEstadoCarta'), 'column' => 'id')),
      'pd_activa_desa_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PdActivaDesa'), 'column' => 'id')),
      'pd_apro_despro_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PdAproDespro'), 'column' => 'id')),
      'pd_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pd'), 'column' => 'id')),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('pd_carta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PdCarta';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'name'               => 'Text',
      'description'        => 'Text',
      'plan_accion'        => 'Text',
      'pd_estado_carta_id' => 'ForeignKey',
      'pd_activa_desa_id'  => 'ForeignKey',
      'pd_apro_despro_id'  => 'ForeignKey',
      'pd_id'              => 'ForeignKey',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
