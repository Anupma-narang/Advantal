<?php

class changePasswordForm extends sfFormSymfony
{
	public function configure()
	{
		parent::configure();
		sfContext::getInstance()->getConfiguration()->loadHelpers(array('I18N'));		//para las traduciones del formulario		

		$this->widgetSchema['password'] =  new sfWidgetFormInputPassword(
				array(), array('maxlength' => 16, 'class' => 'tamano_16_c')
		);		
		
		$this->widgetSchema['new_password'] =  new sfWidgetFormInputPassword(
				array(), array('maxlength' => 16, 'class' => 'tamano_16_c')
		);
		
		$this->widgetSchema['new_password2'] = new sfWidgetFormInputPassword(
				array(), array('maxlength' => 16, 'class' => 'tamano_16_c')
		);

		
		$this->setValidator('password', new sfValidatorPass());
		$this->setValidator('new_password', new sfValidatorPass());
		$this->setValidator('new_password2', new sfValidatorPass());
		
		$this->validatorSchema->setPostValidator(new sfValidatorCallback(array("callback" => array($this, "validatePasswords"))));
		
		$this->widgetSchema->setLabels(array(
				'password'			=> 	'Tu contraseña actual*',
				'new_password'		=> 	'Tu nueva contraseña*',
				'new_password2'		=> 	'Repite tu nueva contraseña*',
		));		
		
		$this->widgetSchema->setNameFormat('changePassword[%s]');				
	}
	
	public function validatePasswords($validator, $values)
	{
		$password_validated=false;
		if (empty($values['password']))
		{
			$password_validated=true;
			$invalid = new sfValidatorError($validator, 'Necesitas incluir una contraseña.');
			throw new sfValidatorErrorSchema($validator, array('password' => $invalid));
		}
		elseif (strlen($values['password'])>16 || strlen($values['password'])<2 || !preg_match('/^[^\s]+$/i', $values['password']))
		{
			$password_validated=true;
			$invalid = new sfValidatorError($validator, 'Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.');
			throw new sfValidatorErrorSchema($validator, array('password' => $invalid));
		}
		elseif (!empty($values['password']))
		{
			if (sfContext::getInstance()->getUser()->getGuardUser()->checkPassword($values['password'])==0)
			{
				$email_validated=true;
				$error = new sfValidatorError($validator, __('Esa no es tu contraseña actual.'));
				throw new sfValidatorErrorSchema($validator, array('password' => $error));
			}
		}
		
		if (!$password_validated)
		{
			$new_password_validated=false;
			if (empty($values['new_password']))
			{
				$new_password_validated=true;
				$invalid = new sfValidatorError($validator, 'No has incluido tu nueva contraseña.');
				throw new sfValidatorErrorSchema($validator, array('new_password' => $invalid));
			}
			elseif (strlen($values['new_password'])>16 || strlen($values['new_password'])<2 || !preg_match('/^[^\s]+$/i', $values['new_password']))
			{
				$new_password_validated=true;
				$invalid = new sfValidatorError($validator, 'Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.');
				throw new sfValidatorErrorSchema($validator, array('new_password' => $invalid));
			}
			
			if (!$new_password_validated)
			{
				if (empty($values['new_password2']))
				{
					$invalid = new sfValidatorError($validator, 'Necesitas repetir tu contraseña.');
					throw new sfValidatorErrorSchema($validator, array('new_password2' => $invalid));
				}
				elseif ($values['new_password']!=$values['new_password2'])
				{
					$invalid = new sfValidatorError($validator, 'Las contraseñas que has introducido no coinciden.');
					throw new sfValidatorErrorSchema($validator, array('new_password2' => $invalid));
				}
				elseif (strlen($values['new_password2'])>16 || strlen($values['new_password2'])<2 || !preg_match('/^[^\s]+$/i', $values['new_password2']))
				{
					$invalid = new sfValidatorError($validator, 'Tu contraseña debe tener entre 2 y 16 caracteres, sin espacios en blanco.');
					throw new sfValidatorErrorSchema($validator, array('new_password2' => $invalid));
				}
			}
		}
		
		return $values;
	}
	
	public function bind(array $taintedValues = null, array $taintedFiles = null)
	{
		parent::bind($taintedValues, $taintedFiles);
	}
}