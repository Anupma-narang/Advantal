<?php

/**
 * Base project form.
 * 
 * @package    symfony
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
	public function addCSRFProtection($secret = null)
	{
		parent::addCSRFProtection($secret);
		$validatorSchema=$this->getValidatorSchema();
		if (isset($validatorSchema[self::$CSRFFieldName]))
		{
			$validatorSchema[self::$CSRFFieldName]=new myValidatorCSRFToken($validatorSchema[self::$CSRFFieldName]->getOptions());
		}
	}	
}

class myValidatorCSRFToken extends sfValidatorBase
{
	protected function configure($options = array(), $messages = array())
	{
		$this->addRequiredOption('token');

		$this->setOption('required', true);

		$this->addMessage('csrf_attack', 'Tu sesión ha caducado. Por favor vuelve a entrar.');
	}

	protected function doClean($value)
	{
		if ($value != $this->getOption('token'))
		{
			$exception=new sfValidatorError($this, 'csrf_attack');
			throw new sfValidatorErrorSchema($this, array($exception));
		}

		return $value;
	}
}