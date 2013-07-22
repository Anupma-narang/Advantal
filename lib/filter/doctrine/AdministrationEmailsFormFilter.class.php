<?php

/**
 * AdministrationEmails filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdministrationEmailsFormFilter extends BaseAdministrationEmailsFormFilter {

  public function configure() {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
    $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => 'Selecciona Usuario'));
    $this->widgetSchema['email'] = new sfWidgetFormFilterInput(array('with_empty' => false),array('class' => 'tamano_40_c', 'maxlength' => 70));
    $this->widgetSchema['permission_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Permission'), 'add_empty' => 'Selecciona perfil'));
    $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'to_date' => new sfWidgetFormDate(array('format' => '%day% / %month% / %year%')), 'template' => 'Desde %from_date%<br />Hasta %to_date%', 'with_empty' => false));



    $this->setValidators(array(
        'user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
        'email' => new sfValidatorPass(array('required' => false)),
        'permission_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Permission'), 'column' => 'id')),
        'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array(
        'model'=> 'sfGuardUser',
        'query' => sfGuardUserTable::getUserComboList(),
        'method'=> 'getUsername',
        'add_empty' => 'Selecciona Usuario',
    ), array('style' => 'width:300px;'));
    
    $this->validatorSchema['user_id']->setMessages(array('required'=> __('Necesitas seleccionar un Usuario'), 'invalid'=> __('Ese Usuario no es válido')));

  
    $this->widgetSchema['user_id'] =  new sfWidgetFormInput(array(), array('maxlength' => 70, 'class' => 'tamano_40_c'));
    $this->validatorSchema['user_id'] = new sfValidatorString(array('required' => false));

    
  }

}
