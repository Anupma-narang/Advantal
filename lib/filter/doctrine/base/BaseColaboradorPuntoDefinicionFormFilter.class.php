<?php

/**
 * ColaboradorPuntoDefinicion filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseColaboradorPuntoDefinicionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'puntos'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_automatic' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'codigo'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'descripcion'  => new sfValidatorPass(array('required' => false)),
      'puntos'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_automatic' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'codigo'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('colaborador_punto_definicion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ColaboradorPuntoDefinicion';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'descripcion'  => 'Text',
      'puntos'       => 'Number',
      'is_automatic' => 'Boolean',
      'codigo'       => 'Text',
    );
  }
}
