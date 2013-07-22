<?php

/**
 * sfGuardUser filter form.
 *
 * @package    symfony
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdministrationFormFilter extends PluginsfGuardUserFormFilter
{
  public function configure()
  {
		$this->setWidgets(array(
      'email_address'    => new sfWidgetFormFilterInput(array('with_empty' => false), array('class' => 'tamano_32_c', 'maxlength' => 70)),
      'username'         => new sfWidgetFormFilterInput(array('with_empty' => false),array('class' => 'tamano_25_c', 'maxlength' => 25)),
      'permissions_list' => new sfWidgetFormDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardPermission','add_empty' => 'Selecciona perfil')),    ));

    $this->setValidators(array(
      'email_address'    => new sfValidatorPass(array('required' => false)),
      'username'         => new sfValidatorPass(array('required' => false)),
      'permissions_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),

    ));
    $this->widgetSchema['permissions_list']->setLabel("Perfil de Usuario");
    
  }
  
  
}
