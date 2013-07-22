<?php

/**
 * GoogleMap filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGoogleMapFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'address'    => new sfWidgetFormFilterInput(),
      'lat'        => new sfWidgetFormFilterInput(),
      'lng'        => new sfWidgetFormFilterInput(),
      'zoom'       => new sfWidgetFormFilterInput(),
      'marker_lat' => new sfWidgetFormFilterInput(),
      'marker_lng' => new sfWidgetFormFilterInput(),
      'empresa_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Empresa'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'address'    => new sfValidatorPass(array('required' => false)),
      'lat'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'lng'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'zoom'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'marker_lat' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'marker_lng' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'empresa_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Empresa'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('google_map_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GoogleMap';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'address'    => 'Text',
      'lat'        => 'Number',
      'lng'        => 'Number',
      'zoom'       => 'Number',
      'marker_lat' => 'Number',
      'marker_lng' => 'Number',
      'empresa_id' => 'ForeignKey',
    );
  }
}
