<?php

class sfGuardValidatorPassword extends sfValidatorBase
{
  public function configure($options = array(), $messages = array())
  {
    $this->addOption('password_field', 'password');
    $this->addOption('throw_global_error', false);

    $this->setMessage('invalid', 'La contraseña indicada no es tu actual contraseña.');
  }

  protected function doClean($values)
  {
    $password = isset($values[$this->getOption('password_field')]) ? $values[$this->getOption('password_field')] : '';

    $allowEmail = sfConfig::get('app_sf_guard_plugin_allow_login_with_email', true);
    $method = $allowEmail ? 'retrieveByUsernameOrEmailAddress' : 'retrieveByUsername';

    // don't allow to sign in with an empty username
    if ($password)
    {
       $user = sfContext::getInstance()->getUser()->getGuardUser(); 
       if($user)
       {
          // password is ok?
          if ($user->getIsActive() && $user->checkPassword($password))
          {
            return $values;
          }
       }
    }
    else
    	return null;    

    if ($this->getOption('throw_global_error'))
    {
      throw new sfValidatorError($this, 'invalid');
    }

    throw new sfValidatorErrorSchema($this, array($this->getOption('username_field') => new sfValidatorError($this, 'invalid')));
  }

  protected function getTable()
  {
    return Doctrine::getTable('sfGuardUser');
  }
}
