<?php

/**
 * UserProductCaseStudyRequest filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserProductCaseStudyRequestFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'status'                => new sfWidgetFormFilterInput(),
      'user_name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'name'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'homepage'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'marca'                 => new sfWidgetFormFilterInput(),
      'modelo'                => new sfWidgetFormFilterInput(),
      'producto_tipo_uno_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoUno'), 'add_empty' => true)),
      'producto_tipo_dos_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoDos'), 'add_empty' => true)),
      'producto_tipo_tres_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ProductoTipoTres'), 'add_empty' => true)),
      'description'           => new sfWidgetFormFilterInput(),
      'summary'               => new sfWidgetFormFilterInput(),
      'file1'                 => new sfWidgetFormFilterInput(),
      'file2'                 => new sfWidgetFormFilterInput(),
      'file3'                 => new sfWidgetFormFilterInput(),
      'file4'                 => new sfWidgetFormFilterInput(),
      'logo'                  => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'status'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_name'             => new sfValidatorPass(array('required' => false)),
      'user_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'name'                  => new sfValidatorPass(array('required' => false)),
      'homepage'              => new sfValidatorPass(array('required' => false)),
      'marca'                 => new sfValidatorPass(array('required' => false)),
      'modelo'                => new sfValidatorPass(array('required' => false)),
      'producto_tipo_uno_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoUno'), 'column' => 'id')),
      'producto_tipo_dos_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoDos'), 'column' => 'id')),
      'producto_tipo_tres_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ProductoTipoTres'), 'column' => 'id')),
      'description'           => new sfValidatorPass(array('required' => false)),
      'summary'               => new sfValidatorPass(array('required' => false)),
      'file1'                 => new sfValidatorPass(array('required' => false)),
      'file2'                 => new sfValidatorPass(array('required' => false)),
      'file3'                 => new sfValidatorPass(array('required' => false)),
      'file4'                 => new sfValidatorPass(array('required' => false)),
      'logo'                  => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('user_product_case_study_request_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserProductCaseStudyRequest';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'status'                => 'Number',
      'user_name'             => 'Text',
      'user_id'               => 'ForeignKey',
      'name'                  => 'Text',
      'homepage'              => 'Text',
      'marca'                 => 'Text',
      'modelo'                => 'Text',
      'producto_tipo_uno_id'  => 'ForeignKey',
      'producto_tipo_dos_id'  => 'ForeignKey',
      'producto_tipo_tres_id' => 'ForeignKey',
      'description'           => 'Text',
      'summary'               => 'Text',
      'file1'                 => 'Text',
      'file2'                 => 'Text',
      'file3'                 => 'Text',
      'file4'                 => 'Text',
      'logo'                  => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
