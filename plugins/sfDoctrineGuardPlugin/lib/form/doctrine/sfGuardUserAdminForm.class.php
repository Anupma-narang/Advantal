<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserAdminForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
  	
  	$this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'Las dos contraseñas deben ser iguales.')));
  	
  	$this->validatorSchema['email_address']->setMessages(array('invalid' => 'Ese Email lo está usando ya otro colaborador.'));
  	
  	$this->validatorSchema->setPostValidator(
  			new sfValidatorAnd(array(
  					new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address')),array('invalid' => 'Ese Email lo está usando ya otro colaborador.')),
  					new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')),array('invalid' => 'Ese Usuario/Alias lo está usando ya otro colaborador.')),
  			))
  	);
  }
}
