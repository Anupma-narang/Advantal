<?php

/**
 * Informa filter form base class.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInformaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                                                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'se_crea_un_concurso_para_producto'                         => new sfWidgetFormFilterInput(),
      'se_crea_un_concurso_para_empresa'                          => new sfWidgetFormFilterInput(),
      'un_concurso_en_el_que_contribuyes_finaliza_en_3_dias'      => new sfWidgetFormFilterInput(),
      'una_mesa_redonda_en_el_que_contribuyes_finaliza_en_3_dias' => new sfWidgetFormFilterInput(),
      'created_at'                                                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                                                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'                                                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'se_crea_un_concurso_para_producto'                         => new sfValidatorPass(array('required' => false)),
      'se_crea_un_concurso_para_empresa'                          => new sfValidatorPass(array('required' => false)),
      'un_concurso_en_el_que_contribuyes_finaliza_en_3_dias'      => new sfValidatorPass(array('required' => false)),
      'una_mesa_redonda_en_el_que_contribuyes_finaliza_en_3_dias' => new sfValidatorPass(array('required' => false)),
      'created_at'                                                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                                                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('informa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Informa';
  }

  public function getFields()
  {
    return array(
      'id'                                                        => 'Number',
      'user_id'                                                   => 'ForeignKey',
      'se_crea_un_concurso_para_producto'                         => 'Text',
      'se_crea_un_concurso_para_empresa'                          => 'Text',
      'un_concurso_en_el_que_contribuyes_finaliza_en_3_dias'      => 'Text',
      'una_mesa_redonda_en_el_que_contribuyes_finaliza_en_3_dias' => 'Text',
      'created_at'                                                => 'Date',
      'updated_at'                                                => 'Date',
    );
  }
}
