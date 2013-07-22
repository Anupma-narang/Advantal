<?php

require_once dirname(__FILE__).'/../lib/empresa_sector_unoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/empresa_sector_unoGeneratorHelper.class.php';

/**
 * empresa_sector_uno actions.
 *
 * @package    auditoscopia
 * @subpackage empresa_sector_uno
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empresa_sector_unoActions extends autoEmpresa_sector_unoActions
{
    
  public function executeShow(sfWebRequest $request)
	{
		$this->empresa = $this->getRoute()->getObject();
	}
        
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $empresa_sector_uno = $form->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $empresa_sector_uno)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@empresa_sector_uno_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'empresa_sector_uno'));
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

            $this->redirect('@empresa_sector_uno');
        }
        catch (Exception $e) {
            $this->redirect('@empresa_sector_uno?eid=1');
        }
    }
  
}
