<?php

require_once dirname(__FILE__).'/../lib/empresa_sector_tresGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/empresa_sector_tresGeneratorHelper.class.php';

/**
 * empresa_sector_tres actions.
 *
 * @package    auditoscopia
 * @subpackage empresa_sector_tres
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empresa_sector_tresActions extends autoEmpresa_sector_tresActions
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
        $empresa_sector_tres = $form->save();
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $empresa_sector_tres)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@empresa_sector_tres_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'empresa_sector_tres'));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }
    $this->filters->setTableMethod($tableMethod);
    
    $filter_column = $this->getUser()->getAttribute('empresa_sector_tres.filters', null, 'admin_module');

    $this->filtershow = $filter_column;
    
    $query = $this->filters->buildQuery($this->getFilters());

    $sort = $this->getSort();
    $sort_column = $this->getUser()->getAttribute('empresa_sector_tres.sort', null, 'admin_module');
    if ($sort_column[0] == 'empresa_sector_uno_id')
    {
      $query = Doctrine_Query::create()
        ->from('EmpresaSectorTres esd')
      ->leftJoin('esd.EmpresaSectorUno esu')
      ->orderBy('esu.name'. ' ' . $sort[1]);
    }
    elseif ($sort_column[0] == 'empresa_sector_dos_id')
    {
      $query = Doctrine_Query::create()
        ->from('EmpresaSectorTres esd')
      ->leftJoin('esd.EmpresaSectorDos esu')
      ->orderBy('esu.name'. ' ' . $sort[1]);
    }
    else{
            if ($sort[0] != ""){
            $query->addOrderBy($sort[0]. ' ' . $sort[1]);
            }
            else{
                $this->addSortQuery($query);
            }
    }
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
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

        $this->redirect('@empresa_sector_tres');
    }
    catch (Exception $e) {
        $this->redirect('@empresa_sector_tres?eid=1');
    }
  }
  
}
