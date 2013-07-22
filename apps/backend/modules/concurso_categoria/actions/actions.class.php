<?php

require_once dirname(__FILE__).'/../lib/concurso_categoriaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/concurso_categoriaGeneratorHelper.class.php';

/**
 * concurso_categoria actions.
 *
 * @package    auditoscopia
 * @subpackage concurso_categoria
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class concurso_categoriaActions extends autoConcurso_categoriaActions
{
  public function executeShow(sfWebRequest $request)
	{
		$this->categoria = $this->getRoute()->getObject();
	}
        
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $concurso_categoria = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $concurso_categoria)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@concurso_categoria_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'concurso_categoria'));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function executeDelete(sfWebRequest $request)
  {
    try{
        $request->checkCSRFProtection();

        $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

        if ($this->getRoute()->getObject()->delete())
        {
        $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
        }

        $this->redirect('@concurso_categoria');
    }
    catch (Exception $e) {
        $this->redirect('@concurso_categoria?eid=1');
    }
  }
  
}
