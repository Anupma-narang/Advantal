<?php

/**
 * RewardLog filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RewardLogFormFilter extends BaseRewardLogFormFilter {

  public function configure() {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
    parent::configure();
    $this->widgetSchema['cash'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 10, 'class' => 'tamano_40_c'));
    $this->widgetSchema['gift'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 70, 'class' => 'tamano_40_c'));
    $this->widgetSchema['descroption'] = new sfWidgetFormFilterInput(array('with_empty' => false), array('maxlength' => 40, 'class' => 'tamano_40_c'));
    
    $this->widgetSchema['hierarchy'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jerarquia'),'add_empty' => __('Selecciona Jerarquia')));
    $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));

    $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'=> 'sfGuardUser',
        'query' => sfGuardUserTable::getUserComboList(),
        'method'=> 'getUsername',
        'add_empty' => 'Selecciona Usuario',
    ));


    $this->validatorSchema['user_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id'));
    $this->validatorSchema['hierarchy'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Jerarquia'), 'column' => 'id'));
    $this->validatorSchema['cash'] = new sfValidatorSchemaFilter('text', new sfValidatorString(array('required' => false)));
    $this->validatorSchema['gift'] = new sfValidatorSchemaFilter('text', new sfValidatorString(array('required' => false)));
    $this->validatorSchema['descroption'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['created_at'] = new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59'))));

    //username
    $this->widgetSchema['user_name'] = new sfWidgetFormInputText(array('label' => 'Usuario/Alias'), array('id' => 'concurso_user', 'maxlength' => 25, 'style' => 'width:176px;'));
    $this->validatorSchema['user_name'] = new sfValidatorString();    


    $this->widgetSchema->setLabels(array(
        'gift' => __('Regalo'),
        'descroption' => __('Descripción'),
    ));
  }

}
