<?php

/**
 * change_pass actions.
 *
 * @package    symfony
 * @subpackage change_pass
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class change_passActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->form = new changePasswordForm();
  	
  	if ($request->isMethod('post'))
  	{
  		$this->form->bind($request->getParameter($this->form->getName()));
  		if ($this->form->isValid())
  		{
  			$this->getUser()->getGuardUser()->setPassword($this->form->getValue('new_password'));
  			$this->getUser()->getGuardUser()->save();
  			$this->setTemplate('changed_password');
  		}
  	}
  }
}
