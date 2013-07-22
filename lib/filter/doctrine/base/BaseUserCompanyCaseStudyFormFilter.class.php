<?php

/**
 * UserCompanyCaseStudy filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserCompanyCaseStudyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'road_type_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RoadType'), 'add_empty' => true)),
      'direccion'              => new sfWidgetFormFilterInput(),
      'numero'                 => new sfWidgetFormFilterInput(),
      'piso'                   => new sfWidgetFormFilterInput(),
      'puerta'                 => new sfWidgetFormFilterInput(),
      'states_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => true)),
      'city_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Localidad'), 'add_empty' => true)),
      'empresa_sector_uno_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorUno'), 'add_empty' => true)),
      'empresa_sector_dos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorDos'), 'add_empty' => true)),
      'empresa_sector_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EmpresaSectorTres'), 'add_empty' => true)),
      'description'            => new sfWidgetFormFilterInput(),
      'summary'                => new sfWidgetFormFilterInput(),
      'file1'                  => new sfWidgetFormFilterInput(),
      'file2'                  => new sfWidgetFormFilterInput(),
      'file3'                  => new sfWidgetFormFilterInput(),
      'file4'                  => new sfWidgetFormFilterInput(),
      'logo'                   => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'status'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_name'              => new sfValidatorPass(array('required' => false)),
      'user_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'name'                   => new sfValidatorPass(array('required' => false)),
      'road_type_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RoadType'), 'column' => 'id')),
      'direccion'              => new sfValidatorPass(array('required' => false)),
      'numero'                 => new sfValidatorPass(array('required' => false)),
      'piso'                   => new sfValidatorPass(array('required' => false)),
      'puerta'                 => new sfValidatorPass(array('required' => false)),
      'states_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
      'city_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Localidad'), 'column' => 'id')),
      'empresa_sector_uno_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorUno'), 'column' => 'id')),
      'empresa_sector_dos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorDos'), 'column' => 'id')),
      'empresa_sector_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EmpresaSectorTres'), 'column' => 'id')),
      'description'            => new sfValidatorPass(array('required' => false)),
      'summary'                => new sfValidatorPass(array('required' => false)),
      'file1'                  => new sfValidatorPass(array('required' => false)),
      'file2'                  => new sfValidatorPass(array('required' => false)),
      'file3'                  => new sfValidatorPass(array('required' => false)),
      'file4'                  => new sfValidatorPass(array('required' => false)),
      'logo'                   => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('user_company_case_study_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserCompanyCaseStudy';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'status'                 => 'Number',
      'user_name'              => 'Text',
      'user_id'                => 'ForeignKey',
      'name'                   => 'Text',
      'road_type_id'           => 'ForeignKey',
      'direccion'              => 'Text',
      'numero'                 => 'Text',
      'piso'                   => 'Text',
      'puerta'                 => 'Text',
      'states_id'              => 'ForeignKey',
      'city_id'                => 'ForeignKey',
      'empresa_sector_uno_id'  => 'ForeignKey',
      'empresa_sector_dos_id'  => 'ForeignKey',
      'empresa_sector_tres_id' => 'ForeignKey',
      'description'            => 'Text',
      'summary'                => 'Text',
      'file1'                  => 'Text',
      'file2'                  => 'Text',
      'file3'                  => 'Text',
      'file4'                  => 'Text',
      'logo'                   => 'Text',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
