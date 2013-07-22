<?php

/**
 * MesaredondaPonencia filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMesaredondaPonenciaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'asunto'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mesa_redonda_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaRedonda'), 'add_empty' => true)),
      'plan_accion'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'resumen'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_alta'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'mesaredonda_estado_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('MesaredondaEstado'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                  => new sfValidatorPass(array('required' => false)),
      'asunto'                => new sfValidatorPass(array('required' => false)),
      'mesa_redonda_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MesaRedonda'), 'column' => 'id')),
      'plan_accion'           => new sfValidatorPass(array('required' => false)),
      'resumen'               => new sfValidatorPass(array('required' => false)),
      'fecha_alta'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'mesaredonda_estado_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('MesaredondaEstado'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('mesaredonda_ponencia_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MesaredondaPonencia';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'name'                  => 'Text',
      'asunto'                => 'Text',
      'mesa_redonda_id'       => 'ForeignKey',
      'plan_accion'           => 'Text',
      'resumen'               => 'Text',
      'fecha_alta'            => 'Date',
      'mesaredonda_estado_id' => 'ForeignKey',
    );
  }
}
