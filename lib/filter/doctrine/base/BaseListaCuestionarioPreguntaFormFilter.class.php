<?php

/**
 * ListaCuestionarioPregunta filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseListaCuestionarioPreguntaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'pregunta'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'lista_cuestionario_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cuestionario'), 'add_empty' => true)),
      'kpi_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Kpi'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'pregunta'              => new sfValidatorPass(array('required' => false)),
      'tipo'                  => new sfValidatorPass(array('required' => false)),
      'lista_cuestionario_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cuestionario'), 'column' => 'id')),
      'kpi_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Kpi'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('lista_cuestionario_pregunta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ListaCuestionarioPregunta';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'pregunta'              => 'Text',
      'tipo'                  => 'Text',
      'lista_cuestionario_id' => 'ForeignKey',
      'kpi_id'                => 'ForeignKey',
    );
  }
}
