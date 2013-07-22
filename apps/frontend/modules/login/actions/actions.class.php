<?php

/**
 * login actions.
 *
 * @package    auditoscopia
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $user = $this->getUser();
    if ($user->isAuthenticated())
    {
      return $this->redirect('concurso/index');
    }
  }
}
