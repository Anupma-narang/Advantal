<?php

/**
 * ProfesionalGoogleMap filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseProfesionalGoogleMapFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'address'        => new sfWidgetFormFilterInput(),
      'lat'            => new sfWidgetFormFilterInput(),
      'lng'            => new sfWidgetFormFilterInput(),
      'zoom'           => new sfWidgetFormFilterInput(),
      'marker_lat'     => new sfWidgetFormFilterInput(),
      'marker_lng'     => new sfWidgetFormFilterInput(),
      'profesional_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesional'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'address'        => new sfValidatorPass(array('required' => false)),
      'lat'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'lng'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'zoom'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'marker_lat'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'marker_lng'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'profesional_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesional'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('profesional_google_map_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProfesionalGoogleMap';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'address'        => 'Text',
      'lat'            => 'Number',
      'lng'            => 'Number',
      'zoom'           => 'Number',
      'marker_lat'     => 'Number',
      'marker_lng'     => 'Number',
      'profesional_id' => 'ForeignKey',
    );
  }
}
