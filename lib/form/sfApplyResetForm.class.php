<?php

class sfApplyResetForm extends sfForm
{
  public function configure()
  {
  	sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));		//para las traduciones del formulario  	
  	
    $this->setWidget('password',
      new sfWidgetFormInputPassword(
        array(), array('maxlength' => 16, 'class' => "tamano_16_c")));
    $this->setWidget('password2',
      new sfWidgetFormInputPassword(
        array(), array('maxlength' => 16, 'class' =>"tamano_16_c")));
    $this->widgetSchema->setNameFormat('sfApplyReset[%s]');
    $this->widgetSchema->setFormFormatterName('list');
		
		$this->setValidator('password', new sfValidatorPass());
    $this->setValidator('password2', new sfValidatorPass());
    
    //$this->validatorSchema->setPreValidator(new sfValidatorCallback(array("callback" => array($this, "preValidate"))));
		$this->validatorSchema->setPostValidator(new sfValidatorCallback(array("callback" => array($this, "postValidate"))));    
  }
	
	public function postValidate($validator, $values)
	{
		sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));
		$password_validated=false;

		if (empty($values['password']))
		{
				$password_validated=true;
				$error = new sfValidatorError($validator, __('No has incluido tu contraseña.'));
				throw new sfValidatorErrorSchema($validator, array('password' => $error));
		}
		elseif (strlen($values['password'])>16 || strlen($values['password'])<2 || !preg_match('/^[^\s]+$/i', $values['password']))
		{
				$password_validated=true;
				$error = new sfValidatorError($validator, __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'));
				throw new sfValidatorErrorSchema($validator, array('password' => $error));
		}

		if (!$password_validated)
		{
				if (empty($values['password2']))
				{
						$error = new sfValidatorError($validator, __('No has confirmado tu contraseña.'));
						throw new sfValidatorErrorSchema($validator, array('password2' => $error));
				}
				elseif ($values['password']!=$values['password2'])
				{
						$error = new sfValidatorError($validator, __('Las contraseñas que has introducido no coinciden.'));
						throw new sfValidatorErrorSchema($validator, array('password2' => $error));
				}
				elseif (strlen($values['password2'])>16 || strlen($values['password2'])<2 || !preg_match('/^[^\s]+$/i', $values['password2']))
				{
						$error = new sfValidatorError($validator, __('Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.'));
						throw new sfValidatorErrorSchema($validator, array('password2' => $error));
				}
		}

		return $values;
	}
  
  /*public function preValidate($validator, $values)
  {
  	if(isset($values['password'])){
  		if($values['password']==''){
  			$this->getValidator('password2')->setOption('required', false);
  		}
  		else if(	(mb_strlen($values['password'], 'UTF-8')>=2) &&
  				(mb_strlen($values['password'], 'UTF-8')<=16) &&
  				($values['password'] == trim(strval($values['password']))) &&
  				(preg_match('/^[^\s]+$/i', $values['password']))
  		){
  
  			$this->getValidator('password2')->setOption('required', true);
  			if(($values['password2']!='') && ($values['password'] != $values['password2'])){
  				$invalid = new sfValidatorError($validator, 'Las contraseñas que has introducido no coinciden.');
  				throw new sfValidatorErrorSchema($validator, array('password' => $invalid));  				
  			}
  		}
  		else {
  			$this->getValidator('password2')->setOption('required', false);
  			$invalid = new sfValidatorError($validator, 'Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.');
  			throw new sfValidatorErrorSchema($validator, array('password' => $invalid));
  		}
  	}	
  }*/  
}

